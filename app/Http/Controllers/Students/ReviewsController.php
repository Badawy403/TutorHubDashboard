<?php

namespace App\Http\Controllers\Students;
use App\Http\Controllers\Controller;
use App\Http\Requests\Students\AddTeacherReviewRequest;
use App\Http\Requests\Students\AddAcademyReviewRequest;

class ReviewsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
      $this->middleware('auth');
    //   $this->middleware('student');
  }


  public function addTeacherReview(AddTeacherReviewRequest $request)
  {
      $user = auth()->user();
      $student = $user->student;
      if($student){
          $student->teacher_reviews()->create($request->all());
      }
      request()->session()->flash('alert', [
          'type' => 'success',
          'message' => 'Review Added Successfully',
      ]);
      return redirect()->back()->withResponseData([
          'message' => 'Review Added Successfully',
          'type' => 'success'
      ]);
  }
  public function addAcademyReview(AddAcademyReviewRequest $request)
  {
      $user = auth()->user();
      $student = $user->student;
      if($student){
          $student->academy_reviews()->create($request->all());
      }
      request()->session()->flash('alert', [
          'type' => 'success',
          'message' => 'Review Added Successfully',
      ]);
      return redirect()->back()->withResponseData([
          'message' => 'Review Added Successfully',
          'type' => 'success'
      ]);
  }
}
