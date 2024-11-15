<?php
namespace Kata;

use InvalidArgumentException;

class Customer
{
    private array $_rentals;
    private string $_name;
    private float $_amountToPay;
    private float $_amountOfPoints;

    public function __construct($string)
    {
        if(!is_string($string)){
            throw new InvalidArgumentException();
        }
        $this->_name = $string;
        $this->_amountToPay = 0.0;
        $this->_amountOfPoints = 0;
    }

    public function addRental($rental)
    {
        if(!($rental instanceof Rental)){
            throw new InvalidArgumentException();
        }
        $this->_amountToPay += $rental->getCost();
        $this->_amountOfPoints += $rental->getPoints();
        $this->_rentals[] = $rental;
    }

    public function statement()
    {
        // add header
        $result = "Rental Record for $this->_name\n";

        foreach ($this->_rentals as $rental) {
            $rentalCost = $rental->getCost();
            // show figures for this rental
            $result .= sprintf("\t%s\t%1.1f\n", $rental->getMovie()->getTitle(), $rentalCost);
        }

        // add footer lines
        $result .= sprintf("Amount owed is %1.1f\n", $this->_amountToPay);
        $result .= "You earned " . $this->_amountOfPoints . " frequent renter points";

        return $result;
    }

    public function getAmountToPay(): float {
        return $this->_amountToPay;
    }

    public function getAmountOfPoints(): int {
        return $this->_amountOfPoints;
    }
}