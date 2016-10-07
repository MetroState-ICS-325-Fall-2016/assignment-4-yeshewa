<?php
/**
 * Created by PhpStorm.
 * User: Yeshewatsehay Berhane
 * Date: 10/5/2016
 * Time: 11:05 PM
 */

// This assumes FormHelper.php is in the same directory as
// this filek.
require 'FormHelper.php';

// setup the arrays of choices in the select menus
// these are needed in display_form( ), validate_form( ),
// and process_form( ), so they are declared in the global scope
$sweets = array('puff' => 'Sesame Seed Puff',
                'square' => 'Coconut Milk Gelatin Square',
                'cake' => 'Brown Sugar Cake',
                'ricemeat' => 'Sweet Rice and Meat');
                'icecream' => 'IceCream');

$main_dishes = array('cuke' => 'Braised Sea Cucumber',
                     'stomach' => "Sauteed Pig's Stomach",
                     'tripe' => 'Sauteed Tripe with Wine Sauce',
                     'taro' => 'Stewed Pork with Taro',
                     'giblets' => 'Baked Giblets with Salt',
                     'abalone' => 'Abalone with Marrow and Duck Feet');
                     'Cheesepizza' => 'Cheese Pizza');
$drink = array('Coke'=> "Coke",
               'DCoke'=> "Diet Coke",
               'Sprite'=> "Sprite",
               'Milk'=> "Milk",
               'Water'=> "Water");

// The main page logic:
// - If the form is submitted, validate and then process or redisplay
// - If it's not submitted, display
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // If validate_form( ) returns errors, pass them to show_form( )
    list($errors, $input) = validate_form();
    if ($errors) {
        show_form($errors);
    } else {
        // The submitted data is valid, so process it
        process_form($input);
    }
} else {
    // The form wasn't submitted, so display
    show_form();
}

function show_form($errors = array()) {
    $defaults = array('delivery' => 'yes',
                      'size'     => 'large');
    // Set up the $form object with proper defaults
    $form = new FormHelper($defaults);

    // All the HTML and form display is in a separate file for clarity
    include 'complete-form.php';
}

function validate_form( ) {
    $input = array();
    $errors = array( );

    // name is required
    if (isset($_POST['name'])) {
        $input['name'] = trim($_POST['name']);
    } else {
        $input['name'] = '';
    }
    if (! strlen($input['name'])) {
        $errors[] = 'Please enter your name.';
    }
    // email is required
    if(isset($_POST['email'])) {
        $input['email'] = trim($_POST['email']);
        if(false===filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)){
            $errors[]="Email is not valid",
        }
    } else {
        $input['email'] = '';
    }
    if(! strlen($input['email'])){
        $errors[]='Please enter your email.';
    }
    //size is required
    if(isset($_POST['size'])){
        $input['size']=trim($_POST['size']);
    }else{
        $input['size']='';
    }
    if (! in_array($input['size'], ['small','medium','large','XLarge'])) {
        $errors[] = 'Please select a size.';
    }
    // sweet is required
    if (isset($_POST['sweet'])) {
        $input['sweet'] = $_POST['sweet'];
    } else {
        $input['sweet'] = '';
    }
    if (! array_key_exists($input['sweet'], $GLOBALS['sweets'])) {
        $errors[] = 'Please select a valid sweet item.';
    }
    if(isset($_POST['drink'])){
        $input['drink']=$_POST['drink'];
    }else{
        $input['drink']='';
    }
    if(!array_key_exists($input['sweet'],$GLOBALS['sweets'])){
        $errors[] = 'Please selet a valid sweet item.';
    }
    // exactly two main dishes required
    if (isset($_POST['main_dish'])) {
        $input['main_dish'] = $_POST['main_dish'];
    } else {
        $input['main_dish'] = array();
    }
    if (count($input['main_dish']) != 2) {
        $errors[] = 'Please select exactly two main dishes.';
    } else {
        // We know there are two main dishes selected, so make sure they are
        // both valid
        if (! (array_key_exists($input['main_dish'][0], $GLOBALS['main_dishes']) &&
               array_key_exists($input['main_dish'][1], $GLOBALS['main_dishes']))) {
            $errors[] = 'Please select exactly two valid main dishes.';
        }
    }
    // if delivery is checked, then comments must contain something
    if (isset($_POST['delivery'])) {
        $input['delivery'] = $_POST['delivery'];
    } else {
        $input['delivery'] = 'no';
    }
    if (isset($_POST['comments'])) {
        $input['comments'] = trim($_POST['comments']);
    } else {
        $input['comments'] = '';
    }
    if (($input['delivery'] == 'yes') && (! strlen($input['comments']))) {
        $errors[] = 'Please enter your address for delivery.';
    }

    return array($errors, $input);
}

function process_form($input) {
    // look up the full names of the sweet and the main dishes in
    // the $GLOBALS['sweets'] and $GLOBALS['main_dishes'] arrays
    /*print_r($GLOBALS;*/
    $sweet = $GLOBALS['sweets'][ $input['sweet'] ];
    $main_dish_1 = $GLOBALS['main_dishes'][ $input['main_dish'][0] ];
    $main_dish_2 = $GLOBALS['main_dishes'][ $input['main_dish'][1] ];
    $drink = $GLOBALS['drink'][$input['drink']];

    if (isset($input['delivery']) && ($input['delivery'] == 'yes')) {
        $delivery = 'do';
    } else {
        $delivery = 'do not';
    }
    // build up the text of the order message
    $message=<<<_ORDER_
Thank you for your order, {$input['name']}at{$input['email']}
You requested the {$input['size']} size of $sweet, $main_dish_1, and $main_dish_2.
You $delivery want delivery.\n
_ORDER_;
    if (strlen(trim($input['comments']))) {
        $message .= 'Your comments: '.$input['comments'];
    }

    // send the message to the chef (don't actually try to send it, uncomment for production):
    # mail('chef@restaurant.example.com', 'New Order', $message);

    // print the message, but encode any HTML entities
    // and turn newlines into <br/> tags
    print str_replace('&NewLine;', "<br />\n", htmlentities($message, ENT_HTML5));
}

