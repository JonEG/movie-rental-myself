<?php
namespace KataTests;

use Kata\Customer;
use Kata\Movie;
use Kata\Rental;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    public function test_customer()
    {
        $customer = new Customer("Bob");
        $customer->addRental(new Rental(new Movie("Jaws", Movie::REGULAR), 2));
        $customer->addRental(new Rental(new Movie("Golden Eye", Movie::REGULAR), 3));
        $customer->addRental(new Rental(new Movie("Short New", Movie::NEW_RELEASE), 1));
        $customer->addRental(new Rental(new Movie("Long New", Movie::NEW_RELEASE), 2));
        $customer->addRental(new Rental(new Movie("Bambi", Movie::CHILDRENS), 3));
        $customer->addRental(new Rental(new Movie("Toy Story", Movie::CHILDRENS), 4));

        $expected = "" .
            "Rental Record for Bob\n" .
            "\tJaws\t2.0\n" .
            "\tGolden Eye\t3.5\n" .
            "\tShort New\t3.0\n" .
            "\tLong New\t6.0\n" .
            "\tBambi\t1.5\n" .
            "\tToy Story\t3.0\n" .
            "Amount owed is 19.0\n" .
            "You earned 7 frequent renter points";

        $this->assertSame($expected, $customer->statement());
    }
    public function test_customer_when_add_rentals_then_total_amount_to_pay_increases()
    {
        $customer = new Customer("Bob");
        $this->assertSame(0.0, $customer->getAmountToPay());
        $customer->addRental(new Rental(new Movie("Jaws", Movie::REGULAR), 2));
        $this->assertSame(2.0, $customer->getAmountToPay());
        $customer->addRental(new Rental(new Movie("Golden Eye", Movie::REGULAR), 3));
        $this->assertSame(5.5, $customer->getAmountToPay());
    }

    public function test_customer_when_add_rentals_then_total_points_amount_increases()
    {
        $customer = new Customer("Bob");
        $this->assertSame(0, $customer->getAmountOfPoints());
        $customer->addRental(new Rental(new Movie("Golden Eye", Movie::REGULAR), 3));
        $this->assertSame(1, $customer->getAmountOfPoints());
        $customer->addRental(new Rental(new Movie("Short New", Movie::NEW_RELEASE), 1));
        $this->assertSame(2, $customer->getAmountOfPoints());
        $customer->addRental(new Rental(new Movie("Long New", Movie::NEW_RELEASE), 2));
        $this->assertSame(4, $customer->getAmountOfPoints());
    }

    /**
     * Data provider for testing invalid names
     * 
     * @return array
     */
    public function invalidNamesProvider()
    {
        $mixedTypeValuesProvider = TestHelper::getMixedTypeValuesProvider();
        //remove valid type from invalids list
        unset($mixedTypeValuesProvider['string']);

        return $mixedTypeValuesProvider;
    }

    /**
     * @dataProvider invalidNamesProvider
     */
    public function test_customer_with_invalid_name_throws_exception($invalidName, $expectedException)
    {
        $this->expectException($expectedException);
        new Customer($invalidName);
    }

    /**
     * Data provider for testing invalid rentals
     * 
     * @return array
     */
    public function invalidRentalsProvider()
    {
        return TestHelper::getMixedTypeValuesProvider();
    }

    /**
     * @dataProvider invalidRentalsProvider
     */
    public function test_customer_with_invalid_rental_throws_exception($invalidRental, $expectedException)
    {
        $this->expectException($expectedException);
        $customer = new Customer("Maria");
        $customer->addRental($invalidRental);
    }
}
