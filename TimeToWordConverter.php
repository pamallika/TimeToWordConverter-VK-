<?php

namespace TimeToWordConverter;

use DictionaryTime\DictionaryTime;
class TimeToWordConverter implements TimeToWordConvertingInterface
{
    public function convert(int $hours, int $minutes)
    {
        $dictionary = new DictionaryTime();

    }
}
