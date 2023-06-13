<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use NSQClient\Access\Endpoint;
use NSQClient\Message\Message;
use NSQClient\Queue;

class NsqPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nsq:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'nsq的消息推送';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        try {
            $topic = 'test';
            $endpoint = new Endpoint('http://127.0.0.1:4161');
            $message = new Message('hello world');
            $result = Queue::publish($endpoint, $topic, $message);
        } catch (\Exception $e) {
            dd($e->getMessage(), $e->getLine());
        }


        dd($result);

    }
}
