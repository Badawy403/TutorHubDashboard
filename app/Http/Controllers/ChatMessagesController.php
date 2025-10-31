<?php

namespace App\Http\Controllers;

use App\Events\ChatMessage;
use App\Events\ServiceChatMessage;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\MessagesResource;
use App\Models\BookAppointment;
use App\Models\BookedService;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatMessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getChatMessages(Request $request)
    {

        $messages = Message::query();

        if($request->service_id){
            $messages = $messages->where('booked_service_id', $request->service_id);
        }else{
            $messages = $messages->where('appointment_id', $request->appointment_id);
        }
        $messages = $messages->get();
        $messages = MessagesResource::collection($messages);
        $response = generateResponse($messages, true, "Chat Messages fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function sendChatMessage(Request $request)
    {
        // dd($request->all());
        $request->merge(['booked_service_id' => $request->service_id]);
        $data = $request->all();
        $user = Auth::user();
        $appointment = BookAppointment::where('id', $request->appointment_id)->first();
        $service = BookedService::where('id', $request->service_id)->first();
        $logged_in_as = $request->session()->get('logged_in_as');
        if ($logged_in_as == 'teacher') {
            $teacher = $user->teacher;
            $sender_id = $teacher->id;
            $sender_type = 'App\Models\Teacher';
        }
        if ($logged_in_as == 'academy') {
            $academy = $user->academy;
            $sender_id = $academy->id;
            $sender_type = 'App\Models\Academy';
        }

        if ($logged_in_as == 'student') {
            $student = $user->student;
            $sender_id = $student->id;
            $sender_type = 'App\Models\Student';
        }

        $data['sender_id'] = $sender_id;
        $data['sender_type'] = $sender_type;
    //    Not using anywhere
    if($appointment){
        $data['reciever_id'] = $appointment->student_id;
        $data['reciever_type'] = "App\Models\Student";
        $data['reciever_id'] = $appointment->teacher_id;
        $data['reciever_type'] = "App\Models\Teacher";
    }
    //    Not using anywhere
        if ($request->hasFile('attachment_file')) {
            $data['attachment_url'] = uploadFile($request, 'attachment_file', 'chat_attachments');
            $data['is_attachment'] = 1;
        }
        $message = Message::create($data);
        $message = new MessagesResource($message);
        if($appointment){
            event(new ChatMessage($message));
        }else{
            event(new ServiceChatMessage($message));
        }

        $response = generateResponse($message, true, "Message send successfully", null, 'collection');
        return response()->json($response);
    }
}
