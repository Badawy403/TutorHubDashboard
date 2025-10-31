<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Notifications\SuperAdmin\ContactFormEmail;
use Illuminate\Support\Facades\Notification;

class ContactsController extends Controller
{
    public function __construct()
    {
    }

    /*********Store Testimonial  ***********/
    public function contact(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required|string',
        ]);
        $data = $request->all();
        $settings = generalSettings();
        $support_email = $settings['contact_us_email'] ?? 'support@example.com';
        $contact = Contact::create($data);
        Notification::route('mail', $support_email)
            ->notify(new ContactFormEmail($data));

        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Contact Form Submitted Successfully',
        ]);
        return redirect()->back();
    }
    /*********Store Testimonial  ***********/
    public function contact_api(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required|string',
        ]);
        $data = $request->all();
        $settings = generalSettings();
        $support_email = $settings['contact_us_email'] ?? 'support@example.com';
        $contact = Contact::create($data);
        Notification::route('mail', $support_email)
            ->notify(new ContactFormEmail($data));

        $response = generateResponse(null, true, "Contact Form Submitted Successfully", null, 'collection');
        return response()->json($response);
    }
}
