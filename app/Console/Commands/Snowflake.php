<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Snowflake extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'algorithm:snowflake';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '雪花算法生成uuid';

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
        $uuid = app('snowflake')->id();
        dd($uuid);
    }
}
