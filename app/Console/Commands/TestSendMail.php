<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestSendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-send-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = ['name' => 'Truong PC'];

        Mail::send('mail', $data, function ($message){
            $message->to('truongpcph43675@fpt.edu.vn','Phí Công Trường')
            ->subject('Laravel Basic Testing Mail');
        });
    }
}
