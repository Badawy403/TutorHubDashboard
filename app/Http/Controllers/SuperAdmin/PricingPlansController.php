<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\PricingPlansExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\PricingPlans\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\PricingPlansImport;
use App\Models\PricingPlan;
use App\Models\PricingPlanModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Cashier\Cashier;
use Maatwebsite\Excel\Facades\Excel;

class PricingPlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        if ($req != null) {
            $pricing_plans =  PricingPlan::withAll();
            if ($req->trash && $req->trash == 'with') {
                $pricing_plans =  $pricing_plans->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $pricing_plans =  $pricing_plans->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $pricing_plans = $pricing_plans->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $pricing_plans = $pricing_plans->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $pricing_plans = $pricing_plans->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $pricing_plans = $pricing_plans->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $pricing_plans = $pricing_plans->get();
                return $pricing_plans;
            }
            $pricing_plans = $pricing_plans->get();
            return $pricing_plans;
        }
        $pricing_plans = PricingPlan::withAll()->orderBy('id', 'desc')->get();
        return $pricing_plans;
    }


    public function syncPlans(Request $request){
        $stripe = Cashier::stripe();
        $products = $stripe->products->all(); // here you get all products
        $products = $products->data;
        $products = collect($products);
        $prices   = $stripe->prices->all();   // here you get all prices
        $prices = $prices->data;
        $prices = collect($prices);
        foreach($products as $product){
            $price_detail = $prices->where('id',$product->default_price)->first();
            $plan = PricingPlan::where('stripe_plan', $product->default_price)->first();
            if($plan){
                $plan->update([
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $price_detail->unit_amount/100,
                    'is_paid' => 1,
                ]);
            }else{
                $pricing_plan = PricingPlan::create([
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $price_detail->unit_amount/100,
                    'is_active' => 1,
                    'is_paid' => 1,
                    'stripe_plan' => $product->default_price
                ]);
                 $pricing_plan->slug = Str::slug($product->name. ' ' . $pricing_plan->id, '-');
                 $pricing_plan->save();
            }
        }
        return redirect()->route('super_admin.pricing_plans.index')->with('message', 'PricingPlan Sync Successfully')->with('message_type', 'success');
    }
    /*********View All PricingPlans  ***********/
    public function index(Request $request)
    {
        $pricing_plans = $this->getter($request);
        return view('super_admins.pricing_plans.index')->with('pricing_plans', $pricing_plans);
    }

    /*********View Create Form of PricingPlan  ***********/
    public function create()
    {
        $teacher_modules = PricingPlanModule::teacher()->get();
        $academy_modules = PricingPlanModule::academy()->get();

        return view('super_admins.pricing_plans.create',compact('teacher_modules','academy_modules'));
    }

    /*********Store PricingPlan  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','pricing_plans');
            $pricing_plan = PricingPlan::create($data);
            $data['slug'] = Str::slug($data['name'] . ' ' . $pricing_plan->id, '-');
            $pricing_plan->update($data);
            $pricing_plan->modules()->sync([]);
            $pricing_plan->teacher_modules()->attach($request->teacher_modules);
            $pricing_plan->academy_modules()->attach($request->academy_modules);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage(),$e->getTrace(),$e->getLine());
            return redirect()->route('super_admin.pricing_plans.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.pricing_plans.index')->with('message', 'PricingPlan Created Successfully')->with('message_type', 'success');
    }

    /*********View PricingPlan  ***********/
    public function show(PricingPlan $pricing_plan)
    {
        return view('super_admins.pricing_plans.show', compact('pricing_plan'));
    }

    /*********View Edit Form of PricingPlan  ***********/
    public function edit(PricingPlan $pricing_plan)
    {
        $teacher_modules = PricingPlanModule::teacher()->get();
        $academy_modules = PricingPlanModule::academy()->get();
        $pricing_plan_teacher_modules =$pricing_plan->teacher_modules()->pluck('pricing_plan_modules.module_code')->toArray();
        $pricing_plan_academy_modules =$pricing_plan->academy_modules()->pluck('pricing_plan_modules.module_code')->toArray();
        return view('super_admins.pricing_plans.edit', compact('pricing_plan','teacher_modules','pricing_plan_teacher_modules','academy_modules','pricing_plan_academy_modules'));
    }

    /*********Update PricingPlan  ***********/
    public function update(CreateRequest $request, PricingPlan $pricing_plan)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','pricing_plans',$pricing_plan->image);

            } else {
                $data['image'] = $pricing_plan->image;
            }
            $data['slug'] = Str::slug($data['name'] . ' ' . $pricing_plan->id, '-');
            $pricing_plan->update($data);
            $pricing_plan->modules()->sync([]);
            $pricing_plan->teacher_modules()->attach($request->teacher_modules);
            $pricing_plan->academy_modules()->attach($request->academy_modules);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.pricing_plans.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.pricing_plans.index')->with('message', 'PricingPlan Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $pricing_plans = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "pricing_plans." . $extension;
        return Excel::download(new PricingPlansExport($pricing_plans), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new PricingPlansImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE PricingPlan ***********/
    public function destroy(PricingPlan $pricing_plan)
    {
        if ($pricing_plan->is_default) {
            return redirect()->back()->with('message', 'Default PricingPlan cannot be Deleted')->with('message_type', 'error');

        }
        $pricing_plan->delete();
        return redirect()->back()->with('message', 'PricingPlan Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE PricingPlan ***********/
    public function destroyPermanently(Request $request, $pricing_plan)
    {
        $pricing_plan = PricingPlan::withTrashed()->find($pricing_plan);
        if ($pricing_plan->is_default) {
            return redirect()->back()->with('message', 'Default PricingPlan cannot be Deleted')->with('message_type', 'error');

        }
        if ($pricing_plan) {
            if ($pricing_plan->trashed()) {
                if ($pricing_plan->image && file_exists(public_path($pricing_plan->image))) {
                    unlink(public_path($pricing_plan->image));
                }
                $pricing_plan->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore PricingPlan***********/
    public function restore(Request $request, $pricing_plan)
    {
        $pricing_plan = PricingPlan::withTrashed()->find($pricing_plan);
        if ($pricing_plan->trashed()) {
            $pricing_plan->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
}
