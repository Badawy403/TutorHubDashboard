<?php

namespace App\Http\Controllers\API\Teachers;

use App\Events\ChatMessage;
use App\Events\ServiceChatMessage;
use App\Models\AppointmentType;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\MessagesResource;
use App\Models\BookAppointment;
use App\Models\Message;
use App\Http\Requests\API\ChatMessage\SendMessageRequest;
use App\Models\BookedService;
use Illuminate\Support\Facades\Auth;

class TeacherServiceChatMessagesController extends Controller
{
    public function __construct()
    {
      $this->middleware(['api','auth:api','verified','api_setting']);
      $this->middleware('teacher.api');
    }
    public function getChatMessages(Request $request , BookedService $booked_service)
    {
       $user = Auth::user();
       $teacher = $user->teacher;
      if($booked_service->teacher_id != $teacher->id){
        $response = generateResponse(null, false, "Not Found", null, 'collection');
        return response()->json($response);
      }
        $messages = Message::where('booked_service_id', $booked_service->id)->get();
        $messages = MessagesResource::collection($messages);
        $response = generateResponse($messages, true, "Chat Messages fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function sendChatMessage(SendMessageRequest $request)
    {
         $booked_service = BookedService::where('id', $request->booked_service_id)->first();
         if(!empty($booked_service)){
          $user = Auth::user();
          $teacher = $user->teacher;
          if($booked_service->teacher_id != $teacher->id){
            $response = generateResponse(null, false, "Not Found", null, 'collection');
            return response()->json($response);
          }
         $data = $request->all();
         $data['sender_id'] = $teacher->id;
         $data['sender_type'] = 'App\Models\Teacher';

         $data['reciever_id'] = $booked_service->student_id;
         $data['reciever_type'] = "App\Models\Student";

         if ($request->hasFile('attachment_file')) {
             $data['attachment_url'] = uploadFile($request, 'attachment_file', 'chat_attachments');
             $data['is_attachment'] = 1;
         }
         $message = Message::create($data);
         $message = new MessagesResource($message);
         event(new ServiceChatMessage($message));
         $response = generateResponse($message, true, "Message send successfully", null, 'collection');
         }else{
          $response = generateResponse(null, false, "404 Not Found", null, 'collection');
         }
        return response()->json($response);
    }
}
