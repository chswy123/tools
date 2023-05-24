<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class NestedTransaction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mysql:nested-transaction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'mysql嵌套事务';

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
        DB::beginTransaction();

        try {
            // 第一层事务操作
            DB::table('common_channel_config')->where('id', 10236)->update(['name' => '嵌套事务111']);

            DB::beginTransaction();

            try {
                // 第二层事务操作
                DB::table('common_channel_config')->where('id', 10236)->update(['name' => '嵌套事务222']);

                DB::commit(); // 提交第二层事务
//                DB::rollback(); // 回滚第二层事务

            } catch (\Exception $e) {
                DB::rollback(); // 回滚第二层事务
                throw $e;
            }

            DB::commit(); // 提交第一层事务
        } catch (\Exception $e) {
            DB::rollback(); // 回滚第一层事务
            throw $e;
        }

        $this->info('done');

    }
}
