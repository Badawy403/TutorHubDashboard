<?php

namespace App\Http\Controllers;

use App\Http\Conversations\ServicesConversation;
use App\Http\Conversations\ServicesConversations;
use App\Http\Resources\Web\LawyersResource;
use App\Models\Lawyer;
use App\Models\User;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

class BotManController extends Controller
{




    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function ($botman, $message) {

            if ($message == 'hi' || $message == 'Hi' || $message == 'hello' || $message == 'Hello' || $message == 'Hlo' || $message == 'hlo' ) {
                $botman->startConversation(new ServicesConversations);
            } else {
                $botman->reply("write 'hi' for testing...");
            }
        });

        $botman->listen();
    }

    /**
     * Place your BotMan logic here.
     */
    public function startConversation($botman)
    {
        $botman->hears('help',function($bot){
            $bot->startConversation(new ServicesConversation);
        });
        // $botman->ask('Hello! What is your Name?', function (Answer $answer) {
        //     $name = $answer->getText();
        //     $this->say('Nice to meet you ' . $name);
        // });
    }
}
