<?php

/**
 * Modified to use REST client to get port data from our server.
 */
define('REST_SERVER', 'http://backend.local');  // the REST server host
define('REST_PORT', $_SERVER['SERVER_PORT']);   // the port you are running the server on


class SuppliesModel extends CI_Model {

        var $data = array(
            array('id' => 1,
                'code' => 'pizza slice',
                'description' => 'Slice of pepperoni pizza.',
                'receivingUnit' => 'slice',
                'receivingCost' => 2,
                'stockingUnit' => 'slice',
                'quantityOnHand' => 0),
            array('id' => 2,
                'code' => 'kraft dinner',
                'description' => 'Macaroni and cheese.',
                'receivingUnit' => 'box',
                'receivingCost' => 1.5,
                'stockingUnit' => 'box',
                'quantityOnHand' => 10),
            array('id' => 3,
                'code' => 'mountain dew',
                'description' => 'Nectar of the nerds.',
                'receivingUnit' => 'bottle',
                'receivingCost' => 2.5,
                'stockingUnit' => '1L bottle',
                'quantityOnHand' => 13),
            array('id' => 4,
                'code' => 'steak',
                'description' => 'Just the beef.',
                'receivingUnit' => 'single',
                'receivingCost' => 8,
                'stockingUnit' => 'single',
                'quantityOnHand' => 20),
            array('id' => 5,
                'code' => 'baked potatoe',
                'description' => 'Russet potatoe.',
                'receivingUnit' => 'single',
                'receivingCost' => .5,
                'stockingUnit' => 'single',
                'quantityOnHand' => 25),
            array('id' => 6,
                'code' => 'asparagus spear',
                'description' => 'Fresh non-organic asparagus.',
                'receivingUnit' => 'spear',
                'receivingCost' => 3,
                'stockingUnit' => 'spear',
                'quantityOnHand' => 30),
            array('id' => 7,
                'code' => 'beer',
                'description' => 'Local craft beer.',
                'receivingUnit' => 'bottle',
                'receivingCost' => 8,
                'stockingUnit' => '22oz bottle',
                'quantityOnHand' => 25),
            array('id' => 8,
                'code' => 'deck of cards',
                'description' => 'Simple and cheap fun.',
                'receivingUnit' => 'deck',
                'receivingCost' => 1,
                'stockingUnit' => 'deck',
                'quantityOnHand' => 15),
            array('id' => 9,
                'code' => 'poker chips',
                'description' => 'Casino chip set.',
                'receivingUnit' => 'set',
                'receivingCost' => 50,
                'stockingUnit' => 'set',
                'quantityOnHand' => 0),
            array('id' => 10,
                'code' => 'cigars',
                'description' => 'Premium Cuban cigars.',
                'receivingUnit' => 'single',
                'receivingCost' => 15,
                'stockingUnit' => 'single',
                'quantityOnHand' => 40),
            array('id' => 11,
                'code' => 'chips',
                'description' => 'Good old fashioned salt and vinegar.',
                'receivingUnit' => 'bag',
                'receivingCost' => 3.5,
                'stockingUnit' => 'bag',
                'quantityOnHand' => 20),
            array('id' => 12,
                'code' => 'Netflix subscription',
                'description' => 'The be-all end-all of streaming media.',
                'receivingUnit' => 'subscription',
                'receivingCost' => 9.99,
                'stockingUnit' => 'subscription',
                'quantityOnHand' => 9999),
            array('id' => 13,
                'code' => 'candles',
                'description' => 'Fancy-smelling candles.',
                'receivingUnit' => 'single',
                'receivingCost' => 5,
                'stockingUnit' => 'single',
                'quantityOnHand' => 30),
            array('id' => 14,
                'code' => 'wine',
                'description' => 'Run of the mill Riesling.',
                'receivingUnit' => 'bottle',
                'receivingCost' => 15,
                'stockingUnit' => '750ml bottle',
                'quantityOnHand' => 28),
            array('id' => 15,
                'code' => 'febreeze',
                'description' => 'Cleaning supplies for lazy people.',
                'receivingUnit' => 'bottle',
                'receivingCost' => 5,
                'stockingUnit' => 'bottle',
                'quantityOnHand' => 4),
            array('id' => 16,
                'code' => 'garbage bag',
                'description' => 'hefty x-large black garbage bags.',
                'receivingUnit' => 'bag',
                'receivingCost' => 4,
                'stockingUnit' => 'bag',
                'quantityOnHand' => 21));


	// Constructor
	public function __construct()
	{
		parent::__construct();
	}

	// Retrieve all the recipes
	public function all()
	{
		return $this->data;
	}

        // Retrieve a single recipe.
        public function singleSupply($supplyCode) {
            foreach ($this->data as $supply) {
                if ($supply['code'] == $supplyCode) {
                    return $supply;
                }
            }

            return null;
        }

    public function details($id)
    {
        foreach ($this->data as $supply) {
            if ($supply['id'] == $id) {
                return $supply;
            }
        }

        return null;
    }

        // Add a supply item to the data.
        public function addSupply($supply) {
            array_push($this->data, $supply);
        }

        // Delete a supply item from the data.
        public function deleteSupply($code) {
            foreach ($this->data as $supply) {
                if ($supply['code'] == $code) {
                    unset($this->data[$code]);
                }
            }
        }
}
