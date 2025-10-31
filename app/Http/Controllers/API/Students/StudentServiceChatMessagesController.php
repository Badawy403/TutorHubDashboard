<?php

namespace App\Http\Controllers\API\Students;

use App\Events\ChatMessage;
use App\Events\ServiceChatMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\MessagesResource;
use App\Models\BookedService;
use App\Models\Message;
use App\Http\Requests\API\ChatMessage\SendMessageRequest;
use Illuminate\Support\Facades\Auth;

class StudentServiceChatMessagesController extends Controller
{
    public function __construct()
    {
      $this->middleware(['api','auth:api','verified','api_setting']);
      $this->middleware('student.api');
    }
    public function getChatMessages(Request $request , BookedService $booked_service)
    {
       $user = Auth::user();
       $student = $user->student;
      if($booked_service->student_id != $student->id){
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
          $student = $user->student;
          if($booked_service->student_id != $student->id){
            $response = generateResponse(null, false, "Not Found", null, 'collection');
            return response()->json($response);
          }
         $data = $request->all();
         $data['sender_id'] = $student->id;
         $data['sender_type'] = 'App\Models\Student';
         $data['reciever_id'] = $booked_service->teacher_id;
         $data['reciever_type'] = "App\Models\Teacher";
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
