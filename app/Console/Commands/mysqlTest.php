<?php

namespace App\Console\Commands;

use App\Models\Procedure\Test1;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class mysqlTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mysql:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '测试一些Mysql用法';

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
        $this->procedureTest();
    }

    /*
     * 调用存储过程
     */
    private function procedureTest()
    {

        DB::select('CALL test1(?, ?, @res)', [2, 3]);
        $res = DB::select('SELECT @res as res');
//        $res = DB::select('SELECT @res as res')[0]->res;
        dd($res);
    }

}
