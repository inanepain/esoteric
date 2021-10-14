<?php

/**
 * Contact
 * 
 * PHP version 8
 */

declare(strict_types=1);

namespace Inane\Esoteric;

use DateTime;
use Inane\Esoteric\Calculator\Birthday;
use Inane\Esoteric\Calculator\Name;

/**
 * Contact
 * 
 * @version 1.0.0
 */
class Contact {
    protected Name $nameNumber;
    protected Birthday $birthNumber;

    protected DateTime $birthday;

    public function __construct(
        protected string $name,
        protected int $year,
        protected int $month,
        protected int $day
    ) {
        $this->birthday = DateTime::createFromFormat('Y/m/d', "$year/$month/$day");
        $this->nameNumber = new Name($name);
        $this->birthNumber = new Birthday($this->birthday);
    }

    public static function fromDate(string $name, DateTime $date): static {
        return new static($name, (int) $date->format('Y'), (int) $date->format('m'), (int) $date->format('d'));
    }

    public function __toString() {
        $result = [$this->nameNumber->__toString(), $this->birthNumber->__toString()];
        return implode(PHP_EOL, $result) . PHP_EOL;
    }

    // public function nameNumber() {
    //     return $this->nameNumber;
    // }

    // public function birthNumber() {
    //     return $this->birthNumber;
    // }
}
