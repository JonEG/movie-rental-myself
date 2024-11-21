package movierental;

import java.util.ArrayList;
import java.util.List;

public class Customer {

    private String name;
    private List<Rental> rentals = new ArrayList<>();

    public Customer(String name) {
        this.name = name;
    }

    public void addRental(Rental rental) {
        rentals.add(rental);
    }

    public String getName() {
        return name;
    }

    public String statement() {
        double totalAmount = 0;
        int frequentRenterPoints = 0;
        StringBuilder stringBuilder = new StringBuilder();
        stringBuilder.append("Rental Record for " + getName() + "\n");

        for (Rental rental : rentals) {
            double thisAmount = 0;

            //determine amounts for each line
            switch (rental.getMovie().getType()) {
                case REGULAR:
                    thisAmount += 2;
                    if (rental.getDaysRented() > 2)
                        thisAmount += (rental.getDaysRented() - 2) * 1.5;
                    break;
                case NEW_RELEASE:
                    thisAmount += rental.getDaysRented() * 3;
                    break;
                case CHILDREN:
                    thisAmount += 1.5;
                    if (rental.getDaysRented() > 3)
                        thisAmount += (rental.getDaysRented() - 3) * 1.5;
                    break;
                default:
            }

            // add frequent renter points
            frequentRenterPoints++;
            // add bonus for a two day new release rental
            if ((rental.getMovie().getType() == MovieType.NEW_RELEASE) && rental.getDaysRented() > 1)
                frequentRenterPoints++;

            // show figures for this rental
            stringBuilder.append("\t" + rental.getMovie().getTitle() + "\t" + thisAmount + "\n");
            totalAmount += thisAmount;
        }

        // add footer lines
        stringBuilder.append( "Amount owed is " + totalAmount + "\n");
        stringBuilder.append("You earned " + frequentRenterPoints + " frequent renter points");

        return stringBuilder.toString();
    }
}
