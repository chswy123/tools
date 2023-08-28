<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class RedisBlockList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:block-list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'redis阻塞队列';

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
        while (true) {
            dump(date('Y-m-d H:i:s'));

            $result = Redis::blpop('test', 10);
            dump($result);


            dump(date('Y-m-d H:i:s'));

            $this->info('##############');
            sleep(2);

        }
    }
}
