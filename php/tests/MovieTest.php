<?php

namespace KataTests;

use Kata\Movie;
use PHPUnit\Framework\TestCase;

class MovieTest extends TestCase
{
    /**
     * Data provider for testing invalid titles
     * 
     * @return array
     */
    public function invalidTitlesProvider()
    {
        $mixedTypeValuesProvider = TestHelper::getMixedTypeValuesProvider();
        //remove valid title from list
        unset($mixedTypeValuesProvider['string']);

        return $mixedTypeValuesProvider;
    }

    /**
     * @dataProvider invalidTitlesProvider
     */
    public function test_movie_with_invalid_title_throws_exception($invalidTitle, $expectedException)
    {
        $this->expectException($expectedException);
        new Movie($invalidTitle, Movie::REGULAR);
    }

    public function test_movie_with_valid_title_returns_title()
    {
        $title = "Jaws";
        $movie = new Movie($title, Movie::REGULAR);

        $this->assertSame($title, $movie->getTitle());
        $this->assertSame(true, is_string($movie->getTitle()));
    }

    /**
     * Data provider for testing invalid price codes
     * 
     * @return array
     */
    public function invalidPriceCodesProvider()
    {
        $mixedTypeValuesProvider = TestHelper::getMixedTypeValuesProvider();
        //remove valid title from list
        unset($mixedTypeValuesProvider['int']);

        return $mixedTypeValuesProvider;
    }

    /**
     * @dataProvider invalidPriceCodesProvider
     */
    public function test_movie_with_invalid_price_code_throws_exception($invalidPriceCode, $expectedException)
    {
        $this->expectException($expectedException);
        new Movie("test", $invalidPriceCode);
    }

    public function test_movie_with_valid_price_code_returns_price_code()
    {
        $movie = new Movie("test", Movie::REGULAR);

        $this->assertSame(Movie::REGULAR, $movie->getPriceCode());
        $this->assertSame(true, is_int($movie->getPriceCode()));
    }
}
