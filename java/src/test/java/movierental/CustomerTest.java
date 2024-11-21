package movierental;

import static org.junit.Assert.*;

import org.junit.Test;

public class CustomerTest {

    @Test
    public void test() {
        Customer customer = new Customer("Bob");
        customer.addRental(new Rental(new Movie("Jaws", MovieType.REGULAR), 2));
        customer.addRental(new Rental(new Movie("Golden Eye", MovieType.REGULAR), 3));
        customer.addRental(new Rental(new Movie("Short New", MovieType.NEW_RELEASE), 1));
        customer.addRental(new Rental(new Movie("Long New", MovieType.NEW_RELEASE), 2));
        customer.addRental(new Rental(new Movie("Bambi", MovieType.CHILDREN), 3));
        customer.addRental(new Rental(new Movie("Toy Story", MovieType.CHILDREN), 4));

        String expected = "" +
                "Rental Record for Bob\n" +
                "\tJaws\t2.0\n" +
                "\tGolden Eye\t3.5\n" +
                "\tShort New\t3.0\n" +
                "\tLong New\t6.0\n" +
                "\tBambi\t1.5\n" +
                "\tToy Story\t3.0\n" +
                "Amount owed is 19.0\n" +
                "You earned 7 frequent renter points";

        assertEquals(expected, customer.statement());
    }
}