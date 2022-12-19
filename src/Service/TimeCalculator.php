<?php

namespace App\Service;

use DateTimeInterface;
use Symfony\Component\Messenger\Stamp\DelayStamp;

final class TimeCalculator
{
    public function calculate(?DateTimeInterface $currentTime, ?DateTimeInterface $targetTime): DelayStamp
    {
        if ($targetTime === null) {
            return new DelayStamp(0);
        }

        $delay = $targetTime->getTimestamp() - $currentTime->getTimestamp();

        if ($delay < 0) {
            $delay = 0;
        }

        return new DelayStamp($delay * 1000);
    }
}
