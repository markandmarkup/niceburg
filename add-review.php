<?php

?>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Pacifico|Quattrocento+Sans:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="normalize.css" />
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <title>NiceBurg | Burger Reviews</title>
</head>
<body>
<div class="content-column">
    <header>
        <img src="./images/logoburger_400.png" />
        <h1>NiceBurg</h1>
        <h2>Burger reviews to sink your teeth into</h2>
    </header>

    <div class="section-header">
        <a class="home-link" href="index.php">&lt; Home</a>
        <h3>Add a review</h3>
    </div>

    <section class="review-form">
        <form action="add-review.php" method="post">
            <div class="form-line">
                <label for="burger_name">Burger Name</label><input id="burger_name" name="burger_name" type="text" />
            </div>
            <div class="form-error-message">There is an error in your input</div>

            <div class="form-line">
                <label for="restaurant">Restaurant</label><input id="restaurant" name="restaurant" type="text" />
            </div>
            <div class="form-error-message">There is an error in your input</div>

            <div class="form-line">
                <label for="visit_date">Visit Date</label><input id="visit_date" name="visit_date" type="date" />
            </div>
            <div class="form-error-message">There is an error in your input</div>

            <div class="form-line">
                <label for="price">Price</label><span>&#163;</span><input id="price" name="price" type="text" />
            </div>
            <div class="form-error-message">There is an error in your input</div>

            <div class="rating-box">
                <div class="form-line">
                <label for="patty_rating">Patty Score</label>
                <div class="score-container">
                    <input type="radio" class="burger-lh" name="patty_rating" value="0.5" />
                    <input type="radio" class="burger-rh" name="patty_rating" value="1" />
                    <input type="radio" class="burger-lh" name="patty_rating" value="1.5" />
                    <input type="radio" class="burger-rh" name="patty_rating" value="2" />
                    <input type="radio" class="burger-lh" name="patty_rating" value="2.5" />
                    <input type="radio" class="burger-rh" name="patty_rating" value="3" />
                    <input type="radio" class="burger-lh" name="patty_rating" value="3.5" />
                    <input type="radio" class="burger-rh" name="patty_rating" value="4" />
                    <input type="radio" class="burger-lh" name="patty_rating" value="4.5" />
                    <input type="radio" class="burger-rh" name="patty_rating" value="5" />
                </div>
                </div>

                <div class="form-line">
                <label for="topping_rating">Topping Score</label>
                <div class="score-container">
                    <input type="radio" class="burger-lh" name="topping_rating" value="0.5" />
                    <input type="radio" class="burger-rh" name="topping_rating" value="1" />
                    <input type="radio" class="burger-lh" name="topping_rating" value="1.5" />
                    <input type="radio" class="burger-rh" name="topping_rating" value="2" />
                    <input type="radio" class="burger-lh" name="topping_rating" value="2.5" />
                    <input type="radio" class="burger-rh" name="topping_rating" value="3" />
                    <input type="radio" class="burger-lh" name="topping_rating" value="3.5" />
                    <input type="radio" class="burger-rh" name="topping_rating" value="4" />
                    <input type="radio" class="burger-lh" name="topping_rating" value="4.5" />
                    <input type="radio" class="burger-rh" name="topping_rating" value="5" />
                </div>
                </div>

                <div class="form-line">
                <label for="sides_rating">Sides Score</label>
                <div class="score-container">
                    <input type="radio" class="burger-lh" name="sides_rating" value="0.5" />
                    <input type="radio" class="burger-rh" name="sides_rating" value="1" />
                    <input type="radio" class="burger-lh" name="sides_rating" value="1.5" />
                    <input type="radio" class="burger-rh" name="sides_rating" value="2" />
                    <input type="radio" class="burger-lh" name="sides_rating" value="2.5" />
                    <input type="radio" class="burger-rh" name="sides_rating" value="3" />
                    <input type="radio" class="burger-lh" name="sides_rating" value="3.5" />
                    <input type="radio" class="burger-rh" name="sides_rating" value="4" />
                    <input type="radio" class="burger-lh" name="sides_rating" value="4.5" />
                    <input type="radio" class="burger-rh" name="sides_rating" value="5" />
                </div>
                </div>

                <div class="form-line">
                <label for="value_rating">Value Score</label>
                <div class="score-container">
                    <input type="radio" class="burger-lh" name="value_rating" value="0.5" />
                    <input type="radio" class="burger-rh" name="value_rating" value="1" />
                    <input type="radio" class="burger-lh" name="value_rating" value="1.5" />
                    <input type="radio" class="burger-rh" name="value_rating" value="2" />
                    <input type="radio" class="burger-lh" name="value_rating" value="2.5" />
                    <input type="radio" class="burger-rh" name="value_rating" value="3" />
                    <input type="radio" class="burger-lh" name="value_rating" value="3.5" />
                    <input type="radio" class="burger-rh" name="value_rating" value="4" />
                    <input type="radio" class="burger-lh" name="value_rating" value="4.5" />
                    <input type="radio" class="burger-rh" name="value_rating" value="5" />
                </div>
                </div>
            </div>

            <div class="form-line">
                <label for="add_image">&#8853; Add an image</label><input id="add_image" name="add_image" type="text" />
            </div>
            <div class="form-error-message">There is an error in your input</div>

            <input type="submit" class="rounded-button" />
            <a href="#" class="rounded-button cancel">&#10005; Cancel</a>
        </form>
    </section>

</div>
</body>
</html>
