<?php
declare(strict_types = 1);

namespace Kata;

use InvalidArgumentException;

class Movie
{
    const REGULAR = 0;
    const NEW_RELEASE = 1;
    const CHILDRENS = 2;
    private int $priceCode;
    private string $title;

    public function __construct($title, $priceCode)
    {
        if (!is_string($title) || !is_int($priceCode)) {
            throw new InvalidArgumentException();
        }
        $this->title = $title;
        $this->priceCode = $priceCode;
    }

    public function getPriceCode(): int
    {
        return $this->priceCode;
    }

    public function setPriceCode(int $arg)
    {
        $this->priceCode = $arg;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

}
