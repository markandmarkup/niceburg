<?php

require_once '../functions.php';

use PHPUNIT\Framework\TestCase;

class FunctionTests extends TestCase
{
    // function dateFormatUK Tests

    public function testSuccessDateFormat()
    {
        $input = [['visit_date' => '2020-02-02'], ['visit_date' => '2019-11-30']];
        $expected = [['visit_date' => '02/02/2020'], ['visit_date' => '30/11/2019']];
        $case = dateFormatUK($input);
        $this->assertEquals($expected, $case);
    }

    //passing an array item with null value
    public function testFailureDateFormatNull()
    {
        $input = [['visit_date' => null], ['visit_date' => '2019-11-30']];
        $expected = [['visit_date' => ''], ['visit_date' => '30/11/2019']];
        $case = dateFormatUK($input);
        $this->assertEquals($expected, $case);
    }

    //passing an array without a 'visit_date' key
    public function testFailureDateFormatNoDate()
    {
        $input = [['name' => 'john', 'age' => 24], ['name' => 'dave', 'age' => 50]];
        $expected = [['name' => 'john', 'age' => 24], ['name' => 'dave', 'age' => 50]];
        $case = dateFormatUK($input);
        $this->assertEquals($expected, $case);
    }

    //passing an empty array to the function
    public function testFailureDateFormatEmptyArray()
    {
        $input = [];
        $expected = [];
        $case = dateFormatUK($input);
        $this->assertEquals($expected, $case);
    }

    //passing an array where the dates are already formatted
    public function testFailureDateFormatPreFormat()
    {
        $input = [['visit_date' => '02/02/2020'], ['visit_date' => '01/01/2019']];
        $expected = [['visit_date' => '02/02/2020'], ['visit_date' => '01/01/2019']];
        $case = dateFormatUK($input);
        $this->assertEquals($expected, $case);
    }

    public function testMalformedDateFormat()
    {
        $this->expectException(TypeError::class);
        $input = '2020-03-02';
        $case = dateFormatUK($input);
    }

    // function displayReviews Tests

    public function testSuccessDisplayReviews()
    {
        $input = [['burger_name' => 'Burger', 'restaurant' => 'McDonalds', 'visit_date' => '01/01/2020', 'image' => './images/burger.jpg', 'price' => '5.57', 'patty_rating' => 4, 'topping_rating' => 1.5, 'sides_rating' => 3, 'value_rating' => 2.5, 'total_score' => 3.2], ['burger_name' => 'Burger2', 'restaurant' => 'BurgerKing', 'visit_date' => '01/01/2020', 'image' => './images/burger.jpg', 'price' => '5.57', 'patty_rating' => 4, 'topping_rating' => 1.5, 'sides_rating' => 3, 'value_rating' => 2.5, 'total_score' => 3.2]];
        $expected = '<div class="review"><div class="review-content"><div class="review-image" style="background-image: url(./images/burger.jpg);"></div><div class="item-titles"><h4>Burger</h4><h5>McDonalds</h5></div><table class="stats"><tr><th>Visit Date:</th><td>01/01/2020</td></tr><tr><th>Price:</th><td>£5.57</td></tr><tr><th>Burger Patty:</th><td>4</td></tr><tr><th>Toppings &amp; bun:</th><td>1.5</td></tr><tr><th>Sides:</th><td>3</td></tr><tr><th>Value:</th><td>2.5</td></tr></table></div><p class="rating">Total Score:&nbsp;&nbsp;<span>3.2</span></p></div>';
        $expected .= '<div class="review"><div class="review-content"><div class="review-image" style="background-image: url(./images/burger.jpg);"></div><div class="item-titles"><h4>Burger2</h4><h5>BurgerKing</h5></div><table class="stats"><tr><th>Visit Date:</th><td>01/01/2020</td></tr><tr><th>Price:</th><td>£5.57</td></tr><tr><th>Burger Patty:</th><td>4</td></tr><tr><th>Toppings &amp; bun:</th><td>1.5</td></tr><tr><th>Sides:</th><td>3</td></tr><tr><th>Value:</th><td>2.5</td></tr></table></div><p class="rating">Total Score:&nbsp;&nbsp;<span>3.2</span></p></div>';
        $case = displayReviews($input);
        $this->assertEquals($expected, $case);
    }

