<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Conversations\UnitConversation;

class BotManController extends Controller
{
    public function botman() {
        $botman = app('botman');
   
        $botman->hears('{message}', function($botman, $message) {
   
            if ($message == 'hi') {
                $this->ask_category($botman);
            }
            
            else{
                $botman->reply("Start a conversation by saying hi.");
            }
   
        });
   
        $botman->listen();
    }
    
    public function ask_category($botman)
    {
        $botman->ask('What are you looking for?', function($answer) {
   
            $category = $answer->getText();
   
            if ($category == 'units') {
                $this->say("Okay searching $category");
            }
        });
    }
}
