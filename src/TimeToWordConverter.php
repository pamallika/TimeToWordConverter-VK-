<?php

namespace src;

use src\Exceptions\DateTimeException;
use src\Exceptions\Exception;

class TimeToWordConverter implements TimeToWordConvertingInterface
{
    /**
     * @throws Exception
     */
    public function convert(int $hours, int $minutes): string
    {
        if ($hours < 0 || $minutes < 0) {
            throw new DateTimeException("Некорректное время");
        }
        if ($hours > 24 || $minutes > 60) {
            throw new DateTimeException("Некорректное время");
        }
        //В условиях задания указано что на вход будет не более 12 часов, поэтому проверяю именно так
        //Также легко можно реализовать решение и с 24 часами, if ($hours > 12) -> $hours - 12
        //И это число уже можно передать в мапу(dictionary) и получить ответ.
        try {
            $dictionary = new DictionaryTime();
            $remained = $minutes;
            $nextHour = $hours;
            $before = false;

            switch ($minutes) {
                case 0 :
                    if ($hours === 1) {
                        $postfix = 'час';
                    } elseif ($hours < 5 && $hours !== 0) {
                        $postfix = 'часа';
                    } else {
                        $postfix = 'часов';
                    }
                    $TimeStr = mb_convert_case($dictionary->getDictionaryTotalHours($hours), MB_CASE_TITLE, "UTF-8");
                    return "$TimeStr $postfix";
                case 30:
                    $hourStr = $dictionary->getDictionaryHalfHours($hours + 1);
                    return "Половина $hourStr";
                case 60:
                    $hours = $hours + 1;
                    //Решил не выносить за switch, т.к. может повториться только в двух случаях
                    //case = 0 || 60 не сработает т.к. для 60 нужно $hours + 1
                    //Думаю пусть лучше небольшой участок кода повторится, чем в case 0 || 60 добавлять проверку на 60
                    if ($hours === 1) {
                        $postfix = 'час';
                    } elseif ($hours < 5 && $hours !== 0) {
                        $postfix = 'часа';
                    } else {
                        $postfix = 'часов';
                    }
                    $TimeStr = mb_convert_case($dictionary->getDictionaryTotalHours($hours), MB_CASE_TITLE, "UTF-8");
                    return "$TimeStr $postfix";
                case $minutes > 30:
                    /** @var bool $before
                     * Флаг обозначающий половину часа
                     */
                    $before = true;
                    $remained = 60 - $minutes;
                    $nextHour++;
                    break;

            }

            if ($remained < 20) {
                $minutesStr = $dictionary->dictionaryMinutes($remained);
                $minutesStr = mb_convert_case($minutesStr, MB_CASE_TITLE, "UTF-8");
            } else {
                //Из int минут делаю array, чтобы отделить десятки и минуты и передаю их в мапу
                $minutesArr = str_split($remained);
                $minutesTen = $minutesArr[0] * 10;
                $minute = $minutesArr[1];
                $minutesTen = $dictionary->dictionaryMinutes($minutesTen);
                $minute = $dictionary->dictionaryMinutes($minute);
                $minutesTen = mb_convert_case($minutesTen, MB_CASE_TITLE, "UTF-8");
                $minutesStr = "$minutesTen $minute";
            }


            //Обработка часов
            $hoursStr = $dictionary->getHours($nextHour, $before);

            if ($remained > 4) {
                $minutesStr = "$minutesStr минут";
            } elseif ($remained === 1) {
                $minutesStr = "$minutesStr минута";
            } else {
                $minutesStr = "$minutesStr минуты";
            }
            if ($minutes > 30) {
                $TimeStr = $minutesStr . " до $hoursStr";
            } else {
                $TimeStr = $minutesStr . " после $hoursStr";
            }
            return $TimeStr;
        } catch (\Error $message) {
            throw new DateTimeException("Некорректное время");
        }
    }
}
