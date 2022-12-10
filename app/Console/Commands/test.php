<?php

namespace App\Console\Commands;

use App\Services\ZKLibrary;
use App\Services\ZkService\TAD;
use App\Services\ZkService\TADFactory;
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

        // $zk = new ZKLibrary($ip, $port);
        // $zk->connect();
        // $this->warn($zk->getSerialNumber());
        // $this->warn($zk->getFirmwareVersion());
        // $this->warn($zk->getWorkCode());
        // $atendance = $zk->getAttendance();

        // $this->warn("Total: " . count($atendance));
        // foreach ($atendance as $attendance) {
        //     print_r($attendance);
        // }

        $options = [
            'ip' => $ip,   // '169.254.0.1' by default (totally useless!!!).
            'internal_id' => 1,    // 1 by default.
            'com_key' => 0,        // 0 by default.
            'description' => 'TAD1', // 'N/A' by default.
            'soap_port' => 80,     // 80 by default,
            'udp_port' => 4370,      // 4370 by default.
            'encoding' => 'utf-8'    // iso8859-1 by default.
        ];

        $tad_factory = new TADFactory($options);
        $tad = $tad_factory->get_instance();

        // $comands = TAD::commands_available();
        // print_r($comands);
        $serialNumber = $tad->get_serial_number();

        print_r($serialNumber);

        return Command::SUCCESS;
    }
}
