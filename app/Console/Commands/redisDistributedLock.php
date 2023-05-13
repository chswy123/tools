<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class redisDistributedLock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:distributed-lock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'redis分布式锁';

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
     */
    public function handle()
    {
        $uuid = random_int(1, 1000000);
        $uuid = time() . $uuid;

        $lockKey = 'my_lock';
        $lock = Redis::set($lockKey, $uuid, 'EX', 5, 'NX');
        if ($lock === false) {
            $this->error('获取锁失败');
            die;
        }

        // 业务逻辑部分

        if (Redis::get($lockKey) == $uuid) {
            Redis::del($lockKey);
        }

        $this->info('done');

    }
}
