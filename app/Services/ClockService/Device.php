<?php

namespace App\Services\ClockService;

use App\Services\ClockService\TadConnector\TAD;
use App\Services\ClockService\TadConnector\TADFactory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Device
{
    private string $ip = '';
    private int $internalId = 1;
    private int $comKey = 0;
    private string $description = 'N/A';
    private int $soapPort = 80;
    private int $udpPort = 4370;
    private string $encoding = 'utf-8';
    private TAD $tadInstance;

    /**
     * @param  string $ip
     * @param  int $port = 4370
     * @return void
     */
    public function __construct(string $ip, int $port = 4370)
    {
        $this->ip = $ip;
        $this->udpPort = $port;
    }

    /**
     * connect to device
     *
     * @return bool
     */
    public function connect(): bool
    {
        try {
            $tadFactory = new TADFactory([
                'ip' => $this->ip,
                'internal_id' => $this->internalId,
                'com_key' => $this->comKey,
                'description' => $this->description,
                'soap_port' => $this->soapPort,
                'udp_port' => $this->udpPort,
                'encoding' => $this->encoding
            ]);

            $this->tadInstance = $tadFactory->get_instance();

            if (!$this->tadInstance->is_alive()) {
                return false;
            }

            if ($this->tadInstance->get_serial_number()->is_empty_response()) {
                return false;
            }

            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }

        return false;
    }

    /**
     * get ip
     *
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * get attendances from device
     *
     * @return array
     */
    public function getAttendances(): array
    {
        $attendances = $this->tadInstance->get_att_log();
        return $this->wrapAttendances($attendances->to_array());
    }

    /**
     * get attendances from device by date
     *
     * @return array
     */
    public function getAttendancesOfDate(Carbon $date): array
    {
        $attendances = $this->tadInstance->get_att_log();
        $attendances = $attendances->filter_by_date([
            'start' => $date->format('Y-m-d'),
            'end' => $date->format('Y-m-d')
        ]);

        return $this->wrapAttendances($attendances->to_array());
    }

    /**
     * get attendances from device by date
     *
     * @return array
     */
    public function getAttendancesOfToday(): array
    {
        return $this->getAttendancesOfDate(Carbon::now());
    }

    /**
     * wrapAttendances
     *
     * @param  array $attendances
     * @return array
     */
    private function wrapAttendances(array $attendances): array
    {
        return array_map(function ($attendance) {
            return new AttendanceEntry(
                $attendance['PIN'],
                $attendance['DateTime'],
                $attendance['Status'],
                $attendance['Verified'],
                $attendance['WorkCode']
            );
        }, $attendances);
    }
}
