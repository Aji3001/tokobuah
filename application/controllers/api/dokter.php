<?php
    require APPPATH . 'libraries/REST_Controller.php';
    
    class dokter extends REST_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->database();
        }
        public function index_get($id = 0)
        {
            if(!empty($id = 0)){
                $data = $this->db->get_where("dokter", ['id_dokter' => $id])->result();
            } else {
                $data = $this->db->get("dokter")->result();
            }
            $this->response($data, REST_Controller::HTTP_OK);
        }

        public function index_post()
        {
            $input = $this->input->post();
            $this->db->insert('dokter', $input);

            $this->response(['Data Dokter Berhasil Ditambahkan'], REST_Controller::HTTP_OK);
        }

        /**
         * get All Data from this method
         * 
         * @return Response
         */

         public function index_put($id)
         {
             $input = $this->put();
             $this->db->update('dokter', $input, array('id_dokter' =>$id));

             $this->response(['Data Dokter berhasil diubah'], REST_Controller::HTTP_OK);
         }

         function index_delete() {
            $id = $this->delete('id_dokter');
            $this->db->where('id_dokter', $id);
            $delete = $this->db->delete('dokter');
            if ($delete) {
                $this->response(array('status' => 'Data Dokter Berhasil dihapus'), 201);
            } else {
                $this->response(array('status' => 'Data Dokter Gagal dihapus', 502));
            }
        }
    }
