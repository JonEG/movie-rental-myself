<?php

namespace KataTests;

use InvalidArgumentException;

class TestHelper
{
    public static function getMixedTypeValuesProvider()
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
}
