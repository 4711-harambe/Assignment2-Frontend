<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends Application {

	public function __construct() {
		parent::__construct();
	}
	/**
	 * Index Page for the Production controller.
	 */
	public function index()
	{
		if (!($this->session->userdata('userrole') == 'admin' || $this->session->userdata('userrole') == 'user'))
		{
			$this->data['pagetitle'] = "Production Page";
			$this->data['message'] = "Invalid Credentials for Page Access";
			$this->data['pagebody'] = "error_view";
			$this->render();
			return;
		}

		$stockQuery = $this->StockModel->all();
		foreach ($stockQuery as $stock) {
			$stockList[$stock->code] = $stock->quantityOnHand;
		}
		$suppliesQuery = $this->SuppliesModel->all();
		foreach ($suppliesQuery as $supply) {
			$supplies[$supply->code] = $supply->quantityOnHand;
		}

		$recipes = $this->RecipesModel->all();
		foreach ($recipes as &$recipe) {
			$can_produce = TRUE;
			$recipe->ingredients = '';

			if (!array_key_exists($recipe->code, $stockList)) {
				$stockList[$recipe->code] = 0;
			}
			$recipe->stock = $stockList[$recipe->code];
			$ingredients = $this->db->query("SELECT * FROM Ingredients WHERE ingredientsCode = ?", array($recipe->ingredientsCode));
			foreach ($ingredients->result() as $row) {
				if (!array_key_exists($row->ingredient, $supplies)) {
					$supplies[$row->ingredient] = 0;
				}
				if ($supplies[$row->ingredient] < $row->amount) {
					$can_produce = FALSE;
				}
				$recipe->ingredients .= '<li>' . $row->ingredient . ' ( ' . $supplies[$row->ingredient] . ' / ' . $row->amount . ' )</li>';
			}
			if ($can_produce) {
				$recipe->produceButton = "<a type='button' class='btn btn-primary' href='/production/create/" . $recipe->id . "'>Create</a>";
			} else {
				$recipe->produceButton = "<a type='button' class='btn btn-danger' disabled>Create</a>";
			}
		}
		$this->data['recipes'] = $recipes;
		$this->data['pagetitle'] = "Production Page";
		$this->data['pagebody'] = 'production_view';
		$this->render();
	}

	public function create($recipeID) {
		$suppliesQuery = $this->SuppliesModel->all();
		foreach ($suppliesQuery as $supply) {
			$supplies[$supply->code] = array("id" => $supply->id, "quantity" => $supply->quantityOnHand, "description" => $supply->description);
		}
		$stock = $this->StockModel->get($recipeID);
		$recipe = $this->RecipesModel->get($recipeID);
		$currentStock = $stock->quantityOnHand;
		$updatedStock = array("id" => $recipeID, "quantityOnHand" => $currentStock + 1);
		$this->StockModel->update($updatedStock);

		$ingredients = $this->db->query("SELECT * FROM Ingredients WHERE ingredientsCode = ?", array($recipe->ingredientsCode));
		foreach ($ingredients->result() as $row) {

			$updatedSupply = array("id" => $supplies[$row->ingredient]["id"],
								   "quantityOnHand" => $supplies[$row->ingredient]["quantity"] - $row->amount,
								   "description" => $supplies[$row->ingredient]["description"]);
			$this->SuppliesModel->update($updatedSupply);
		}
                
                $this->LogRecipeCreate($recipe);

		// Add logic to reduce Supplies level
		redirect('/production', 'refresh');
	}
        
    public function LogRecipeCreate($recipe) {
        $id = rand(100, 999);

        // use this if the file doesn't exist
        while (file_exists('../data/recipeCreate' . $id . '.xml')) {
            $id = rand(100, 999);
        }
        // and establish the checkout time
        $dateTime = date(DATE_ATOM);

        // start empty
        $xml = new SimpleXMLElement('<createRecipe/>');

        $xml->addChild('number', $id);
        $xml->addChild('datetime', $dateTime);
        $xml->addChild('recipeName', $recipe->code);

        $xml->asXML('../data/recipeCreate' . $id . '.xml');
    }       
}
