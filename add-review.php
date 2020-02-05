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
            <label for="burger_name">Burger name<input id="burger_name" name="burger_name" type="text" /></label>
            <label for="restaurant">Restaurant<input id="restaurant" name="restaurant" type="text" /></label>
            <label for="visit_date">Visit Date<input id="visit_date" name="visit_date" type="date" /></label>
            <label for="price">Price <span>&#163;</span><input id="price" name="price" type="text" /></label>
            <div class="rating-box">
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
            <label for="add_image">&#8853; Add an image<input id="add_image" name="add_image" type="text" /></label>
            <input type="submit" class="rounded-button" />
            <a href="#" class="rounded-button cancel">&#10005; Cancel</a>
        </form>
    </section>

</div>
</body>
</html>
