<?php

namespace src;

use src\exception\BaseException as Exception;

class TimeToWordConverter implements TimeToWordConvertingInterface
{
    public function convert(int $hours, int $minutes): string
    {
        //В условиях задания указано что на вход будет не более 12 часов, поэтому проверяю именно так
        //Также легко можно реализовать решение и с 24 часами, if ($hours > 12) -> $hours - 12
        //И это число уже можно передать в мапу(dictionary) и получить ответ.
        try {
            $dictionary = new DictionaryTime();
            $remained = $minutes;
            $nextHour = $hours;
            $before = false;

            //Обработка исключений
            switch ($minutes) {
                case 0:
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
                case $minutes > 30:
                    $remained = 60 - $minutes;
                    /** @var bool $before
                     * Флаг обозначающий половину часа
                     */
                    $before = true;
                    $nextHour++;
                    break;
            }

            if ($remained < 20) {
                $minutesStr = $dictionary->dictionaryMinutes($remained);
                $minutesStr = mb_convert_case($minutesStr, MB_CASE_TITLE, "UTF-8");
            } else {
                //Из int минут делаю array чтобы отделить десятки и минуты и передаю их в мапу
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
            /** Выше я уже работал с минутами, мог бы там и определить "до" или "после",
             * чтобы немного повысить производительность и это было бы правильнее. Но, думаю, это ухудшит читабельность кода **/
            if ($minutes > 30) {
                $TimeStr = $minutesStr . " до $hoursStr";
            } else {
                $TimeStr = $minutesStr . " после $hoursStr";
            }
            return $TimeStr;
        } catch (\Error $message) {
            return 'Некоректное время';
        }
    }
}
