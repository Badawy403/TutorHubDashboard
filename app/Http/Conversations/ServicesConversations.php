<?php

namespace App\Http\Conversations;

use App\Models\AcademyCategory;
use App\Models\Academy;

use App\Models\Teacher;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\TeacherCategory;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use Exception;
use Illuminate\Support\Facades\Log;

class ServicesConversations extends Conversation
{
    /**
     * Start the conversation
     *
     * @return mixed
     */

    protected $name = '';
    protected $email = '';
    protected $service = '';
    protected $list_of_keywords = [];

    public function __construct()
    {
        // Load keywords from the external file
        $this->list_of_keywords = require __DIR__ . '/ListOfKeywords.php';
    }

    public function run()
    {
        $this->ask('Hi there! What is your Name?', function (Answer $answer) {
            $this->name = $answer->getText();
            if (empty($this->name)) {
                $this->say('Name cannot be empty.');
                return $this->repeat();
            }
            $this->say('Hi! Nice to meet you, ' . $this->name);
            $this->askEmail();
        });
    }

    public function askEmail()
    {
        $this->ask('What is your Email?', function (Answer $answer) {
            $this->email = $answer->getText();
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->say('Please enter a valid email address.');
                return $this->repeat();
            }
            $this->askForOptions();
        });
    }

    protected function askForOptions()
    {

        $questions = Question::create('Please Select your needy Option?')
            ->fallback('Unable to ask question')->addButtons([
                Button::create('I need a Teacher')->value('teacher'),
                Button::create('I need an Academy')->value('academy'),
                Button::create('I need a Service')->value('service'),
            ]);
        $this->ask($questions, function (Answer $answer) {
            if (!$answer->isInteractiveMessageReply()) {
                $this->say('Please select an option.');
                return $this->repeat();
            }
            $selected_option = $answer->getValue();
            $this->say('You selected : ' . $selected_option);
            if ($selected_option == 'teacher') {
                $this->askTeacherCategories();
            } elseif ($selected_option == 'academy') {
                $this->askAcademyCategories();
            } else {
                $this->askServiceCategories();
            }
        });
    }

    protected function askTeacherCategories()
    {
        try {
            $teacher_categories = TeacherCategory::active()->get();
            if ($teacher_categories->isEmpty()) {
                $this->say('No teacher categories available at the moment.');
                return;
            }

            $questions = Question::create('Which type of teacher do you want?')
                ->fallback('Unable to ask question');

            foreach ($teacher_categories as $student_category) {
                $questions->addButton(Button::create($student_category->name)->value($student_category->id));
            }

            $this->ask($questions, function (Answer $answer) {
                if (!$answer->isInteractiveMessageReply()) {
                    $this->say('Please select a teacher category.');
                    return $this->repeat();
                }

                $selectedCategoryId = $answer->getValue();
                $this->say('You selected category ID: ' . $selectedCategoryId);
                $this->teacherSuggestions($selectedCategoryId, 'category');
            });
        } catch (Exception $e) {
            $this->say('An error occurred while retrieving service categories. Please try again later.');
            Log::error('Error fetching service categories: ' . $e->getMessage());
        }
    }


    protected function askAcademyCategories()
    {
        try {
            $academy_categories = AcademyCategory::active()->get();
            if ($academy_categories->isEmpty()) {
                $this->say('No academy categories available at the moment.');
                return;
            }

            $questions = Question::create('Which type of academy do you want?')
                ->fallback('Unable to ask question');

            foreach ($academy_categories as $academy_category) {
                $questions->addButton(Button::create($academy_category->name)->value($academy_category->id));
            }

            $this->ask($questions, function (Answer $answer) {
                if (!$answer->isInteractiveMessageReply()) {
                    $this->say('Please select a academy category.');
                    return $this->repeat();
                }

                $selectedCategoryId = $answer->getValue();
                $this->say('You selected category ID: ' . $selectedCategoryId);
                $this->academySuggestions($selectedCategoryId);

            });
        } catch (Exception $e) {
            $this->say('An error occurred while retrieving service categories. Please try again later.');
            Log::error('Error fetching service categories: ' . $e->getMessage());
        }
    }





    protected function askServiceCategories()
    {
        try {
            $service_categories = ServiceCategory::all();
            if ($service_categories->isEmpty()) {
                $this->say('No service categories available at the moment.');
                return;
            }

            $questions = Question::create('Which type of service do you want?')
                ->fallback('Unable to ask question');

            foreach ($service_categories as $service_category) {
                $questions->addButton(Button::create($service_category->name)->value($service_category->id));
            }

            $this->ask($questions, function (Answer $answer) {
                if (!$answer->isInteractiveMessageReply()) {
                    $this->say('Please select a service category.');
                    return $this->repeat();
                }

                $selectedCategoryId = $answer->getValue();
                $this->say('You selected category ID: ' . $selectedCategoryId);
                $this->askService($selectedCategoryId);
            });
        } catch (Exception $e) {
            $this->say('An error occurred while retrieving service categories. Please try again later.');
            Log::error('Error fetching service categories: ' . $e->getMessage());
        }
    }

    protected function askService($selectedCategoryId)
    {
        try {
            $services = Service::where('service_category_id', $selectedCategoryId)->get();
            if ($services->isEmpty()) {
                $this->say('No services available for this category.');
                return;
            }

            $questions = Question::create('List of Services');

            foreach ($services as $service) {
                $questions->addButton(Button::create($service->name)->value($service->id));
            }

            $this->ask($questions, function (Answer $answer) {
                if (!$answer->isInteractiveMessageReply()) {
                    $this->say('Please select a service.');
                    return $this->repeat();
                }

                $service_id = $answer->getValue();
                $this->say('You selected Service ID: ' . $service_id);
                $this->teacherSuggestions($service_id, 'service');
            });
        } catch (Exception $e) {
            $this->say('An error occurred while retrieving services. Please try again later.');
            Log::error('Error fetching services: ' . $e->getMessage());
        }
    }

    protected function teacherSuggestions($id, $type)
    {
        try {
            $teachers = Teacher::limit(5);
            if ($type == 'category') {
                $teachers->whereHas('teacher_categories', function ($query) use ($id) {
                    $query->where('teacher_category_id', $id);
                });
            } else {
                $teachers = $teachers->has('teacher_services');
            }
            $teachers = $teachers->get();

            if ($teachers->isEmpty()) {
                $this->say('No teachers found for this service.');
                return;
            }


            $listItems = '';
            $this->say('list of Teachers: ');
            foreach ($teachers as $teacher) {
                $listItems .= '<li>Name: <a href="' . url('/teacher/profile/' . $teacher->user_name) . '" target="_blank">' . $teacher->name . '</a></li>';
            }
            $messageContent = '<ul>' . $listItems . '</ul>';
            $message = OutgoingMessage::create($messageContent);
            $this->say($message);
        } catch (Exception $e) {
            $this->say('An error occurred while retrieving teachers. Please try again later.');
            Log::error('Error fetching teachers: ' . $e->getMessage());
        }
    }

    protected function academySuggestions($id)
    {
        try {
            $academies = Academy::limit(5);
            $academies->whereHas('acedemy_categories', function ($query) use ($id) {
                $query->where('acedemy_id', $id);
            });

            $academies = $academies->get();

            if ($academies->isEmpty()) {
                $this->say('No academies found for this service.');
                return;
            }

            $listItems = '';
            $this->say('list of academies: ');
            foreach ($academies as $academy) {
                $listItems .= '<li>Name: <a href="' . url('/academy/profile/' . $academy->user_name) . '" target="_blank">' . $academy->name . '</a></li>';
            }
            $messageContent = '<ul>' . $listItems . '</ul>';
            $message = OutgoingMessage::create($messageContent);
            $this->say($message);
        } catch (Exception $e) {
            $this->say('An error occurred while retrieving academies. Please try again later.');
            Log::error('Error fetching academies: ' . $e->getMessage());
        }
    }
}
