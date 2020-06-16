<?php
    require APPPATH . 'libraries/REST_Controller.php';
    
    class product extends REST_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->database();
        }
        public function index_get($id = 0)
        {
            if(!empty($id = 0)){
                $data = $this->db->get_where("products", ['product_id' => $id])->result();
            } else {
                $data = $this->db->get("products")->result();
            }
            $this->response($data, REST_Controller::HTTP_OK);
        }

        public function index_post()
        {
            $input = $this->input->post();
            $this->db->insert('products',$input);

            $this->response(['product created successfully.'], REST_Controller::HTTP_OK);
        }

        /**
        * Get ALL Data from this method.
        *
        *@return Response
        */
        public function index_put($id)
        {
            $input = $this->put();
            $this->db->update('products',$input,array('product_id'=>$id));
            $this->response(['product created succesfully.'], REST_Controller::HTTP_OK);
        }


    }