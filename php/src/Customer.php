<?php
namespace Kata;

use InvalidArgumentException;

class Customer
{
    private array $_rentals;
    private string $_name;

    public function __construct($string)
    {
        if(!is_string($string)){
            throw new InvalidArgumentException();
        }
        $this->_name = $string;
    }

    public function addRental($param)
    {
        if(!($param instanceof Rental)){
            throw new InvalidArgumentException();
        }
        $this->_rentals[] = $param;
    }

    public function statement()
    {
        $totalAmount = 0;
        $frequentRenterPoints = 0;
        // add header
        $result = "Rental Record for $this->_name\n";

        foreach ($this->_rentals as $rental) {
            $rentalCost = $rental->getCost();
            $totalAmount += $rentalCost;
            $frequentRenterPoints += $rental->getPoints();

            // show figures for this rental
            $result .= sprintf("\t%s\t%1.1f\n", $rental->getMovie()->getTitle(), $rentalCost);
        }

        // add footer lines
        $result .= sprintf("Amount owed is %1.1f\n", $totalAmount);
        $result .= "You earned " . $frequentRenterPoints . " frequent renter points";

        return $result;
    }
}