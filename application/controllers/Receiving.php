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
		        if (!($this->session->userdata('userrole') == 'admin' || $this->session->userdata('userrole') == 'user'))
            {
              $this->data['pagetitle'] =  'Receiving Page';
              $this->data['message'] = "Invalid Credentials for Page Access";
              $this->data['pagebody'] = "error_view";
              $this->render();
              return;
            }

            $this->data['pagebody'] = 'receiving/receiving_view';
            $this->data['pagetitle'] = 'Receiving Page';
            $supplies = $this->SuppliesModel->all();

            foreach ($supplies as &$supply) {
                $supply->form = '<form method="post" action="receiving/updateSupply" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value=' . $supply->id . '>
                                    <tr>
                                        <td>
                                            <strong>' . $supply->id . '</strong>
                                        </td>
                                        <td>' . $supply->code . '</td>
                                        <td>' . $supply->description . '</td>
                                        <input type="hidden" name="description" value="' . $supply->description . '">
                                        <td>' . $supply->receivingCost . '</td>
                                        <td>' . $supply->quantityOnHand . '</td>
                                        <td><input type="number" name="quantity"></td>
                                        <td><button class="btn btn-primary">Update</button></td>
                                    </tr>
                                </form>';
            }

            $this->data['supplies'] = $supplies;
            $this->render();
        }

        public function updateSupply() {
            $this->load->helper(['form', 'url']);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id', 'ID', 'required|integer');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('quantity', 'Quantity', 'required|integer');
            if ($this->form_validation->run() == FALSE) {
                redirect('/admin/editSupply/' . $this->input->post('id'), 'refresh');
            } else {
                //success
                $updatedSupply = array("id" => $this->input->post('id'),
                                       "description" => $this->input->post('description'),
                                       "quantityOnHand" => $this->input->post('quantity'));
        		$this->SuppliesModel->update($updatedSupply);
                
                $this->LogUpdateSupply($updatedSupply);
                
                redirect('/receiving', 'refresh');
            }
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

    public function LogUpdateSupply($updatedSupply) {
        $id = rand(100, 999);

        // use this if the file doesn't exist
        while (file_exists('../data/updateSupply' . $id . '.xml')) {
            $id = rand(100, 999);
        }
        // and establish the checkout time
        $dateTime = date(DATE_ATOM);

        // start empty
        $xml = new SimpleXMLElement('<updateSupply/>');

        $xml->addChild('number', $id);
        $xml->addChild('datetime', $dateTime);
        $xml->addChild('supplyID', $updatedSupply[id]);
        $xml->addChild('quantity', $updatedSupply[quantityOnHand]);

        $xml->asXML('../data/updateSupply' . $id . '.xml');
    } 

    }
