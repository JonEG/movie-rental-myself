<?php

namespace KataTests;

use Kata\Movie;
use Kata\Rental;
use PHPUnit\Framework\TestCase;

class RentalTest extends TestCase
{
    /**
     * Data provider for testing invalid days rented values
     * 
     * @return array
     */
    public function invalidDaysRentedProvider()
    {
        $mixedTypeValuesProvider = TestHelper::getMixedTypeValuesProvider();
        //remove valid title from list
        unset($mixedTypeValuesProvider['int']);

        return $mixedTypeValuesProvider;
    }

    /**
     * @dataProvider invalidDaysRentedProvider
     */
    public function test_rental_with_invalid_days_rented_throws_exception($invalidDaysRented, $expectedException)
    {
        
        $this->expectException($expectedException);
        $movie = new Movie("Test", Movie::REGULAR);
        new Rental($movie, $invalidDaysRented);
    }

    public function test_rental_with_valid_days_rented_returns_days_rented()
    {
        $movie = new Movie("test", Movie::REGULAR);
        $daysRented = 1;
        $rental = new Rental($movie, $daysRented);
        $this->assertSame($daysRented, $rental->getDaysRented());
    }

    /**
     * Data provider for testing invalid movie values
     * 
     * @return array
     */
    public function invalidMoviesProvider()
    {
        return TestHelper::getMixedTypeValuesProvider();
    }

    /**
     * @dataProvider invalidMoviesProvider
     */
    public function test_rental_with_invalid_movie_throws_exception($invalidMovie, $expectedException)
    {
        $this->expectException($expectedException);
        new Rental($invalidMovie, 3);
    }

    public function test_rental_with_valid_movie_returns_movie()
    {
        $movie = new Movie("Test", Movie::REGULAR);
        $rental = new Rental($movie, 1);

        $this->assertSame($movie, $rental->getMovie());
    }
}
