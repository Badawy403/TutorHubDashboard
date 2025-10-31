<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;

class SocialAuthController extends Controller
{
    public function redirectToProvider(Request $request, $provider)
    {
        $request->session()->put('login_attempt_as', $request->login_as);
        return Socialite::driver($provider)->redirect();
    }


    public function providerCallback(Request $request, $provider)
    {

        $login_attempt_as = $request->session()->get('login_attempt_as');
        $request->session()->forget('login_attempt_as');
        if (!in_array($login_attempt_as, [Role::$Student, Role::$Admin, Role::$Academy, Role::$Teacher])) {
            return redirect()->route('login')->withErrors([
                'Invalid' => 'Invalid Request'
            ]);
        };
        try {
            $urlArr = parse_url($_SERVER['REQUEST_URI']);
            parse_str($urlArr['query'], $output);
            $request->merge($output);
            $social_user = Socialite::driver($provider)->user();

            // First Find Social Account
            $account = SocialAccount::where([
                'provider_name' => $provider,
                'provider_id' => $social_user->getId()
            ])->first();

            // If Social Account Exist then Find User and Login
            if ($account) {
                $user = $account->user;
                if (!$user->hasRole($login_attempt_as)) {
                    $user->roles()->attach([$login_attempt_as]);
                    if($login_attempt_as == 'teacher'){
                        $pricing_plan = getTeacherDefaultPricingPlan();
                        $user->teacher()->create(['pricing_plan_id' => $pricing_plan->id ?? null,'first_name' => $user->name]);
                    }
                    if($login_attempt_as == 'student'){
                        $user->student()->create(['first_name' => $user->name]);
                    }
                    if($login_attempt_as == 'academy'){
                        $pricing_plan = getAcademyDefaultPricingPlan();
                        $user->academy()->create(['pricing_plan_id' => $pricing_plan->id ?? null,'first_name' => $user->name]);
                    }
                }
                auth()->login($user);
                $request->session()->put('logged_in_as', $login_attempt_as);
                return redirect()->route('home');
            }

            // Find User
            $user = User::where([
                'email' => $social_user->getEmail()
            ])->first();

            // If User not get then create new user
            if (!$user) {
                $user = User::create([
                    'email' => $social_user->getEmail(),
                    'name' => $social_user->getName(),
                ]);
                $user->roles()->attach([$login_attempt_as]);
                if($login_attempt_as == 'teacher'){
                    $pricing_plan = getTeacherDefaultPricingPlan();
                    $user->teacher()->create(['pricing_plan_id' => $pricing_plan->id ?? null,'first_name' => $social_user->getName()]);
                }
                if($login_attempt_as == 'student'){
                    $user->student()->create(['first_name' => $social_user->getName()]);
                }
                if($login_attempt_as == 'academy'){
                    $pricing_plan = getAcademyDefaultPricingPlan();
                    $user->academy()->create(['pricing_plan_id' => $pricing_plan->id ?? null,'first_name' => $social_user->getName()]);
                }
            }

            // Create Social Accounts
            $user->social_accounts()->create([
                'provider_id' => $social_user->getId(),
                'provider_name' => $provider
            ]);

            // Login
            if (!$user->hasRole($login_attempt_as)) {
                $user->roles()->attach([$login_attempt_as]);
                if($login_attempt_as == 'teacher'){
                    $pricing_plan = getTeacherDefaultPricingPlan();
                    $user->teacher()->create(['pricing_plan_id' => $pricing_plan->id ?? null,'first_name' => $social_user->getName()]);
                }
                if($login_attempt_as == 'student'){
                    $user->student()->create(['first_name' => $social_user->getName()]);
                }
                if($login_attempt_as == 'academy'){
                    $pricing_plan = getAcademyDefaultPricingPlan();
                    $user->academy()->create(['pricing_plan_id' => $pricing_plan->id ?? null,'first_name' => $social_user->getName()]);
                }
            }
            if(!$user->hasVerifiedEmail()){
                $user->markEmailAsVerified();
            }
            auth()->login($user);
            $request->session()->put('logged_in_as', $login_attempt_as);
            return redirect()->route('home');
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors([
                'Invalid' => 'Invalid Request'
            ]);
        }
    }
}
