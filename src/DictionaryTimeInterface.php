<?php

namespace src;

interface DictionaryTimeInterface
{
    public function getDictionaryAfterHours(int $hour): string;
    public function getDictionaryBeforeHours(int $hour): string;
    public function getDictionaryHalfHours(int $hour): string;
    public function dictionaryMinutes(int $minute): string;
    public function getHours(int $hours, bool $before): string;
    public function getDictionaryTotalHours(int $hour): string;
}