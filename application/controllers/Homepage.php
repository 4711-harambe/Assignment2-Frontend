<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends Application {

    public function __construct() {
        parent::__construct();
        $this->load->model('LogModel');
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        $this->data['pagebody'] = 'homepage_view';
        $this->data['pagetitle'] = 'Homepage';
        
        $this->summarize();

        $this->render();
    }

public function summarize() {
        $this->load->helper('directory');
        $candidates = directory_map('../data/');
        
        $mapOfRecipeCounts = array();
        $mapOfRecipesSold = array();
        
        foreach ($candidates as $filename) {
            if (substr($filename, 0, 6) == 'recipe') {
                $xml = simplexml_load_file('../data/' . $filename);
                $recipeName = (string) $xml->recipeName;
                
                if (!array_key_exists($recipeName, $mapOfRecipeCounts)) {
                    $mapOfRecipeCounts[$recipeName] = 1;
                } else {
                    $mapOfRecipeCounts[$recipeName] += 1;
                }
            }
        }
        
        foreach ($candidates as $filename) {
            if (substr($filename, 0, 5) == 'stock') {
                $xml = simplexml_load_file('../data/' . $filename);
                $itemName = (string) $xml->itemName;
                $sellingPrice = (string) $xml->sellingPrice;
                
                if (!array_key_exists($itemName, $mapOfRecipesSold)) {
                    $mapOfRecipesSold[$itemName] = $sellingPrice;
                } else {
                    $mapOfRecipesSold[$itemName] += $sellingPrice;
                }
            }
        }
        
        $this->data['mapOfRecipeCounts'] = $mapOfRecipeCounts;
        $this->data['mapOfRecipesSold'] = $mapOfRecipesSold;
}

}
