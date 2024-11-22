package movierental;

/**
 * The rental class represents a customer renting a movie.
 */
public class Rental {

    private Movie movie;
    private int daysRented;

    public Rental(Movie movie, int daysRented) {
        this.movie = movie;
        this.daysRented = daysRented;
    }

    public int getDaysRented() {
        return daysRented;
    }


    public String getMovieTitle() {
        return movie.getTitle();
    }
    
    public double calculatePrice() {
    	double basePrice = 0.0;
    	int numberOfDaysIncluded = 0;
    	double costPerDayExtra = 0.0;
		switch (movie.getType()) {
		    case REGULAR:
		        basePrice = 2;
		        numberOfDaysIncluded = 2;
		        costPerDayExtra =  1.5;
		        break;
		    case NEW_RELEASE:
		    	basePrice = 0;
		        numberOfDaysIncluded = 0;
		        costPerDayExtra =  3;
		        break;
		    case CHILDREN:
		    	basePrice = 1.5;
		    	numberOfDaysIncluded = 3;
		        costPerDayExtra =  1.5;
		        break;
		    default:
		}
		
		return basePrice + calculateExtraDaysCost(numberOfDaysIncluded, costPerDayExtra);
	}
    
    private double calculateExtraDaysCost(int numberOfDaysIncluded, double costPerDayExtra) {
    	int extraDays = daysRented - numberOfDaysIncluded;
    	if(extraDays < 1) {
    		return 0;
    	}else {
    		return extraDays * costPerDayExtra;
    	}
    }
    
	public int calculatePoints() {
		// add frequent renter points
		int frequentRenterPoints = 1;
		// add bonus for a two day new release rental
		if ((movie.getType() == MovieType.NEW_RELEASE) && daysRented > 1)
		    frequentRenterPoints++;
		return frequentRenterPoints;
	}
}
