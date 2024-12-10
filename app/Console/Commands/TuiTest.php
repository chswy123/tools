<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpTui\Tui\DisplayBuilder;
use PhpTui\Tui\Extension\Core\Widget\BarChart\BarGroup;
use PhpTui\Tui\Extension\Core\Widget\BarChartWidget;
use PhpTui\Tui\Extension\Core\Widget\BlockWidget;
use PhpTui\Tui\Extension\Core\Widget\GridWidget;
use PhpTui\Tui\Model\Direction;
use PhpTui\Tui\Model\Layout\Constraint;
use PhpTui\Tui\Model\Style;
use PhpTui\Tui\Model\Text\Line;
use PhpTui\Tui\Model\Text\Title;
use PhpTui\Tui\Model\Widget\Borders;
use function Symfony\Component\Translation\t;

class TuiTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tui:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'php-tui测试';

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
        $display = DisplayBuilder::default()->build();

        while (true) {
            $display->draw(
                BarChartWidget::default()
                    ->barWidth(10)
                    ->barStyle(Style::default()->white())
                    ->groupGap(5)
                    ->data(
                        BarGroup::fromArray([
                            '1' => mt_rand(1, 30),
                            '2' => mt_rand(1, 30),
                            '3' => mt_rand(1, 30),
                        ])->label(Line::fromString('md5')),
                        BarGroup::fromArray([
                            '1' => mt_rand(1, 50),
                            '2' => mt_rand(1, 50),
                            '3' => mt_rand(1, 50),
                        ])->label(Line::fromString('sha256')),
                    )
            );
            sleep(5);
        }

    }
}
