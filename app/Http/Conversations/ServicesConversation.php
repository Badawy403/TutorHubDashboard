<?php

namespace App\Http\Conversations;

use App\Models\Lawyer;
use App\Models\Service;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

class ServicesConversation extends Conversation
{
    /**
     * start the conversation
     *
     * @return mixed
     */


    protected $name = '';
    protected $age = '';
    protected $service = '';
    protected $list_of_keywords = [];

    public function __construct()
    {
        // Load keywords from the external file
        $this->list_of_keywords = require __DIR__ . '/ListOfKeywords.php';
    }



    public function run()
    {
        $this->ask('Hi there! What is your Name?', function ($answer) {
            $this->name = $answer->getText();
            $this->say('Hi! Nice to Meet You: ' . $this->name);
            $this->askAge($answer->getText());
        });
    }
    protected function askAge($name)
    {
        $this->ask($name . ' What is your Age?', function ($answer) {
            $this->age = $answer->getText();
            $this->say('Your Age is: ' . $this->age);
            $this->askService();
        });
    }
    protected function askService()
    {
        $this->ask('What services do you need?', function ($answer) {
            $this->service = $answer->getText();
            // $this->say('You need: ' . $this->service);
            $this->say('I am here to help you!');

            $matchedKeywords = [];
            $relatedOptions = [];

            // Check if list_of_keywords is an array
            if (is_array($this->list_of_keywords)) {
                // Handle categories and their related keywords
                foreach ($this->list_of_keywords as $mainKeyword => $relatedKeywords) {
                    if (is_array($relatedKeywords)) {
                        // Check if the user's service matches the main keyword or any related keywords
                        if (stripos($this->service, $mainKeyword) !== false) {
                            $matchedKeywords[] = $mainKeyword;
                            $relatedOptions = array_merge($relatedOptions, $relatedKeywords);
                        } else {
                            foreach ($relatedKeywords as $keyword) {
                                if (stripos($this->service, $keyword) !== false) {
                                    $matchedKeywords[] = $mainKeyword;
                                    $relatedOptions = array_merge($relatedOptions, $relatedKeywords);
                                    break;
                                }
                            }
                        }
                    }
                }


                foreach ($this->list_of_keywords as $keyword) {
                    if (!is_array($keyword) && stripos($this->service, $keyword) !== false) {
                        $matchedKeywords[] = $keyword;
                    }
                }

                $relatedOptions = array_unique($relatedOptions);

                if (!empty($matchedKeywords)) {
                    $this->say('You are Choose: ' . implode(', ', array_unique($matchedKeywords)));
                    if (!empty($relatedOptions)) {
                        $this->provideRelatedOptions($relatedOptions);
                    } else {
                        $this->listOfServices();
                    }
                } else {
                    $this->say('Sorry, we couldn\'t find specific services matching your input.');
                }

                // Proceed to list of services

            } else {
                $this->say('Error loading keywords.');
            }
        });
    }


    protected function provideRelatedOptions($related_options)
    {
        $uniqueOptions = array_unique($related_options);
        $question = Question::create('Would you like to narrow down your search? Here are some related options:')
            ->fallback('Unable to ask question')
            ->callbackId('related_services');

        foreach ($uniqueOptions as $option) {
            $question->addButton(Button::create($option)->value($option));
        }

        $this->ask($question, function (Answer $answer) use ($uniqueOptions) {
            if ($answer->isInteractiveMessageReply()) {
                $this->service = $answer->getValue();
                $this->say('You have chosen: ' . $this->service);
                $this->listOfServices(); // Continue to list services related to the selected option
            } else {
                $this->repeat();
            }
        });
    }

    protected function listOfServices()
    {
        $services = Service::active()->limit(5)->get();
        $questions = Question::create('List of Services');
        foreach ($services as $service) {
            $questions->addButton(Button::create($service->name)->value($service->id));
        }

        // $this->lawyerSuggestions();
        $this->ask($questions, function ($answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->say('You are choosen: ' . $answer->getValue() . 'services');
                $this->lawyerSuggestions($answer->getValue());
            } else {
                $this->repeat();
            }
            $this->say('You are choosen: ' . $answer->getValue() . 'services');
        });
    }
    protected function lawyerSuggestions($service_id)
    {
        $lawyers = Lawyer::withAll()->whereHas('lawyers_services', function ($query) use ($service_id) {
            $query->with('lawyers_services')->where('service_id', $service_id);
        })->limit(5)->get();
        $questions = Question::create('Lawyers Suggestions');
        foreach ($lawyers as $lawyer) {
            $questions->addButton(Button::create($lawyer->name)->value($lawyer->id));

            $message = OutgoingMessage::create('Name: ' . $lawyer['name'] . "<br/>" . 'Profile: <a href="' . url('/lawyer/profile/' . $lawyer->user_name) . '">View Profile</a>');
            $this->say($message);
        }
        $this->ask($questions, function ($answer) {

            if ($answer->isInteractiveMessageReply()) {
                $this->say('You are choosen: ' . $answer->getValue() . 'lawyer');
            } else {
                $this->repeat();
            }
        });
    }
}
