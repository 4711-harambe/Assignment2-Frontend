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
					$can_buy = TRUE;
					if ($stockItem->quantityOnHand < 1) {
						$can_buy = FALSE;
					}
					if ($can_buy) {
						$stockItem->buyButton = "<a type='button' class='btn btn-primary' href='/sales/buy/" . $stockItem->id . "'>Buy</a>";
					} else {
						$stockItem->buyButton = "<a type='button' class='btn btn-danger' disabled>Buy</a>";
					}
				}

                $this->data['stock'] = $stock;

                $this->render();
	}

    public function showDetails($code)
    {
        $normalCode = str_replace('_', ' ', $code);
        $this->data['pagebody'] = 'sales/item_view';
        $stock = $this->stockModel->singleStock($normalCode);
        $recipe = $this->recipesModel->singleRecipe($normalCode);
        $this->data['pagetitle'] = $stock['code'];

        $this->data['code'] = $stock['code'];
        $this->data['link'] = str_replace(' ', '_', $stock['code']);
        $this->data['description'] = $stock['description'];
        $this->data['sellingPrice'] = $stock['sellingPrice'];
        $this->data['quantityOnHand'] = $stock['quantityOnHand'];

        $ingredients = array();

        foreach ($recipe['ingredients'] as $item)
        {
            $ingredients[] = array(
                'ingredient' => $item['ingredient'],
                'amount' => $item['amount']);
        }
        $this->data['ingredients'] = $ingredients;

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
