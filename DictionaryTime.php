<?php

namespace DictionaryTime;

class DictionaryTime
{
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
            30 => 'тридцать',
            40 => 'сорок',
            50 => 'пятьдесят',
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
        ];
        $this->dictionaryAfterHours = [
            0 => 'после двенадцати',
            1 => 'после часа',
            2 => 'после двух',
            3 => 'после трёх',
            4 => 'после четырёх',
            5 => 'после пяти',
            6 => 'после шести',
            7 => 'после семи',
            8 => 'после восьми',
            9 => 'после девяти',
            10 => 'после десяти',
            11 => 'после одиннадцати',
            12 => 'после двенадцати',
        ];

    }

    public function getDictionaryAfterHours(int $hour): string
    {
        return $this->dictionaryAfterHours[$hour];
    }
    public function getDictionaryBeforeHours(int $hour): string
    {
        return $this->dictionaryBeforeHours[$hour];
    }
    public function dictionaryMinutes(int $minute): string
    {
        return $this->dictionaryMinutes[$minute];
    }
}