This library allows you to convert a money to Azeri words.

## Installation

Add package to your composer.json

```json
{
    "require": {
        "maharramoff/money-to-azerbaijani-words": "^v1.0"
    }
}
```


## Usage

```php
use MoneyToAz\MoneyToAz;

$convert = new MoneyToAz();

echo $convert->convertToWords(546983.98, 'AZN'); //beş yüz qırx altı min doqquz yüz səksən üç manat, doxsan səkkiz qəpik
echo $convert->convertToWords(569832, 'AZN'); // beş yüz altmış doqquz min səkkiz yüz otuz iki manat
echo $convert->convertToWords(999000, 'RUB'); // doqquz yüz doxsan doqquz min rubl
echo $convert->convertToWords(100000008.08, 'AZN'); // yüz milyon səkkiz manat, səkkiz qəpik
echo $convert->convertToWords(111111111111.11, 'USD'); // yüz on bir milyard yüz on bir milyon yüz on bir min yüz on bir dollar, on bir sent
```
