<?php
/**
 * User: Ahmed Dabak
 * Date: 11.04.2018
 * Time: 12:04
 */

namespace Ideenkonzept\Zodiac;

use Carbon\Carbon;

abstract class Zodiac {

	protected $year;
	private $local;

	public function __construct( $year = null ,$local) {
		$this->year = $year == null ? Carbon::now()->year : $year;
		$this->local = $local;
	}

	public function startDate() {
		return Carbon::create( $this->year, $this->start['month'], $this->start['day'], 0, 0, 0 );
	}

	public function endDate() {
		return Carbon::create( $this->year, $this->end['month'], $this->end['day'], 23, 59, 59 );
	}

	public function name() {
	    $names = include __DIR__ . "/lang/{$this->local}.php";

	    return $names[class_basename($this)];
	}
}
