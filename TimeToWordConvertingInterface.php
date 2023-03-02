<?php

namespace TimeToWordConverter;

interface TimeToWordConvertingInterface
{
    public function convert(int $hours, int $minutes);
}
