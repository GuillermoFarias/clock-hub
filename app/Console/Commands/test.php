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

        $zk = new ZKLibrary($ip, $port);
        $zk->connect();
        $this->warn($zk->getSerialNumber());
        $this->warn($zk->getFirmwareVersion());
        $this->warn($zk->getWorkCode());

        $start_time = microtime(true);
        $atendance = $zk->getAttendance();
        $end_time = microtime(true);
        $execution_time = ($end_time - $start_time);
        echo "1 - Time = " . $execution_time . " sec";

        // $this->warn("Total: " . count($atendance));


        $options = [
            'ip' => $ip,
            'internal_id' => 1,         // 1 by default.
            'com_key' => 0,             // 0 by default.
            'description' => 'TAD1',    // 'N/A' by default.
            'soap_port' => 80,          // 80 by default,
            'udp_port' => $port,        // 4370 by default.
            'encoding' => 'utf-8'       // iso8859-1 by default.
        ];

        $tad_factory = new TADFactory($options);
        $tad = $tad_factory->get_instance();

        // $comands = TAD::commands_available();
        // print_r($comands);
        // $serialNumber = $tad->get_serial_number();

        // print_r($serialNumber->to_json());

        $start_time = microtime(true);
        $att_logs = $tad->get_att_log();
        $end_time = microtime(true);
        $execution_time = ($end_time - $start_time);
        echo "2 - Time = " . $execution_time . " sec";

        // Now, you want filter the resulset to get att logs between '2014-01-10' and '2014-03-20'.
        // $filtered_att_logs = $att_logs->filter_by_date(
        //     ['start' => '2022-12-09', 'end' => '2022-12-09']
        // );


        // print_r($filtered_att_logs->to_array());

        return Command::SUCCESS;
    }
}
