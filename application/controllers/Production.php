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
		$recipes = $this->RecipesModel->all();
		$this->data['recipes'] = $recipes;
		$this->data['pagetitle'] = "Production Page";
		$this->data['pagebody'] = 'production_view';
		$this->render();
		//$this->load->view('production_view', $this->data);
	}

	public function getViewData() {
		$recipes = $this->getRecipes();
		foreach ($recipes as &$recipe) {
			$can_produce = TRUE;
			foreach ($recipe['ingredients'] as &$ingredient) {
				$ingredient['amt_in_stock'] = $this->getSupplyCount($ingredient['ingredient']);
				if ($ingredient['amt_in_stock'] < $ingredient['amount']) {
					$can_produce = FALSE;
				}
			}
			$recipe['can_produce'] = $can_produce;
			$recipe['prod_link'] = str_replace(' ', '_', $recipe['code']);
		}
		return $recipes;
	}

	public function getRecipes() {
		$recipes = $this->recipesModel->all();
		return $recipes;
	}

	public function getSupplyCount($code) {
		$supplyCount = $this->suppliesModel->singleSupply($code)['quantityOnHand'];
		return $supplyCount;
	}

	public function create($code) {
		$normalCode = str_replace('_', ' ', $code);
		$stockCount = $this->stockModel->singleStock($normalCode)['quantityOnHand'];
		$this->phpAlert("Created 1 " . $normalCode . ". There are now " . ($stockCount + 1) . " in stock.");
		redirect('/production', 'refresh');
	}

	public function phpAlert($msg) {
	    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	}
}
