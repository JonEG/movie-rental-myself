<?php
declare(strict_types = 1);

namespace Kata;

use InvalidArgumentException;

class Rental
{
    private Movie $_movie;
    private int $_daysRented;
    
    public function __construct($movie, $daysRented)
    {
        if(!is_int($daysRented) || $daysRented < 1){
            throw new InvalidArgumentException();
        }
        if(!($movie instanceof Movie)){
            throw new InvalidArgumentException();
        }
        $this->_movie = $movie;
        $this->_daysRented = $daysRented;
    }

    public function getDaysRented(): int
    {
        return $this->_daysRented;
    }

    public function getMovie(): Movie
    {
        return $this->_movie;
    }

    public function getCost(): float {
        switch ($this->_movie->getPriceCode()) {
            case Movie::REGULAR:
                // 2€ base price. From day three on, it adds 1'5€ per extra day
                $basePrice = 2;
                $numberOfDaysIncludedWithBasePrice = 2;
                $extraFeePerNotIncludedDay = 1.5;
                break;
            case Movie::NEW_RELEASE:
                // 3€ per day
                $basePrice = 0;
                $numberOfDaysIncludedWithBasePrice = 0;
                $extraFeePerNotIncludedDay = 3;
                break;
            case Movie::CHILDRENS:
                // 1'5€ base price. From day four on, it adds 1'5€ per extra day
                $basePrice = 1.5;
                $numberOfDaysIncludedWithBasePrice = 3;
                $extraFeePerNotIncludedDay = 1.5;
                break;
        }

        $rentalCost = $basePrice;
        if ($this->_daysRented > $numberOfDaysIncludedWithBasePrice){
            $extraDaysFee = ($this->_daysRented - $numberOfDaysIncludedWithBasePrice) * $extraFeePerNotIncludedDay;
            $rentalCost += $extraDaysFee;
        }

        return $rentalCost;
    }

    public function getPoints(){
        switch ($this->_movie->getPriceCode()) {
            case Movie::REGULAR:
            case Movie::CHILDRENS:
                return 1;
            case Movie::NEW_RELEASE:
                return $this->_daysRented;
        }
    }

}