<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SocialLoginRequest;
use App\Http\Resources\API\UsersResource;
use App\Mail\User\Auth\ForgotPasswordEmail;
use App\Notifications\Auth\ResetPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Session;

class APIAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api' , 'api_setting']);
        $this->middleware(['auth:api'])->only(['logout','getLoggedInUser']);
        // $this->middleware('guest')->except(['logout']);
    }

    public function submitForgotPasswordForm(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users,email'
            ]
        );

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $token = Str::random(64);
            DB::table('password_resets')->where('email', $request->email)->delete(); // revoke previous tokens
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            $user->update(['forgot_pass_token' => $token]);
            Notification::send($user, new ResetPassword($token));
            $response = generateResponse(null,true,"Email Sent Successfully Please Check Your Inbox!",null,'collection');
        }else{
            $response = generateResponse(null,false,"User Not Found",null,'collection');
        }
        return response()->json($response);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
            'token' => 'required|exists:password_resets,token',
        ]);
        $password_reset = DB::table('password_resets')->where('token', $request->token)->first();
        if ($password_reset) {
            $user = User::where('email', $password_reset->email)->first();
            if ($user) {
                $user_data = [];
                $user_data['password'] = Hash::make($request->password);
                $user->update($user_data);
                DB::table('password_resets')->where('email', $user->email)->delete();
                $response = generateResponse(null,true,"Password Resets Successfully",null,'collection');
            }
            $response = generateResponse(null,false,"Invalid Token Provided",null,'collection');

        } else {
            $response = generateResponse(null,false,"Invalid Token Provided",null,'collection');
        }
        return response()->json($response);
    }

    public function submitLoginForm(LoginRequest $request)
    {
        $user = User::withAll()->where('email', $request->email)->first();
        if ($user) {
            $email = $request->email;
            $password = $request->password;
            if (!$user->is_active) {
                $response = generateResponse(null,false,"User Is Inactive",null,'collection');
                return response()->json($response);
            }
            if ($request->login_as == 'teacher' && !$user->hasRole(Role::$Teacher)) {
                $response = generateResponse(null,false,"The provided email and password do not match",null,'collection');
                return response()->json($response);
            }
            if ($request->login_as == 'student' && !$user->hasRole(Role::$Student)) {
                $response = generateResponse(null,false,"The provided email and password do not match",null,'collection');
                return response()->json($response);
            }
            if ($request->login_as == 'academy' && !$user->hasRole(Role::$Academy)) {
                $response = generateResponse(null,false,"The provided email and password do not match",null,'collection');
                return response()->json($response);
            }

            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                $request->session()->put('logged_in_as', $request->login_as);
                $success['user'] = new UsersResource($user);
                $token = $user->createToken('MyApp',[]);
                $success['token'] =  $token->accessToken;
                $response = generateResponse($success,true,"Successfully Login",null,'collection');
            } else {
                $response = generateResponse(null,false,"The provided email and password do not match",null,'collection');
            }
        } else {
            $response = generateResponse(null,false,"The provided email and password do not match",null,'collection');
        }
        return response()->json($response);
    }

    public function submitRegisterForm(Request $request)
    {
        $request->validate(
            [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|unique:users,email',
                'password' => 'required|min:8|confirmed',
            ]
        );
        $data = $request->all();
        $data['name'] = $data['first_name'].' '.$data['last_name'];
        $data['password'] = Hash::make($request->password);
        $data['is_active'] = 1;
        $user = User::create($data);
        $user->roles()->attach([$request->login_as]);
        if($request->login_as == 'teacher'){
            $pricing_plan = getTeacherDefaultPricingPlan();
            $user->teacher()->create(['pricing_plan_id' => $pricing_plan->id ?? null,'first_name' => $data['first_name'], 'last_name' => $data['last_name'],'zip_code' => $data['zip_code'] ?? null]);
        }
        if($request->login_as == 'student'){
            $user->student()->create(['first_name' => $data['first_name'], 'last_name' => $data['last_name'],'zip_code' => $data['zip_code'] ?? null]);
        }
        if($request->login_as == 'academy'){
            $pricing_plan = getAcademyDefaultPricingPlan();
            $user->academy()->create(['pricing_plan_id' => $pricing_plan->id ?? null,'first_name' => $data['first_name'], 'last_name' => $data['last_name'],'zip_code' => $data['zip_code'] ?? null]);
        }
        // $user->sendEmailVerificationNotification();
        $user->markEmailAsVerified();

        if ($user) {
            $user = User::where('id',$user->id)->withAll()->first();
            $success['user'] = new UsersResource($user);
            $token = $user->createToken('MyApp',[]);
            $success['token'] =  $token->accessToken;
            $response = generateResponse($success,true,"Successfully Login",null,'collection');
        } else {
            $response = generateResponse(null,false,"Invalid Request",null,'collection');

        }
        return response()->json($response);

    }

    public function getLoggedInUser(){
        $user = Auth::user();
        $user = User::where('id',$user->id)->withAll()->first();
        $user = new UsersResource($user);
        $response = generateResponse($user,true,"Successfully Login",null,'collection');
        return response()->json($response);

    }

    public function deleteAccount()
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $userTokens = $user->tokens;
            foreach ($userTokens as $token) {
                $token->revoke();
            }
            // session()->invalidate();
            // session()->regenerateToken();
            // session()->forget('logged_in_as');
            // session(['logged_in_as' => null]);

            DB::table('sessions')->where('user_id', $user->id)->delete();
            $user->delete();
            DB::commit();

            return response()->json(generateResponse(null, true, "Account Deleted Successfully", null, 'collection'));
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(generateResponse(null, false, "Account Deletion Failed: " . $e->getMessage(), null, 'collection'), 500);
        }
    }

    public function socialLogin(SocialLoginRequest $request){
        try {
             DB::beginTransaction();
              $data = $request->only('email' , 'first_name' , 'login_as' , 'last_name');
              $data['name'] = $data['first_name'] ?? '-'.' '.$data['last_name'] ?? '-';
              $data['is_active'] = 1;
              $user = User::where('email' , $request->email)->first();
              if($user){
                $response['is_login'] = 1;
                $response = $this->loginUser($user ,$request, $data);
              }else{
                $user = User::create($data);
                $user->roles()->attach([$request->login_as]);
                if($request->login_as == 'teacher'){
                    $pricing_plan = getTeacherDefaultPricingPlan();
                    $user->teacher()->create(['pricing_plan_id' => $pricing_plan->id ?? null,'first_name' => $data['first_name'], 'last_name' => $data['last_name'],'zip_code' => $data['zip_code'] ?? null]);
                }
                if($request->login_as == 'student'){
                    $user->student()->create(['first_name' => $data['first_name'], 'last_name' => $data['last_name'],'zip_code' => $data['zip_code'] ?? null]);
                }
                if($request->login_as == 'academy'){
                    $pricing_plan = getAcademyDefaultPricingPlan();
                    $user->academy()->create(['pricing_plan_id' => $pricing_plan->id ?? null,'first_name' => $data['first_name'], 'last_name' => $data['last_name'],'zip_code' => $data['zip_code'] ?? null]);
                }
                $response['is_login'] = 0 ;
                $data['is_social'] = 1;
                $response = $this->loginUser($user , $request , $response);
                DB::commit();
              }
              return response()->json($response, 200);
        } catch (\Exception $e) {
          DB::rollback();
          $response = generateResponse(null,false,$e->getMessage(),null,'object');
          return response()->json($response, 200);
        }

     }
     public function loginUser($user ,$request, $data){
        $user = User::where('id',$user->id)->withAll()->first();
        $success['user'] = new UsersResource($user);
        $token = $user->createToken('MyApp',[]);
        $success['token'] =  $token->accessToken;
        $request->session()->put('logged_in_as', $data['login_as'] ?? 'student');
        $response = generateResponse($success,true,"Successfully Login",null,'collection');
        return $response;
    }

    public function logout(Request $request)
    {
        Auth::user()->token()->revoke();
        $response = generateResponse([],true,'User successfully logged out',[],'object');
        return response()->json($response, 200);
    }
}
