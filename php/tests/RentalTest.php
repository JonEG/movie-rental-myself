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

    public function test_when_movie_is_rented_then_calculate_cost(){
        $regularMovieTwoDayRental = (new Rental(new Movie("Jaws", Movie::REGULAR), 2));
        $this->assertSame(2.0, $regularMovieTwoDayRental->getCost());
        $regularMovieThreeDayRental = (new Rental(new Movie("Golden Eye", Movie::REGULAR), 3));
        $this->assertSame(3.5, $regularMovieThreeDayRental->getCost());
        $newReleaseMovieOneDayRental = (new Rental(new Movie("Short New", Movie::NEW_RELEASE), 1));
        $this->assertSame(3.0, $newReleaseMovieOneDayRental->getCost());
        $newReleaseMovieTwoDayRental = (new Rental(new Movie("Long New", Movie::NEW_RELEASE), 2));
        $this->assertSame(6.0, $newReleaseMovieTwoDayRental->getCost());
        $childrenMovieThreeDayRental = (new Rental(new Movie("Bambi", Movie::CHILDRENS), 3));
        $this->assertSame(1.5, $childrenMovieThreeDayRental->getCost());
        $childrenMovieFourDayRental = (new Rental(new Movie("Toy Story", Movie::CHILDRENS), 4));
        $this->assertSame(3.0, $childrenMovieFourDayRental->getCost());
    }

    public function test_when_movie_is_rented_then_calculate_points(){
        $regularMovieTwoDayRental = (new Rental(new Movie("Jaws", Movie::REGULAR), 2));
        $this->assertSame(1, $regularMovieTwoDayRental->getPoints());
        $regularMovieThreeDayRental = (new Rental(new Movie("Golden Eye", Movie::REGULAR), 3));
        $this->assertSame(1, $regularMovieThreeDayRental->getPoints());
        $newReleaseMovieOneDayRental = (new Rental(new Movie("Short New", Movie::NEW_RELEASE), 1));
        $this->assertSame(1, $newReleaseMovieOneDayRental->getPoints());
        $newReleaseMovieTwoDayRental = (new Rental(new Movie("Long New", Movie::NEW_RELEASE), 2));
        $this->assertSame(2, $newReleaseMovieTwoDayRental->getPoints());
        $childrenMovieThreeDayRental = (new Rental(new Movie("Bambi", Movie::CHILDRENS), 3));
        $this->assertSame(1, $childrenMovieThreeDayRental->getPoints());
        $childrenMovieFourDayRental = (new Rental(new Movie("Toy Story", Movie::CHILDRENS), 4));
        $this->assertSame(1, $childrenMovieFourDayRental->getPoints());
    }
}
