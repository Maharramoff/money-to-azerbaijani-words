<?php

namespace MoneyToAz;

interface MoneyToAzInterface
{
    /**
     * @param string $amount
     * @return string
     */
    public function getNormalized(string $amount);

    /**
     * @param string $amount
     *
     * @return int
     */
    public function getFraction(string $amount);

    /**
     * @param float|int $amount
     * @param string    $currency
     * @return string
     */
    public function convertToWords($amount, string $currency);

    /**
     * @param float|int $amount
     * @param array     $result
     * @param int       $recursion
     * @param boolean   $cents
     * @param string    $currency
     * @return string
     */
    public function getConverted($amount, array $result, int $recursion, bool $cents, string $currency);

}
