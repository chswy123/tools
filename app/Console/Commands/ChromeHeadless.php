<?php

namespace App\Console\Commands;

use HeadlessChromium\BrowserFactory;
use Illuminate\Console\Command;

class ChromeHeadless extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'other:chrome-headless';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '无头浏览器';

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
        $browserFactory = new BrowserFactory();

        $browserFactory->setOptions([
            'windowSize' => [1920, 1000],
        ]);

        $browserFactory->addOptions(['noSandbox' => true]);
        $browserFactory->addOptions(['enableImages' => true]);

        $browser = $browserFactory->createBrowser();

        $page = $browser->createPage();

        $page->navigate('https://www.baidu.com/')->waitForNavigation();

        $page->screenshot()->saveToFile('test.png');

        $browser->close();

    }
}
