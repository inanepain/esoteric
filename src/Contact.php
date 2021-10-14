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

use function implode;

/**
 * Contact
 * 
 * @version 1.0.0
 */
class Contact {
    /**
     * Name Calculator
     * 
     * @var \Inane\Esoteric\Calculator\Name
     */
    protected Name $nameNumber;

    /**
     * Birthday Calculator
     * 
     * @var \Inane\Esoteric\Calculator\Birthday
     */
    protected Birthday $birthNumber;

    /**
     * Birthday
     * 
     * @var \DateTime
     */
    protected DateTime $birthday;

    /**
     * Contact
     * 
     * @param string $name Name and Surname
     * @param int $year birthday
     * @param int $month birthday
     * @param int $day birthday
     * 
     * @return void 
     */
    public function __construct(
        /**
         * Full name
         */
        protected string $name,
        /**
         * Year of birth
         */
        protected int $year,
        /**
         * Month of birth
         */
        protected int $month,
        /**
         * Day of birth
         */
        protected int $day
    ) {
        $this->birthday = DateTime::createFromFormat('Y/m/d', "$year/$month/$day");
        $this->nameNumber = new Name($name);
        $this->birthNumber = new Birthday($this->birthday);
    }

    /**
     * Create Contact from date
     * 
     * @param string $name Full name
     * @param \DateTime $date birthday
     * 
     * @return static Contact
     */
    public static function fromDate(string $name, DateTime $date): static {
        return new static($name, (int) $date->format('Y'), (int) $date->format('m'), (int) $date->format('d'));
    }

    /**
     * Contact as text
     * 
     * @return string Text contact
     */
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
