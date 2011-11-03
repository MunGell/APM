    /**
     * $this->load->model('tbl_acl');
     * $data['tbl_acl'] = $this->tbl_acl->readAll();
     * $this->load->view('tbl_acl', $data);
     */
    public function readAll()
    {
        $this->db->select('{fields}');
        $query = $this->db->get('{tablename}');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }  

    public function readOne($id = 0)
    {
        $this->db->select('{fields}')
                 ->where('id', $id);
        $query = $this->db->get('{tablename}');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }