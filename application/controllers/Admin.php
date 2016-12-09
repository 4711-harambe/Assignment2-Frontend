<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Application {

    public function __construct() {
        parent::__construct();
        $this->load->model('recipesModel');
        $this->load->model('suppliesModel');
        $this->load->model('stockModel');
    }

    //Index Page for the Admin controller.
    public function index() {
        if (!($this->session->userdata('userrole') == 'admin'))
        {
          $this->data['pagetitle'] = "Administrative Page";
          $this->data['message'] = "Invalid Credentials for Page Access";
          $this->data['pagebody'] = "error_view";
          $this->render();
          return;
        }
        $recipes = $this->getRecipeViewData();
        $stock = $this->getStockViewData();
        $supplies = $this->getSuppliesViewData();
        $this->data['recipes'] = $recipes;
        $this->data['stock'] = $stock;
        $this->data['supplies'] = $supplies;

        $this->data['pagetitle'] = "Administrative Page";
        $this->data['pagebody'] = 'admin_view';

        $this->render();
    }

    // Get the recipe data for the view.
    public function getRecipeViewData() {
        $recipes = $this->recipesModel->all();
        foreach ($recipes as &$recipe) {
            $can_produce = TRUE;
            foreach ($recipe['ingredients'] as $ingredient) {
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

    public function getSupplyCount($code) {
		$supplyCount = $this->suppliesModel->singleSupply($code)['quantityOnHand'];
		return $supplyCount;
	}

    //Get the stock data for the view.
    public function getStockViewData() {
        $stock = $this->stockModel->all();

        $stockList = array();

        foreach ($stock as $item) {
            $stockList[] = array(
                'code' => $item['code'],
                'description' => $item['description'],
                'sellingPrice' => $item['sellingPrice'],
                'link' => str_replace(' ', '_', $item['code']),
                'quantityOnHand' => $item['quantityOnHand']);
        }
        $this->data['stock'] = $stockList;

        return $stockList;
    }

    // Get the supplies data for the view.
    public function getSuppliesViewData() {
        $supplies = $this->suppliesModel->all();

        $supplyList = array();

        foreach ($supplies as $supply) {
            $supplyList[] = array(
                'id' => $supply['id'],
                'code' => $supply['code'],
                'description' => $supply['description'],
                'receivingCost' => $supply['receivingCost'],
                'stockingUnit' => $supply['stockingUnit'],
                'quantityOnHand' => $supply['quantityOnHand']);
        }

        return $supplyList;
    }

    // Add a recipe to the data model.
    public function addRecipe($recipeCode) {
        //$this->recipesModel->addRecipe($recipe);
        $normalCode = str_replace('_', ' ', $recipeCode);
        $this->phpAlert("Created new recipe: " . $normalCode);
        redirect('/admin', 'refresh');
    }

    // Add a stock item to the stock model.
    public function addStock($stockCode) {
        //$this->stockModel->addStock($stock);
        $normalCode = str_replace('_', ' ', $stockCode);
        $this->phpAlert("Created new stock item: " . $normalCode);
        redirect('/admin', 'refresh');
    }

    // Add a supply item to the supply model.
    public function addSupply($supplyCode) {
        //$this->suppliesModel->addSupply($supply);
        $normalCode = str_replace('_', ' ', $supplyCode);
        $this->phpAlert("Created new supply item: " . $normalCode);
        redirect('/admin', 'refresh');
    }

    // Edit a recipe data model item.
    public function editRecipe($recipeCode) {
        $normalCode = str_replace('_', ' ', $recipeCode);
        $this->phpAlert("Recipe: " . $normalCode . " has been updated.");
        redirect('/admin', 'refresh');
    }

    // Edit a stock data model item.
    public function editStock($stockCode) {
        $normalCode = str_replace('_', ' ', $stockCode);
        $this->phpAlert("Stock item: " . $normalCode . " has been updated.");
        redirect('/admin', 'refresh');
    }

    // Edit a supply data model item.
    public function editSupply($supplyCode) {
        $normalCode = str_replace('_', ' ', $supplyCode);
        $this->phpAlert("Supply item: " . $normalCode . " has been updated.");
        redirect('/admin', 'refresh');
    }

    // Delete Recipe from data model.
    public function deleteRecipe($code) {
        $normalCode = str_replace('_', ' ', $code);
        $this->recipesModel->deleteRecipe($normalCode);
        $this->phpAlert("Deleted recipe: " . $normalCode);
        redirect('/admin', 'refresh');
    }

    // Delete stock item from data model.
    public function deleteStock($code) {
        $normalCode = str_replace('_', ' ', $code);
        $this->stockModel->deleteStock($normalCode);
        $this->phpAlert("Deleted stock item: " . $normalCode);
        redirect('/admin', 'refresh');
    }

    // Delete supply item from data model.
    public function deleteSupply($code) {
        $normalCode = str_replace('_', ' ', $code);
        $this->suppliesModel->deleteSupply($normalCode);
        $this->phpAlert("Deleted supply item: " . $normalCode);
        redirect('/admin', 'refresh');
    }

    public function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }

}
