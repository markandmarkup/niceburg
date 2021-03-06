<?php

require_once 'dbConnect.php';
require_once 'functions.php';

$db = dbConnect();
$all_records = getAllReviews($db);
$all_records = dateFormatUK($all_records);

if (checkReviewKeys($all_records)) {
$burger_reviews = displayReviews($all_records);
} else {
    $burger_reviews = 'Records do not contain the correct fields';
}

?>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Pacifico|Quattrocento+Sans:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="normalize.css" />
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <script defer src="https://kit.fontawesome.com/3d49cc2df6.js" crossorigin="anonymous"></script>
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
        <h3>All Reviews</h3>
        <a class="header-link" href="add-review.php">Add a Review &#8853;</a>
    </div>

    <section class="review-container">
        <?php echo $burger_reviews; ?>
    </section>
</div>
</body>
</html>
