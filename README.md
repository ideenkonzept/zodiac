# Zodiac

This package allow you to get the Zodiac name from any date format

## Installation

```
composer require ideenkonzept/zodiac
```

## Usage

```php
use Ideenkonzept\Zodiac\ZodiacFinder;

ZodiacFinder::find( '6-2-2012')->name() // Aquarius

ZodiacFinder::find( Carbon::now() )->name()

ZodiacFinder::find( '6-2-2012','de')->name() // Wassermann

```

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
