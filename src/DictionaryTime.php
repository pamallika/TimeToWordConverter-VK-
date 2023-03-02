<?php

namespace src;

class DictionaryTime implements DictionaryTimeInterface
{
    /**
     * Словарь(мапа) для работы со временем
     **/
    /**
     * @var array|string[]
     */
    private $dictionaryMinutes;
    /**
     * @var array|string[]
     */
    private $dictionaryBeforeHours;
    /**
     * @var array|string[]
     */
    private $dictionaryAfterHours;
    /**
     * @var array|string[]
     */
    private $dictionaryHalfHours;
    /**
     * @var array|string[]
     */
    private $dictionaryHours;

    public function __construct()
    {
        $this->dictionaryMinutes = [
            0 => '',
            1 => 'одна',
            2 => 'две',
            3 => 'три',
            4 => 'четыре',
            5 => 'пять',
            6 => 'шесть',
            7 => 'семь',
            8 => 'восемь',
            9 => 'девять',
            10 => 'десять',
            11 => 'одиннадцать',
            12 => 'двенадцать',
            13 => 'тринадцать',
            14 => 'четырнадцать',
            15 => 'пятнадцать',
            16 => 'шестнадцать',
            17 => 'семьнадцать',
            18 => 'восемнадцать',
            19 => 'девятнадцать',
            20 => 'двадцать',
            30 => 'половина',
            40 => 'сорок',
            50 => 'пятьдесят',
            60 => '',
        ];
        $this->dictionaryBeforeHours = [
            0 => 'двенадцати',
            1 => 'часа',
            2 => 'двух',
            3 => 'трёх',
            4 => 'четырёх',
            5 => 'пяти',
            6 => 'шести',
            7 => 'семи',
            8 => 'восьми',
            9 => 'девяти',
            10 => 'десяти',
            11 => 'одиннадцати',
            12 => 'двенадцати',
            13 => 'часа',
        ];
        $this->dictionaryAfterHours = [
            0 => 'двенадцати',
            1 => 'часа',
            2 => 'двух',
            3 => 'трёх',
            4 => 'четырёх',
            5 => 'пяти',
            6 => 'шести',
            7 => 'семи',
            8 => 'восьми',
            9 => 'девяти',
            10 => 'десяти',
            11 => 'одиннадцати',
            12 => 'двенадцати',
            13 => 'часа',
        ];
        $this->dictionaryHalfHours = [
            0 => 'двенадцатого',
            1 => 'первого',
            2 => 'второго',
            3 => 'третьего',
            4 => 'четвёртого',
            5 => 'пятого',
            6 => 'шестого',
            7 => 'седьмого',
            8 => 'восьмого',
            9 => 'девятого',
            10 => 'десятого',
            11 => 'одиннадцатого',
            12 => 'двенадцатого',
            13 => 'первого',
        ];
        $this->dictionaryHours = [
            0 => 'двенадцать',
            1 => 'один',
            2 => 'два',
            3 => 'три',
            4 => 'четыре',
            5 => 'пять',
            6 => 'шесть',
            7 => 'семь',
            8 => 'восемь',
            9 => 'девять',
            10 => 'десять',
            11 => 'одиннадцать',
            12 => 'двенадцать',
            13 => 'один',
        ];

    }

    /**
     * @param int $hour
     * @return string
     */
    public function getDictionaryAfterHours(int $hour): string
    {
        return $this->dictionaryAfterHours[$hour];
    }

    /**
     * @param int $hour
     * @return string
     */
    public function getDictionaryBeforeHours(int $hour): string
    {
        return $this->dictionaryBeforeHours[$hour];
    }

    /**
     * @param int $hour
     * @return string
     */
    public function getDictionaryHalfHours(int $hour): string
    {
        return $this->dictionaryHalfHours[$hour];
    }

    /**
     * @param int $minute
     * @return string
     */
    public function dictionaryMinutes(int $minute): string
    {
        return $this->dictionaryMinutes[$minute];
    }

    /**
     * @param int $hours
     * @param bool $before если минут меньше 30 оставлять true
     * @return string
     */
    public function getHours(int $hours, bool $before): string
    {
        if ($before) {
            return $this->getDictionaryBeforeHours($hours);
        } else {
            return $this->getDictionaryAfterHours($hours);
        }
    }

    /**
     * @param int $hour
     * @return string
     */
    public function getDictionaryTotalHours(int $hour): string
    {
        return  $this->dictionaryHours[$hour];
    }
}