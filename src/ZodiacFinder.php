<?php
/**
 * User: Ahmed Dabak
 * Date: 09.04.2018
 * Time: 18:46
 */

namespace Ideenkonzept\Zodiac;


use Carbon\Carbon;
use Ideenkonzept\Zodiac\Zodiacs\Aquarius;
use Ideenkonzept\Zodiac\Zodiacs\Aries;
use Ideenkonzept\Zodiac\Zodiacs\Cancer;
use Ideenkonzept\Zodiac\Zodiacs\Capricorn;
use Ideenkonzept\Zodiac\Zodiacs\Gemini;
use Ideenkonzept\Zodiac\Zodiacs\Leo;
use Ideenkonzept\Zodiac\Zodiacs\Libra;
use Ideenkonzept\Zodiac\Zodiacs\Pisces;
use Ideenkonzept\Zodiac\Zodiacs\Sagittarius;
use Ideenkonzept\Zodiac\Zodiacs\Scorpio;
use Ideenkonzept\Zodiac\Zodiacs\Taurus;
use Ideenkonzept\Zodiac\Zodiacs\Virgo;

class ZodiacFinder {


	private static $zodiacs = [
		Aries::class,
		Taurus::class,
		Gemini::class,
		Cancer::class,
		Leo::class,
		Virgo::class,
		Libra::class,
		Scorpio::class,
		Sagittarius::class,
		Capricorn::class,
		Aquarius::class,
		Pisces::class
	];

	public static function find( $date, $local = 'en' ) {
		if ( is_string( $date ) ) {
			$date = Carbon::parse( $date )->setTime( 0, 0, 0, 0 );
		}

		if ( static::isCapricorn( $date ) ) {
			return new Capricorn( $date->year, $local );
		}

		foreach ( static::$zodiacs as $class ) {

			if ( $class == Capricorn::class ) {
				continue;
			}

			$zodiac = new $class( $date->year, $local );

			if ( static::match( $date, $zodiac ) ) {
				return $zodiac;
			}
		}
	}

		private static function isCapricorn( $date ) {

		return (
			       $date->gte( Carbon::createFromFormat( 'Y-m-d H:i:s', $date->year."-1-1 00:00:00" ) ) &&
			       $date->lte( Carbon::createFromFormat('Y-m-d H:i:s.u', $date->year."-1-19 23:59:59.99999" ) )
		       ) || (
			       $date->gte( Carbon::createFromFormat('Y-m-d H:i:s', $date->year."-12-22 00:00:00" ) ) &&
			       $date->lte( Carbon::createFromFormat('Y-m-d H:i:s.u', $date->year."-12-31 23:59:59.99999" ) )
		       );
	}

	private static function match( Carbon $date, Zodiac $zodiac ) {
		return $date->between( $zodiac->startDate(), $zodiac->endDate(), true );
	}
}
