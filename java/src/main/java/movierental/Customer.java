package movierental;

import java.util.ArrayList;
import java.util.List;

public class Customer {

    private String name;
    private List<Rental> rentals = new ArrayList<>();
    private int points;
    private double debt;

    public Customer(String name) {
        this.name = name;
    }

    public void addRental(Rental rental) {
        rentals.add(rental);
        addPoints(rental);
        addDebt(rental);
    }
    
    private void addPoints(Rental rental) {
    	points += rental.calculatePoints();
    }
    
    private void addDebt(Rental rental) {
    	debt += rental.calculatePrice();
    }

    public String statement() {
        StringBuilder stringBuilder = new StringBuilder();
        stringBuilder.append("Rental Record for " + name + "\n");

        for (Rental rental : rentals) {
            // show figures for this rental
            stringBuilder.append("\t" + rental.getMovieTitle() + "\t" + rental.calculatePrice() + "\n");
        }

        // add footer lines
        stringBuilder.append( "Amount owed is " + debt + "\n");
        stringBuilder.append("You earned " + points + " frequent renter points");

        return stringBuilder.toString();
    }
}
