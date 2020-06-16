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

         public function index_put()
         {
            $id = $this->put('id_dokter');
            $data = array(
                        'id_dokter'       => $this->put('id_dokter'),
                        'nama'          => $this->put('nama'),
                        'spesialis'    => $this->put('spesialis'),
                        'alamat'          => $this->put('alamat'));
            $this->db->where('id_dokter', $id);
            $update = $this->db->update('dokter', $data);
            if ($update) {
                $this->response(array('status' => 'Data dokter berhasil diubah'), 201);
            } else {
                $this->response(array('status' => 'Data dokter gagal diubah', 502));
            }
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
