<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use RedLock\RedLock;

class RedisRedlock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:redlock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'redis的红锁';

    /**
     * Create a new command instance.
     *
     * @return voidx
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
        // 传入实例化redis方式
//        $server = new \Redis;
//        $server->connect('127.0.0.1', 6381);
//        $server->auth('12345');


        $servers = [
//            $server,
            ['localhost', 6380, 0.1], // ip 端口 连接超时时间(s)
            ['localhost', 6381, 0.1],
            ['localhost', 6382, 0.1],
        ];

        try {
            // 实例化红锁
            $redlock = new RedLock($servers);

            // 上锁
            $lock = $redlock->lock('my_resource_name', 30000);
            dump($lock);

            // 业务逻辑部分....

            // 解锁
            $redlock->unlock($lock);

        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
            return;
        }

    }
}
