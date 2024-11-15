<?php

namespace KataTests;

use InvalidArgumentException;
use Kata\Movie;
use PHPUnit\Framework\TestCase;

class MovieTest extends TestCase
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
     * Data provider for testing invalid titles
     * 
     * @return array
     */
    public function invalidTitlesProvider()
    {
        $mixedTypeValuesProvider = $this->getMixedTypeValuesProvider();
        //remove valid title from list
        unset($mixedTypeValuesProvider['string']);

        return $mixedTypeValuesProvider;
    }

    /**
     * @dataProvider invalidTitlesProvider
     */
    public function test_movie_with_invalid_title_throws_exception($invalidTitle)
    {
        $this->expectException(InvalidArgumentException::class);
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
        $mixedTypeValuesProvider = $this->getMixedTypeValuesProvider();
        //remove valid title from list
        unset($mixedTypeValuesProvider['int']);

        return $mixedTypeValuesProvider;
    }

    /**
     * @dataProvider invalidPriceCodesProvider
     */
    public function test_movie_with_invalid_price_code_throws_exception($invalidPriceCode)
    {
        $this->expectException(InvalidArgumentException::class);
        new Movie("test", $invalidPriceCode);
    }

    public function test_movie_with_valid_price_code_returns_price_code()
    {
        $movie = new Movie("test", Movie::REGULAR);

        $this->assertSame(Movie::REGULAR, $movie->getPriceCode());
        $this->assertSame(true, is_int($movie->getPriceCode()));
    }
}
