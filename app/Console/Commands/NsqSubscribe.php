<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use NSQClient\Access\Endpoint;
use NSQClient\Message\Message;
use NSQClient\Queue;

class NsqSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nsq:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'nsq消费者';

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
        $topic = 'test';
        $channel = 'c1';
        $endpoint = new Endpoint('http://127.0.0.1:4161');
        Queue::subscribe($endpoint, $topic, $channel, function (Message $message) {
            $this->info($message->id());
            $message->done();
        });
    }
}
