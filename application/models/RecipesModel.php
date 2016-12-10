<?php

class RecipesModel extends MY_Model {

        // Recipe information hard-coded to avoid implementing database.
	var $data = array(
            array('code' => 'Breakfast',
                'description' => 'The most important meal of the day!',
                'ingredients' => array(
                    array('ingredient' => 'pizza slice', 'amount' => 2))),
            array('code' => 'Lunch',
                'description' => 'Something to tide you over.',
                'ingredients' => array(
                    array('ingredient' => 'kraft dinner', 'amount' => 1),
                    array('ingredient' => 'mountain dew', 'amount' => 1))),
            array('code' => 'Dinner',
                'description' => 'The meat and potatoes of the day.',
                'ingredients' => array(
                    array('ingredient' => 'steak', 'amount' => 1),
                    array('ingredient' => 'baked potatoe', 'amount' => 1),
                    array('ingredient' => 'asparagus spear', 'amount' => 4),
                    array('ingredient' => 'beer', 'amount' => 1))),
            array('code' => 'Poker Night',
                'description' => 'Just you and the fellas.',
                'ingredients' => array(
                    array('ingredient' => 'deck of cards', 'amount' => 1),
                    array('ingredient' => 'poker chips', 'amount' => 1),
                    array('ingredient' => 'cigars', 'amount' => 5),
                    array('ingredient' => 'chips', 'amount' => 3))),
            array('code' => 'Date Night',
                'description' => 'Netflix and chill?',
                'ingredients' => array(
                    array('ingredient' => 'Netflix subscription', 'amount' => 1),
                    array('ingredient' => 'candles', 'amount' => 4),
                    array('ingredient' => 'wine', 'amount' => 2))),
            array('code' => 'House Cleaning',
                'description' => 'For that once every couple months occasion.',
                'ingredients' => array(
                    array('ingredient' => 'febreeze', 'amount' => 1),
                    array('ingredient' => 'garbage bag', 'amount' => 3)))
	);

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
}