    //passing the function an empty array
    public function testFailureDisplayReviewsEmptyArray()
    {
        $input = [];
        $expected = 'No records to display';
        $case = displayReviews($input);
        $this->assertEquals($expected, $case);
    }

    //passing the function a simple data type
    public function testMalformedDisplayReviews()
    {
        $this->expectException(TypeError::class);
        $input = 'Burger';
        $case = displayReviews($input);
    }

// function checkReviewKeys Tests

    //passing the function an array with exact fields
    public function testSuccessCheckReviewKeys()
    {
        $input = [['burger_name' => 'Burger', 'restaurant' => 'McDonalds', 'visit_date' => '01/01/2020', 'image' => './images/burger.jpg', 'price' => '5.57', 'patty_rating' => 4, 'topping_rating' => 1.5, 'sides_rating' => 3, 'value_rating' => 2.5, 'total_score' => 3.2]];
        $expected = true;
        $case = checkReviewKeys($input);
        $this->assertEquals($expected, $case);
    }

    //passing the function a non-nested array
    public function testFailureCheckReviewKeysNonNestArray()
    {
        $input = ['burger_name' => 'Burger', 'restaurant' => 'McDonalds', 'visit_date' => '01/01/2020', 'image' => './images/burger.jpg', 'price' => '5.57', 'patty_rating' => 4, 'topping_rating' => 1.5, 'sides_rating' => 3, 'value_rating' => 2.5];
        $expected = false;
        $case = checkReviewKeys($input);
        $this->assertEquals($expected, $case);
    }


    //passing the function an array with too few fields
    public function testFailureCheckReviewKeysNotEnoughFields()
    {
        $input = [['burger_name' => 'Burger', 'restaurant' => 'McDonalds', 'visit_date' => '01/01/2020', 'image' => './images/burger.jpg', 'price' => '5.57', 'patty_rating' => 4, 'topping_rating' => 1.5, 'sides_rating' => 3, 'value_rating' => 2.5]];
        $expected = false;
        $case = checkReviewKeys($input);
        $this->assertEquals($expected, $case);
    }

    //passing the function null values
    public function testFailureCheckReviewKeysNullValues()
    {
        $input = [['burger_name' => null, 'restaurant' => null, 'visit_date' => null, 'image' => null, 'price' => null, 'patty_rating' => null, 'topping_rating' => null, 'sides_rating' => null, 'value_rating' => null]];
        $expected = false;
        $case = checkReviewKeys($input);
        $this->assertEquals($expected, $case);
    }

    //passing a simple input type
    public function testMalformedCheckReviewKeys()
    {
        $this->expectException(TypeError::class);
        $input = 'burger';
        $case = checkReviewKeys($input);
    }

//function checkNewReviewKeys tests

