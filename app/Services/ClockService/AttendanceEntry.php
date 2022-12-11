<?php

namespace App\Services\ClockService;

use Carbon\Carbon;

class AttendandeEntry
{
    private string $pin = '';
    private string $dateTime = '';
    private string $verified = '';
    private string $status = '';
    private string $workCode = '';

    /**
     * @param  string $pin
     * @param  string $dateTime
     * @param  string $verified
     * @param  string $status
     * @param  string $workCode
     * @return void
     */
    public function __construct(string $pin, string $dateTime, string $verified, string $status, string $workCode)
    {
        $this->pin = $pin;
        $this->dateTime = $dateTime;
        $this->verified = $verified;
        $this->status = $status;
        $this->workCode = $workCode;
    }

    /**
     * get pin
     *
     * @return string
     */
    public function getPin(): string
    {
        return $this->pin;
    }

    /**
     * get date time
     *
     * @return string
     */
    public function getDateTime(): string
    {
        return $this->dateTime;
    }

    /**
     * get verified
     *
     * @return string
     */
    public function getVerified(): string
    {
        return $this->verified;
    }

    /**
     * get status
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * get work code
     *
     * @return string
     */
    public function getWorkCode(): string
    {
        return $this->workCode;
    }

    /**
     * get date time as carbon
     *
     * @return Carbon
     */
    public function getDateTimeAsCarbon(): Carbon
    {
        return Carbon::parse($this->dateTime);
    }
}
