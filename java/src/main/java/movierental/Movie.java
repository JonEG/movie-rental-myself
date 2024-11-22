package movierental;

enum MovieType {
	CHILDREN, NEW_RELEASE, REGULAR
}

public class Movie {
    private String title;
    private MovieType type;
    
    public Movie(String title, MovieType type) {
    	this.title = title;
    	this.type = type;
	}

    public String getTitle() {
        return title;
    }
    
    public MovieType getType() {
    	return type;
	}
	
	@Override
	public boolean equals(Object other) {
		if (other == null || (this.getClass() != other.getClass())) {
		    return false;
		} else {
			Movie aux = (Movie) other;
			boolean sameTitle = title == aux.title;
			boolean sameType = type == aux.type;
			return sameTitle && sameType;
		}
	}
}
