<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\ModulesResource;
use App\Http\Resources\Web\PricingPlansResource;
use App\Models\Teacher;
use App\Models\Academy;
use App\Models\PricingPlan;
use App\Models\PricingPlanModule;
use Laravel\Cashier\Cashier;

class PricingPlansController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request,$type)
    {
        if($type == 'teacher'){
            $pricing_plans = PricingPlan::with('modules')->teacher()->active()->get();
            $pricing_plans = PricingPlansResource::collection($pricing_plans);
            $modules = PricingPlanModule::teacher()->orderBy('sort_order','asc')->get();
            $modules = ModulesResource::collection($modules);
        }
        else if($type == 'academy'){
            $pricing_plans = PricingPlan::with('modules')->lawFirm()->active()->get();
            $pricing_plans = PricingPlansResource::collection($pricing_plans);
            $modules = PricingPlanModule::lawFirm()->orderBy('sort_order','asc')->get();
            $modules = ModulesResource::collection($modules);
        }else{

        }
// dd( $pricing_plans , $modules );
        return Inertia::render('PricingPlan/Listing',[
            'pricing_plans' => $pricing_plans,
            'modules' => $modules
        ]);
    }

    public function show(Request $request,$type,$slug)
    {
        $settings = generalSettings();
        $user = auth()->user();
        if(!$user){
            session([$type.'-'.'pricing-plan' => $slug]);
            return redirect()->route('register',['tab' => $type]);
        }
        $logged_in_as = $request->session()->get('logged_in_as');
        if($type == 'teacher'){
            config(['cashier.model' => 'App\Models\Teacher']);
            $teacher = $user->teacher;
            if($teacher && $logged_in_as == 'teacher'){
                $pricing_plan = PricingPlan::with('modules')->teacher()->active()->where('slug',$slug)->first();
                if($pricing_plan->is_paid && $settings['stripe_key']){
                    $intent = $teacher->createSetupIntent();
                }
                $pricing_plan = new PricingPlansResource($pricing_plan);
                $modules = PricingPlanModule::teacher()->orderBy('sort_order','asc')->get();
                $modules = ModulesResource::collection($modules);
            }else{
                request()->session()->flash('alert', [
                    'type' => 'info',
                    'message' => 'Please Switch To Teacher Profile For Teacher Subscriptions',
                ]);
                return redirect()->back();
            }
        }
        else if($type == 'academy'){
            config(['cashier.model' => 'App\Models\Academy']);
            $academy = $user->academy;
            if($academy && $logged_in_as == 'academy'){
                $pricing_plan = PricingPlan::with('modules')->lawFirm()->where('slug',$slug)->active()->first();
                if($pricing_plan->is_paid && $settings['stripe_key']){
                    $intent = $academy->createSetupIntent();
                }
                $pricing_plan = new PricingPlansResource($pricing_plan);
                $modules = PricingPlanModule::lawFirm()->orderBy('sort_order','asc')->get();
                $modules = ModulesResource::collection($modules);
            }else{
                request()->session()->flash('alert', [
                    'type' => 'info',
                    'message' => 'Please Switch To Academy Profile For Academy Subscriptions',
                ]);
                return redirect()->back();
            }
        }else{
            abort(404);
        }

        return Inertia::render('PricingPlan/Detail',[
            'pricing_plan' => $pricing_plan,
            'modules' => $modules,
            'intent' => $intent ?? null
        ]);
    }

    public function subscription(Request $request,$type,$slug)
    {
        $user = auth()->user();
        if(!$user){
            session([$type.'-'.'pricing-plan' => $slug]);
            return redirect()->route('register',['tab' => $type]);
        }
        $logged_in_as = $request->session()->get('logged_in_as');
        if($type == 'teacher'){
            config(['cashier.model' => 'App\Models\Teacher']);
            Cashier::useCustomerModel(Teacher::class);
            $teacher = $user->teacher;
            if($teacher && $logged_in_as == 'teacher'){
                $pricing_plan = PricingPlan::with('modules')->teacher()->where('slug',$slug)->active()->first();
                if($pricing_plan->is_paid){
                    $subscription = $teacher->newSubscription($pricing_plan->slug, $pricing_plan->stripe_plan)->create($request->token);
                    $teacher->update(['pricing_plan_id' => $pricing_plan->id]);
                }else{
                    $teacher->update(['pricing_plan_id' => $pricing_plan->id]);
                }
            }
        }
        if($type == 'academy'){
            config(['cashier.model' => 'App\Models\Academy']);
            Cashier::useCustomerModel(Academy::class);
            $academy = $user->academy;
            if($academy && $logged_in_as == 'academy'){
                $pricing_plan = PricingPlan::with('modules')->lawFirm()->where('slug',$slug)->active()->first();
                if($pricing_plan->is_paid){
                    $subscription = $academy->newSubscription($pricing_plan->slug, $pricing_plan->stripe_plan)->create($request->token);
                    $academy->update(['pricing_plan_id' => $pricing_plan->id]);
                }else{
                    $academy->update(['pricing_plan_id' => $pricing_plan->id]);
                }
            }
        }
        request()->session()->flash('alert', [
            'type' => 'info',
            'message' => 'Successfully Activated Subscription',
        ]);
        return redirect(route('pricing',['type' => $type]));
    }
}
