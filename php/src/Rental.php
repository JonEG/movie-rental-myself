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

}