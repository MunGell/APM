    public function index()
    {
        $this->load->model('{classnameViewModel}');
        $data['{classnameViewModel}'] = $this->{classnameViewModel}->readAll();   
        $this->load->view('{classnameViewModel}_read', $data);
    }
    
    /**
     * Example: $data['Services'] = $this->Services->readAll(array('key' => 'id_vehicle', 'value' => $data['Vehicles']->id), 'number, m_status, t_status');
     * SELECT (number, m_status, t_status)
     * WHERE id_vehicle = VALUE
     */
    public function read($id = 0)
    {
        $this->load->model('{classnameViewModel}');
        $data['{classnameViewModel}'] = $this->{classnameViewModel}->readOne($id);   
        $this->load->view('{classnameViewModel}_read', $data);
    }
    
    /**
     * For correct form_validation you need create rules for them at
     * /config/form_validation.php
     */
    public function update($id = 0)
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        
        $this->load->model('{classnameViewModel}');

        if ($this->form_validation->run() == FALSE)
        {     
            $data['{classnameViewModel}'] = $this->{classnameViewModel}->readOne($id);
            $this->load->view('{classnameViewModel}_edit', $data);
        }
        else
        {
            $id = $this->{classnameViewModel}->updateOne();
            redirect("***/update/$id");
        }     
    }
    
    /**
     * For correct form_validation you need create rules for them at
     * /config/form_validation.php
     */
    public function insert()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        if ($this->form_validation->run() == FALSE)
        {     
            $this->load->view('{classnameViewModel}_edit');            
        }
        else
        {
            $this->load->model('{classnameViewModel}');
            $id = $this->{classnameViewModel}->insert();
            
            redirect("***/read/$id");
        }     
    }

    public function delete($id = 0)
    {
        $this->load->model('{classnameViewModel}');
        $data['{classnameViewModel}'] = $this->{classnameViewModel}->deleteOne($id);    
    }