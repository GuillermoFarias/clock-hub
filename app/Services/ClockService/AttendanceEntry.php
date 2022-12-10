<?php

namespace App\Services\ClockService;

class AttendandeEntry
{
    private string $pin = '';
    private string $date = '';
    private string $time = '';
    private string $status = '';
    private string $workCode = '';

    /**
     * @param  string $pin
     * @param  string $date
     * @param  string $time
     * @param  string $status
     * @param  string $workCode
     * @return void
     */
    public function __construct(string $pin, string $date, string $time, string $status, string $workCode)
    {
        $this->pin = $pin;
        $this->date = $date;
        $this->time = $time;
        $this->status = $status;
        $this->workCode = $workCode;
    }
}
