<?php

namespace App\Console\Commands;

use App\Services\ZKLibrary;
use Illuminate\Console\Command;
use App\Services\ZkService\ZktecoLib;

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

        $zk = new ZKLibrary($ip, $port);
        $zk->connect();
        $this->warn($zk->getSerialNumber());
        $this->warn($zk->getFirmwareVersion());
        $this->warn($zk->getWorkCode());
        $atendance = $zk->getAttendance();

        $this->warn("Total: " . count($atendance));
        foreach ($atendance as $attendance) {
            print_r($attendance);
        }

        return Command::SUCCESS;
    }
}
