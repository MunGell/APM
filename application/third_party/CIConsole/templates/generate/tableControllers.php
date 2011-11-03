    public function read()
    {
        $this->load->model('{classnameViewModel}');
        $data['{classnameViewModel}'] = $this->{classnameViewModel}->readAll();
        $this->load->view('{classnameViewModel}', $data);
    }