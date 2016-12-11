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
        foreach ($supplies as &$supply) {
            $supply->deleteButton = '<a class="btn btn-danger" type="button" href="admin/deleteSupply/' . $supply->id . '">Delete</a>';
            $supply->editButton = '<a class="btn btn-primary" type="button" href="admin/editSupply/' . $supply->id . '">Edit</a>';
        }

        $this->data['recipes'] = $recipes;
        $this->data['stock'] = $stock;
        $this->data['supplies'] = $supplies;

        $this->data['pagetitle'] = "Administrative Page";
        $this->data['pagebody'] = 'admin_view';

        $this->render();
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

    public function editSupply($supplyID) {
        $this->load->helper(['html', 'form']);
        $supply = $this->SuppliesModel->get($supplyID);
        $this->data['code'] = $supply->code;
        $this->data['form'] = '<form method="post" action="/admin/updateSupply" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value=' . $supply->id . '>
                                    <tr>
                                        <th>Description</th>
                                        <td><input class="form-control" type="text" name="description" value="' . $supply->description . '" /></td>
                                    </tr>
                                    <tr>
                                        <th>Price</th>
                                        <td><input class="form-control" type="text" name="price" value=' . $supply->receivingCost . ' /></td>
                                    </tr>
                                    <tr>
                                        <th>Receiving Unit</th>
                                        <td><input class="form-control" type="text" name="receiving" value=' . $supply->receivingUnit . ' /></td>
                                    </tr>
                                    <tr>
                                        <th>Stocking Unit</th>
                                        <td><input class="form-control" type="text" name="stocking" value=' . $supply->stockingUnit . ' /></td>
                                    </tr>
                                    <tr>
                                        <th>Quantity In Stock</th>
                                        <td><input class="form-control" type="text" name="quantity" value=' . $supply->quantityOnHand . ' /></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><button class="btn btn-primary">Update</button><a class="btn btn-danger" type="button" href="/admin">Go Back</input></td>
                                        <td>
                                    </tr>
                                </form>';

        $this->data['pagebody'] = 'edit_supplies_view';

        $this->render();
    }

    public function updateSupply() {
        $this->load->helper(['form', 'url']);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'ID', 'required|integer');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|decimal');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->phpAlert("The form was incorrectly filled out. Please try again.");
            redirect('/admin/editSupply/' . $this->input->post('id'), 'refresh');
        } else {
            //success
            $updatedSupply = array("id" => $this->input->post('id'),
                                  "description" => $this->input->post('description'),
                                  "receivingCost" => $this->input->post('price'),
                                  "receivingUnit" => $this->input->post('receiving'),
                                  "stockingUnit" => $this->input->post('stocking'),
                                  "quantityOnHand" => $this->input->post('quantity'));
    		$this->SuppliesModel->update($updatedSupply);
            redirect('/admin', 'refresh');
        }
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
    public function deleteSupply($supplyID) {
        $this->SuppliesModel->delete($supplyID);
        redirect('/admin', 'refresh');
    }

    public function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }

}
