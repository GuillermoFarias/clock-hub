<?php

namespace App\Console\Commands;

use App\Services\ClockService\Device;
use App\Services\ZKLibrary;
use App\Services\ClockService\TadConnector\TAD;
use App\Services\ClockService\TadConnector\TADFactory;
use Illuminate\Console\Command;
use App\Services\ClockService\TadConnector\ZktecoLib;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ip = "192.168.2.251";
        $port = 4370;

        $device = new Device($ip, $port);

        if (!$device->connect()) {
            echo "Device not connected" . PHP_EOL;
            return Command::FAILURE;
        }

        $start_time = microtime(true);
        $attLogs = $device->getAttendances();
        $end_time = microtime(true);

        echo "Time: " . ($end_time - $start_time) . PHP_EOL;

        print_r($attLogs);

        return Command::SUCCESS;
    }
}
