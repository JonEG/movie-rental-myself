<?php
namespace Kata;

use InvalidArgumentException;

class Customer
{
    private array $rentals;
    private float $amountToPay;
    private float $amountOfPoints;

    public function __construct(private string $name)
    {
        if(!is_string($name)){
            throw new InvalidArgumentException();
        }
        $this->name = $name;
        $this->amountToPay = 0.0;
        $this->amountOfPoints = 0;
    }

    public function addRental($rental)
    {
        if(!($rental instanceof Rental)){
            throw new InvalidArgumentException();
        }
        $this->amountToPay += $rental->getCost();
        $this->amountOfPoints += $rental->getPoints();
        $this->rentals[] = $rental;
    }

    public function statement()
    {
        // add header
        $result = "Rental Record for $this->name\n";

        foreach ($this->rentals as $rental) {
            $rentalCost = $rental->getCost();
            // show figures for this rental
            $result .= sprintf("\t%s\t%1.1f\n", $rental->getMovie()->getTitle(), $rentalCost);
        }

        // add footer lines
        $result .= sprintf("Amount owed is %1.1f\n", $this->amountToPay);
        $result .= "You earned " . $this->amountOfPoints . " frequent renter points";

        return $result;
    }

    public function getAmountToPay(): float {
        return $this->amountToPay;
    }

    public function getAmountOfPoints(): int {
        return $this->amountOfPoints;
    }
}
