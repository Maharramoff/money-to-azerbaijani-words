<?php

namespace MoneyToAz;

class Words
{

    protected static $defaultCurrency = 'AZN';

    protected static $numWords = [
            [1, 'bir'],
            [2, 'iki'],
            [3, 'üç'],
            [4, 'dörd'],
            [5, 'beş'],
            [6, 'altı'],
            [7, 'yeddi'],
            [8, 'səkkiz'],
            [9, 'doqquz'],
            [10, 'on'],
            [20, 'iyirmi'],
            [30, 'otuz'],
            [40, 'qırx'],
            [50, 'əlli'],
            [60, 'altmış'],
            [70, 'yetmiş'],
            [80, 'səksən'],
            [90, 'doxsan'],
            [100, 'yüz'],
            [1000, 'min'],
            [1000000, 'milyon'],
            [1000000000, 'milyard'],
            [1000000000000, 'trilyon'],
    ];

    protected static $currencyNames = [
        'USD' => [
            'dollar',
            'sent',
        ],
        'AZN' => [
            'manat',
            'qəpik',
        ],
        'RUB' => [
            'rubl',
            'qəpik',
        ],
    ];

    protected function getNumber($array, $key)
    {
        return array_search($key, array_column($array, 0, 1));
    }

    protected function getWords()
    {
        return array_reverse(static::$numWords);
    }

    protected function getCentesimalUnit($currency)
    {
        if (!isset(static::$currencyNames[$currency]))
        {
            throw new MoneyToAzException(sprintf('Currency "%s" is not available.', $currency));
        }

        return static::$currencyNames[$currency][1];
    }

    protected function getCurrencyUnit($currency)
    {
        if (!isset(static::$currencyNames[$currency]))
        {
            throw new MoneyToAzException(sprintf('Currency "%s" is not available.', $currency));
        }

        return static::$currencyNames[$currency][0];
    }
}