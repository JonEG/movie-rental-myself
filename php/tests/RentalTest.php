<?php

namespace KataTests;

use InvalidArgumentException;
use Kata\Movie;
use Kata\Rental;
use PHPUnit\Framework\TestCase;

class RentalTest extends TestCase
{
    public function getMixedTypeValuesProvider()
    {
        //mixed types are object|resource|array|string|float|int|bool|null

        $resource = fopen('php://temp', 'r');
        fclose($resource);

        return [
            'object' => [new MovieTest(), InvalidArgumentException::class],
            'resource' => [$resource, InvalidArgumentException::class],
            'array' => [[], InvalidArgumentException::class],
            'string' => ['', InvalidArgumentException::class],
            'float' => [1.2, InvalidArgumentException::class],
            'int' => [0, InvalidArgumentException::class],
            'bool' => [false, InvalidArgumentException::class],
            'null' => [null, InvalidArgumentException::class],
        ];
    }

    /**
     * Data provider for testing invalid days rented values
     * 
     * @return array
     */
    public function invalidDaysRentedProvider()
    {
        $mixedTypeValuesProvider = $this->getMixedTypeValuesProvider();
        //remove valid title from list
        unset($mixedTypeValuesProvider['int']);

        return $mixedTypeValuesProvider;
    }

    /**
     * @dataProvider invalidDaysRentedProvider
     */
    public function test_rental_with_invalid_days_rented_throws_exception($invalidDaysRented)
    {
        
        $this->expectException(InvalidArgumentException::class);
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
        return $this->getMixedTypeValuesProvider();
    }

    /**
     * @dataProvider invalidMoviesProvider
     */
    public function test_rental_with_invalid_movie_throws_exception($invalidMovie)
    {
        $this->expectException(InvalidArgumentException::class);
        new Rental($invalidMovie, 3);
    }

    public function test_rental_with_valid_movie_returns_movie()
    {
        $movie = new Movie("Test", Movie::REGULAR);
        $rental = new Rental($movie, 3);

        $this->assertSame($movie, $rental->getMovie());
    }
}
