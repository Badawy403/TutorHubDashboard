<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $teacher = $this->relationLoaded('teacher') ? $this->whenLoaded('teacher'):null;
        $student = $this->relationLoaded('student') ? $this->whenLoaded('student'):null;
        $academy = $this->relationLoaded('academy') ? $this->whenLoaded('academy'):null;


        $logged_in_as = $request->session()->get('logged_in_as');


        if($logged_in_as == 'teacher' && $teacher){
            if($teacher->pricing_plan){
                $pricing_plan = $teacher->pricing_plan;
                $teacher_modules = $pricing_plan->teacher_modules()->pluck('pricing_plan_modules.module_code')->toArray();
            }else{
                $teacher_modules = [];
            }
            $login_info = new TeachersResource($teacher);
        }else if($logged_in_as == 'academy' && $academy){
            if($academy->pricing_plan){
                $pricing_plan = $academy->pricing_plan;
                $academy_modules = $pricing_plan->academy_modules()->pluck('pricing_plan_modules.module_code')->toArray();
            }else{
                $academy_modules = [];
            }
            $login_info = new AcademiesResource($academy);
        }else if($logged_in_as == 'student' && $student){
            $login_info = new StudentsResource($student);
        }
        else{
            $login_info = null;
        }
        return [
                "id" => $this->id,
                "name" => $this->name,
                "email" => $this->email,
                "is_active" => $this->is_active,
                "country_id" => $this->country_id,
                "email_verified_at" => $this->email_verified_at,
                "is_email_verified" => $this->hasVerifiedEmail(),
                "profile_image_path" => $this->profile_image_path,
                "password_last_changed" => $this->password_last_changed,
                "is_teacher" => $this->hasRole('teacher'),
                "is_student" => $this->hasRole('student'),
                "is_academy" => $this->hasRole('academy'),
                'teacher_modules' => $teacher_modules ?? [],
                'academy_modules' => $academy_modules ?? [],
                'login_info' => $login_info,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
                "deleted_at" =>  $this->deleted_at
        ];
    }
}
