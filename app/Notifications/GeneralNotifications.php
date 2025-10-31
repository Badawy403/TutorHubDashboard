<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GeneralNotifications extends Notification
{
    use Queueable;

    public $data;
    public $notification_setting_name;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data,$notification_setting_name)
    {
        $this->data = $data;
        $this->notification_setting_name = $notification_setting_name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $statusDescription = '';

        if($this->notification_setting_name == 'new_appointment_registration'){
            return (new MailMessage)
            ->subject('TutorHub Consultation Portal')
            ->markdown('emails.general.appointment_book', ['appointment' => $this->data]);
        }
        if($this->notification_setting_name == 'change_appointment_status'){
            return (new MailMessage)
            ->subject('TutorHub Consultation Portal')
            ->markdown('emails.general.appointment_status', ['appointment' => $this->data]);
        }
        if($this->notification_setting_name == 'change_password') {
            return (new MailMessage)
            ->subject('TutorHub Consultation Portal')
            ->markdown('emails.general.change_password', ['appointment' => $this->data]);
        }
        if($this->notification_setting_name == 'new-signup-academy') {
            return (new MailMessage)
            ->subject('TutorHub Consultation Portal')
            ->markdown('emails.general.signup', ['appoint' => $this->data]);
        }
        if($this->notification_setting_name == 'approve_or_reject_student') {
            return (new MailMessage)
            ->subject('TutorHub Consultation Portal')
            ->markdown('emails.general.approve_or_reject', ['student' => $this->data]);
        }
        if($this->notification_setting_name == 'approve_or_reject_tutor') {
            return (new MailMessage)
            ->subject('TutorHub Consultation Portal')
            ->markdown('emails.general.approve_or_reject_tutor', ['tutor' => $this->data]);
        }
        if($this->notification_setting_name == 'user') {
            return (new MailMessage)
            ->subject('TutorHub Consultation Portal')
            ->markdown('emails.AppointmentNotification', ['appointment' => $this->data]);
        }
        if($this->notification_setting_name == 'before_hour_appointment_notification'){

            return (new MailMessage)
            ->subject('TutorHub Consultation Portal')
            ->markdown('emails.general.appointment_book', ['appointment' => $this->data]);
        }
        if($this->notification_setting_name == 'book_quick_service'){

            return (new MailMessage)
            ->subject('TutorHub Consultation Portal')
            ->markdown('emails.general.book_service', ['service' => $this->data]);
        }


    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
