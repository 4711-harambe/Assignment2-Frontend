<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Application {

    public function __construct() {
        parent::__construct();
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
        $recipes = $this->RecipesModel->all();
        foreach ($recipes as &$recipe) {
			$recipe->ingredients = '';
			$ingredients = $this->db->query("SELECT * FROM Ingredients WHERE ingredientsCode = ?", array($recipe->ingredientsCode));
			foreach ($ingredients->result() as $row) {
				$recipe->ingredients .= '<li>' . $row->ingredient . '</li>';
			}
            $recipe->deleteButton = '<a class="btn btn-danger" type="button" href="admin/deleteRecipe/' . $recipe->id . '">Delete</a>';
        }


        $stock = $this->StockModel->all();
        foreach ($stock as &$stockItem) {
            $stockItem->deleteButton = '<a class="btn btn-danger" type="button" href="admin/deleteStock/' . $stockItem->id . '">Delete</a>';
            $stockItem->editButton = '<a class="btn btn-primary" type="button" href="admin/editStock/' . $stockItem->id . '">Edit</a>';
        }
        $supplies = $this->SuppliesModel->all();
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
    public function editStock($stockID) {
        $this->load->helper(['html', 'form']);
        $stock = $this->StockModel->get($stockID);
        $this->data['code'] = $stock->code;
        $this->data['form'] = '<form method="post" action="/admin/updateStock">
                                    <input type="hidden" name="id" value=' . $stock->id . '>
                                    <tr>
                                        <th>Description</th>
                                        <td><input class="form-control" type="text" name="description" value="' . $stock->description . '" /></td>
                                    </tr>
                                    <tr>
                                        <th>Price</th>
                                        <td><input class="form-control" type="text" name="price" value=' . $stock->sellingPrice . ' /></td>
                                    </tr>
                                    <tr>
                                        <th>Quantity In Stock</th>
                                        <td><input class="form-control" type="text" name="quantity" value=' . $stock->quantityOnHand . ' /></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><button class="btn btn-primary">Update</button><a class="btn btn-danger" type="button" href="/admin">Go Back</input></td>
                                        <td>
                                    </tr>
                                </form>';


        $this->data['pagebody'] = 'edit_stock_view';

        $this->render();
    }

    public function updateStock() {
        $this->load->helper(['form', 'url']);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'ID', 'required|integer');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|decimal');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            // do shit
            $this->phpAlert("The form was incorrectly filled out. Please try again.");
            redirect('/admin/editStock/' . $this->input->post('id'), 'refresh');
        } else {
            //success
            $updatedStock = array("id" => $this->input->post('id'),
                                  "description" => $this->input->post('description'),
                                  "quantityOnHand" => $this->input->post('quantity'),
                                  "sellingPrice" => $this->input->post('price'));
    		$this->StockModel->update($updatedStock);
            $this->phpAlert("Success");
            redirect('/admin', 'refresh');
        }
    }

    // Edit a supply data model item.
    public function editSupply($supplyCode) {
        $normalCode = str_replace('_', ' ', $supplyCode);
        $this->phpAlert("Supply item: " . $normalCode . " has been updated.");
        redirect('/admin', 'refresh');
    }

    // Delete Recipe from data model.
    public function deleteRecipe($recipeID) {
        $this->RecipesModel->delete($recipeID);
        redirect('/admin', 'refresh');
    }

    // Delete stock item from data model.
    public function deleteStock($stockID) {
        $this->StockModel->delete($stockID);
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
