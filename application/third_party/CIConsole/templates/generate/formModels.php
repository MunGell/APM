    /**
     * $this->load->model('Services');
     * $data['Services'] = $this->Services->readAll();
     * $this->load->view('Services', $data);
     * ...
     * $data['Services'] = $this->Services->readAll(array('key' => 'id_vehicle', 'value' => $data['Vehicles']->id), 'number, m_status, t_status');    
     */
    public function readAll($where = array(), $fields = '')
    {
        if (empty($fields)) {
            $this->db->select('{fields}');
        } else {
            $this->db->select($fields);
        }

        if (! empty($where)) {
            $this->db->where($where['key'], $where['value']);
        }

        $query = $this->db->get('{tablename}');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }  

    public function readOne($id = 0, $fields = '')
    {
        if (empty($fields)) {
            $this->db->select('{fields}');
        } else {
            $this->db->select($fields);
        }
        
        $this->db->where('id', $id);
        $query = $this->db->get('{tablename}');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function insert()
    {
        {updateOne}

        //$this->db->set('date', 'NOW()', false);
        if ($this->db->insert('{tablename}', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    
    /**
     * Use $id if you need them
     */
    public function updateOne($id = 0)
    {
        //$id = $this->input->post('id');

        {updateOne}

        //$this->db->set('date', 'NOW()', false);
        $this->db->where('id', $id);
        if ($this->db->update('{tablename}', $data)) {
            return $id;
        } else {
            return false;
        }
    }

    public function deleteOne($id = 0)
    {
        $this->db->where('id', $id);
        if ($this->db->delete('{tablename}')) {
            return true;
        } else {
            return false;
        }
    }