    public function testSuccessCheckNewReviewKeys()
    {
        $input = ['burger_name'=>'B', 'restaurant'=>'B', 'visit_date'=>'2020-01-01', 'price'=>5, 'patty_rating'=>5, 'topping_rating'=>5, 'sides_rating'=>5, 'value_rating'=>5];
        $expected = true;
        $case = checkNewReviewKeys($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureCheckNewReviewKeysMissingKey()
    {
        $input = ['burger_name'=>'B', 'restaurant'=>'B', 'visit_date'=>'2020-01-01', 'price'=>5, 'patty_rating'=>5, 'topping_rating'=>5, 'sides_rating'=>5];
        $expected = false;
        $case = checkNewReviewKeys($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureCheckNewReviewKeysExtraKey()
    {
        $input = ['burger_name'=>'B', 'restaurant'=>'B', 'visit_date'=>'2020-01-01', 'price'=>5, 'patty_rating'=>5, 'topping_rating'=>5, 'sides_rating'=>5, 'value_rating'=>5, 'extra'=>'donk'];
        $expected = false;
        $case = checkNewReviewKeys($input);
        $this->assertEquals($expected, $case);
    }

    public function testMalformedCheckNewReviewKeys()
    {
        $this->expectException(TypeError::class);
        $input = 'burger';
        $case = checkNewReviewKeys($input);
    }


//function validateMediumString tests

    public function testSuccessValidateMediumString()
    {
        $input = 'Burger';
        $expected = '';
        $case = validateMediumString($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureValidateMediumStringEmpty()
    {
        $input = '';
        $expected = 'Input should be between 1 and 200 characters long';
        $case = validateMediumString($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureValidateMediumStringTooLong()
    {
        $input = 'bQYNMYEVt5Motz68IUAXBvhAin2qVHZW2E3ESEChylNJOrkk0qewiD5mcmOg3nwZWlRNNhB0SGE0GorPLHrFWRoerMZIhPdJq398SxKQk4LNlgavmDaJlXSbj2mHO34da49aXmgoTL2JHXJrbRnyNsHFnhtv9gAZ7tj7f6x2Ey7CrwsDZVC73bY6Ihk3VIGd4ipTXTojR';
        $expected = 'Input should be between 1 and 200 characters long';
        $case = validateMediumString($input);
        $this->assertEquals($expected, $case);
    }

    public function testMalformedValidateMediumString()
    {
        $this->expectException(TypeError::class);
        $input = ['name'=>'burger'];
        $case = validateMediumString($input);
    }


//function validateDate tests

    public function testSuccessValidateDate()
    {
        $input = '2020-01-01';
        $expected = '';
        $case = validateDate($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureValidateDateTooShort()
    {
        $input = '2001';
        $expected = 'Date not in the correct format';
        $case = validateDate($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureValidateDateTooLong()
    {
        $input = '2001-001-01';
        $expected = 'Date not in the correct format';
        $case = validateDate($input);
        $this->assertEquals($expected, $case);
    }

    public function testMalformedValidateDate()
    {
        $this->expectException(TypeError::class);
        $input = ['date'=>'Today'];
        $case = validateDate($input);
    }


//function validatePrice tests

    public function testSuccessValidatePrice()
    {
        $input = 3.99;
        $expected = '';
        $case = validatePrice($input);
        $this->assertEquals($expected, $case);
    }

    public function testSuccessValidatePriceInteger()
    {
        $input = 7;
        $expected = '';
        $case = validatePrice($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureValidatePriceTooSmall()
    {
        $input = -2.22;
        $expected = 'Enter a value between £0.00 and £999.99';
        $case = validatePrice($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureValidatePriceTooBig()
    {
        $input = 1234.56;
        $expected = 'Enter a value between £0.00 and £999.99';
        $case = validatePrice($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureValidatePriceTooManyDecimals()
    {
        $input = 6.456;
        $expected = 'Enter a value with no more than 2 decimal places';
        $case = validatePrice($input);
        $this->assertEquals($expected, $case);
    }

    public function testMalformedValidatePrice()
    {
        $this->expectException(TypeError::class);
        $input = ['price'=>'Five'];
        $case = validatePrice($input);
    }



//function validateRating tests

    public function testSuccessValidateRating()
    {
        $input = 2.5;
        $expected = '';
        $case = validateRating($input);
        $this->assertEquals($expected, $case);
    }

    public function testSuccessValidateRatingInteger()
    {
        $input = 4;
        $expected = '';
        $case = validateRating($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureValidateRatingTooSmall()
    {
        $input = -1;
        $expected = 'Ratings should be between 0 and 5';
        $case = validateRating($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureValidateRatingTooBig()
    {
        $input = 5.5;
        $expected = 'Ratings should be between 0 and 5';
        $case = validateRating($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureValidateRatingTooManyDecimals()
    {
        $input = 3.75;
        $expected = 'Enter a value with no more than 1 decimal place';
        $case = validateRating($input);
        $this->assertEquals($expected, $case);
    }

    public function testMalformedValidateRating()
    {
        $this->expectException(TypeError::class);
        $input = ['patty_rating'=>'4'];
        $case = validateRating($input);
    }


//function calcTotalScore tests

    public function testSuccessCalcTotalScore()
    {
        $input = [5, 6, 10, 4];
        $expected = 6.3;
        $case = calcTotalScore($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureCalcTotalScoreEmptyInput()
    {
        $input = [];
        $expected = 0;
        $case = calcTotalScore($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureCalcTotalScoreOneInput()
    {
        $input = [5];
        $expected = 5;
        $case = calcTotalScore($input);
        $this->assertEquals($expected, $case);
    }

    public function testMalformedCalcTotalScore()
    {
        $this->expectException(TypeError::class);
        $input = 5;
        $case = calcTotalScore($input);
    }
}