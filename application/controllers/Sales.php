<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends Application {

	public function __construct() {
		parent::__construct();
	}
	/**
	 * Index Page for the Production controller.
	 */
	public function index()
	{
                $this->data['pagebody'] = 'sales/sales_view';
                $this->data['pagetitle'] = 'Sales Page';
				$stock = $this->StockModel->all();
				foreach ($stock as &$stockItem) {
					if ($stockItem->quantityOnHand > 0) {
						$stockItem->buyButton = "<a type='button' class='btn btn-primary' href='/sales/buy/" . $stockItem->id . "'>Buy</a>";
					} else {
						$stockItem->buyButton = "<a type='button' class='btn btn-danger' disabled>Buy</a>";
					}
					$stockItem->detailsLink = "<a href='sales/item_view/" . $stockItem->id . "'>" . $stockItem->code . "</a>";
				}

                $this->data['stock'] = $stock;
                $this->render();
	}

    public function showDetails($recipeID)
    {
		$this->data['ingredients'] = '';
		$recipe = $this->RecipesModel->get($recipeID);
		$stock = $this->StockModel->get($recipeID);
		$ingredients = $this->db->query("SELECT * FROM Ingredients WHERE ingredientsCode = ?", array($recipe->ingredientsCode));
		foreach ($ingredients->result() as $row) {
			$this->data['ingredients'] .= '<li>' . $row->ingredient . '</li>';
		}

        $this->data['pagetitle'] = $recipe->code;

        $this->data['code'] = $recipe->code;
        $this->data['description'] = $recipe->description;
        $this->data['sellingPrice'] = $stock->sellingPrice;
        $this->data['quantityOnHand'] = $stock->quantityOnHand;

		if ($stock->quantityOnHand > 0) {
			$this->data['buyButton'] = "<a type='button' class='btn btn-primary' href='/sales/buy/" . $stock->id . "'>Buy</a>";
		} else {
			$this->data['buyButton'] = "<a type='button' class='btn btn-danger' disabled>Buy</a>";
		}

        $this->data['pagebody'] = 'sales/item_view';
        $this->render();

    }

    public function buy($stockID) {
		$stock = $this->StockModel->get($stockID);
		$currentStock = $stock->quantityOnHand;
		$updatedStock = array("id" => $stockID, "quantityOnHand" => $currentStock - 1);
		$this->StockModel->update($updatedStock);

		redirect('/sales', 'refresh');
	}

        public function phpAlert($msg) {
	    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	}

}
