<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laradevsbd\Zkteco\Http\Library\ZktecoLib;

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

        $zk = new ZktecoLib($ip, $port);
        $zk->connect();
        $this->warn($zk->serialNumber());
        return Command::SUCCESS;
    }
}
