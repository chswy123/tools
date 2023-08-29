<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Php8Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'php8:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'php8新特性的测试';

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

//        dd($this::class);
//        $this->learnMatch();
        $this->learnNewFunc();
    }

    /**
     * Notes: match的用法
     * Author: WangYue
     * @return void
     */
    public function learnMatch()
    {
        $name = match(2) {
            1 => 'aaa',
            2 => 'bbb',
            default => 'ccc',
        };

        dd($name);

    }

    public function learnNewFunc()
    {
        $a = 'hello php';
        $b = 'hp';
        dump(str_contains($a, $b));

        dump(str_starts_with($a, $b));

        dump(str_ends_with($a, $b));
        die;

    }

}
