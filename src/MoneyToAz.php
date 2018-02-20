<?php

namespace MoneyToAz;

class MoneyToAz extends Words implements MoneyToAzInterface
{
    /**
     * @param float|int $amount
     * @param string    $currency
     * @return string
     */
    public function convertToWords($amount, string $currency = '')
    {
        if (!is_numeric($amount))
        {
            throw new \InvalidArgumentException(sprintf('%s is not valid number', $amount));
        }

        return $this->getConverted(strval($amount), [], 0, false, $currency);
    }

    /**
     * @param float|int $amount
     * @param array     $result
     * @param int       $recursion
     * @param boolean   $cents
     * @param string    $currency
     * @return string
     */
    public function getConverted($amount, array $result = [], int $recursion = 0, bool $cents = false, string $currency = '')
    {

        $get_words = $this->getWords();

        if (empty($currency))
            $currency = $this::$defaultCurrency;

        $end = $amount >= 1 ? ' ' . $this->getCurrencyUnit(strtoupper($currency)) : '';

        if (!$cents)
        {
            $amount = $this->getNormalized($amount);

            $frac = $this->getFraction($amount);
            if ($frac > 0)
                $end .= '' . ($end !== '' ? ', ' : '') . ($frac <= 10 ? $this->getNumber($get_words, $frac) : $this->getNumber($get_words, floor($frac / 10) * 10) . ' ' . $this->getNumber($get_words, $frac % 10)) . ' ' . $this->getCentesimalUnit(strtoupper($currency));
        }

        foreach ($get_words as $value)
        {
            $div = floor($amount / $value[0]);
            
            if ($div >= 1)
            {
                if ($this->getNumber($get_words, $div) == false)
                {
                    $result   = $this->getConverted($div, $result, 1, $end, $currency);
                    $result[] = $this->getNumber($get_words, $value[0]);
                }
                else
                {
                    $result[] = ($div > 1 || $value[0] > 1000 ? $this->getNumber($get_words, $div) . ' ' : '') . $this->getNumber($get_words, $value[0]);
                }

                $amount -= $div * $value[0];
            }
        }

        return $recursion == 0 ? implode(' ', $result) . $end : $result;
    }

    /**
     * @param string $amount
     * @return string
     */
    public function getNormalized(string $amount)
    {
        $numberParts = explode('.', $amount);
        $response    = $numberParts[0];

        if (count($numberParts) > 1)
        {
            $response .= '.';
            $response .= substr($numberParts[1], 0, 2);
        }

        return $response;
    }

    /**
     * @param string $amount
     * @return string
     */
    public function getFraction(string $amount)
    {
        return ltrim(str_pad(explode('.', $amount)[1], 2, '0', STR_PAD_RIGHT), 0);
    }
}