<?php

namespace App\Http\Controllers\API\Students;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Students\AddTeacherReviewRequest;
use App\Http\Requests\API\Students\AddAcademyReviewRequest;

class APIReviewsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
      $this->middleware('auth:api');
    //   $this->middleware('student');
  }


  public function addTeacherReview(AddTeacherReviewRequest $request)
  {
      $user = auth()->user();
      $student = $user->student;
      if($student){
          $student->teacher_reviews()->create($request->all());
      }
      $response = generateResponse(null,true,"Review Added Successfully",null,'collection');
      return response()->json($response);
  }
  public function addAcademyReview(AddAcademyReviewRequest $request)
  {
      $user = auth()->user();
      $student = $user->student;
      if($student){
          $student->academy_reviews()->create($request->all());
      }
      $response = generateResponse(null,true,"Review Added Successfully",null,'collection');
      return response()->json($response);
  }
}
