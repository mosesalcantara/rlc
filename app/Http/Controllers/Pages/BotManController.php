<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BotManController extends Controller
{
    public function botman() {
        $botman = app('botman');
   
        $botman->hears('{message}', function($botman, $message) {
   
            if ($message == 'hi') {
                $this->ask_retail_status($botman);
            }
            
            else{
                $botman->reply("Start a conversation by saying hi.");
            }
   
        });
   
        $botman->listen();
    }

    public function ask_retail_status($botman)
    {
        $botman->ask('For Sale or For Lease', function(Answer $answer) {
            $retail_status = $answer->getText();
        });
    }
}
