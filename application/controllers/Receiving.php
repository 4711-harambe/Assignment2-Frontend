<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Receiving extends Application
    {

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
        public function index()
        {

            $this->data['pagebody'] = 'receiving/receiving_view';
            $this->data['pagetitle'] = 'Receiving Page';
            $supplies = $this->suppliesModel->all();

            $supplyList = array();

            foreach ($supplies as $supply)
            {
                $supplyList[] = array (
                    'id' => $supply['id'],
                    'code' => $supply['code'],
                    'description' => $supply['description'],
                    'receivingCost' => $supply['receivingCost'],
                    'stockingUnit' => $supply['stockingUnit'],
                    'quantityOnHand' => $supply['quantityOnHand']);
            }
            $this->data['supplies'] = $supplyList;
            $this->render();
        }

        public function showDetails($id)
        {
            $supplies= $this->suppliesModel->details($id);
            $this->data['pagebody'] = 'receiving/details_view';
            $this->data['pagetitle'] = $supplies['code'];

            $this->data['id'] = $supplies['id'];
            $this->data['code'] = $supplies['code'];
            $this->data['description'] = $supplies['description'];
            $this->data['receivingCost'] = $supplies['receivingCost'];
            $this->data['stockingUnit'] = $supplies['stockingUnit'];
            $this->data['quantityOnHand'] = $supplies['quantityOnHand'];

            $this->render();
        }
    }
