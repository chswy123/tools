<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Swoole\Runtime;
use Swoole\Coroutine;
use function Swoole\Coroutine\run;

class SwoolePlay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swoole:play';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
//        $this->testA();
//        $this->testB();
        $this->testC();
    }

    private function testC()
    {

        echo "main start\n";
        run(function () {
            echo "coro " . Coroutine::getcid() . " start\n";
            Coroutine::create(function () {
                echo "coro " . Coroutine::getcid() . " start\n";
                Coroutine::sleep(.2);
                echo "coro " . Coroutine::getcid() . " end\n";
            });
            echo "coro " . Coroutine::getcid() . " do not wait children coroutine\n";
            Coroutine::sleep(.3);
            echo "coro " . Coroutine::getcid() . " end\n";
        });
        echo "end\n";

    }

    private function testB()
    {
        Runtime::enableCoroutine();
        $s = microtime(true);

        go(function () {
            for ($c = 100; $c--;) {
                Coroutine::create(function () {
                    for ($n = 100; $n--;) {
                        echo $n . PHP_EOL;
                        usleep(1000);
//                        sleep(2);
                    }
                });
            }
        });

        echo 'use ' . (microtime(true) - $s) . ' s';

    }

    private function testA()
    {

        Runtime::enableCoroutine();
        $s = microtime(true);

        run(function() {
            for ($c = 100; $c--;) {
                Coroutine::create(function () {
                    for ($n = 100; $n--;) {
                        echo $n . PHP_EOL;
                        usleep(1000);
//                        sleep(2);
                    }
                });
            }
        });

        echo 'use ' . (microtime(true) - $s) . ' s';

    }
}
