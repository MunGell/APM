<?php

/**
 * Description of Deploy
 *
 * @author 
 */
class Generate
{
    
    var $fields = array();
    var $argv = array();
    
    function __construct($argv = array())
    {
        $this->argv = $argv;
    }
    
    private function dbGetFields()
    {
        if (! empty($this->argv[3])) {
            $this->tablename = $this->argv[3];
            $this->classnameViewModel = $this->argv[3];
        } else {
            die("Please enter table name\n");
        }
        
        if (! empty($this->argv[4])) {
            $this->classnameViewModel = $this->argv[4];
        }
        
        if (! empty($this->argv[5]) ) {
            if ($this->argv[5] != $this->argv[4])
                $this->classnameController = $this->argv[5];
            else
                die("The name of the controller and the model must be different\n");
        }
        
        include BASEPATH . DS . 'application' . DS . 'config' . DS . 'database.php';

        $dbdriver = $db['default']['dbdriver'];
        $hostname = $db['default']['hostname'];
        $database = $db['default']['database'];
        $username = $db['default']['username'];
        $password = $db['default']['password'];

        unset($db);

        try {
            $dbh = new PDO("$dbdriver:host=$hostname;dbname=$database;charset=UTF-8", $username, $password);
            
            // SHOW FULL COLUMNS FROM database.tablename - show Comment field
            // mysql> use information_schema;  
            // mysql> show tables;  
            // mysq> select column_name, column_comment from columns where table_name='your-table';  
            $sql = "SHOW FULL COLUMNS FROM `{$this->tablename}` FROM `{$database}`;";
            $result = $dbh->query($sql)->fetchAll();

            foreach($result as $row) {
                $this->fields[$row['Field']] = $row['Comment'];
            }

            $dbh = null;
        } catch (PDOException $e) {
            die("Error!: " . $e->getMessage() . "\n");
        }
    }

    public function table()
    {

        $path = CIPATH . DS . 'templates' . DS . 'generate' . DS;
        $this->dbGetFields();
        $fieldsList = implode(', ', array_keys($this->fields));
        $template = new Template();
 
        $views = '';
        foreach($this->fields as $key => $value) {
            $views .= <<<PHP
            <tr>
                <th>{$value}</th>
                <td><?php echo \$row->{$key}; ?></td>
            </tr>
PHP;
        }

        $data = array(
            'classnameViewModel' => $this->classnameViewModel,
            'views'              => $views
        );
        $views = $template->parse_template($path . 'tableViews.php', $data);
        
        $data = array(
            'fields'    => $fieldsList,
            'tablename' => $this->tablename
        ); 
        $models = $template->parse_template($path . 'tableModels.php', $data);
        
        $data = array(
            'classnameViewModel' => $this->classnameViewModel
        );
        $controllers = $template->parse_template($path . 'tableControllers.php', $data);

        $template->create('models', $this->classnameViewModel, $models);
        $template->create('views', $this->classnameViewModel, $views);
        
        if (isset($this->classnameController))
            $template->create('controllers', $this->classnameController, $controllers);

    }
    
    public function form()
    {

        $path = CIPATH . DS . 'templates' . DS . 'generate' . DS;
        $this->dbGetFields();
        $fieldsList = implode(', ', array_keys($this->fields));
        $template = new Template();
 
        $viewsEdit = '';
        foreach($this->fields as $key => $value) {
            $viewsEdit .= <<<PHP
            <tr>
                <th>{$value}</th>
                <td>
                    <?php echo form_error('{$key}'); ?>
                    <?php echo form_input('{$key}', set_value('{$key}', isset(\${$this->classnameViewModel}->{$key})? \${$this->classnameViewModel}->{$key}: '')); ?>
                </td>
             </tr>      
PHP;
        }

        $data = array(
            'classnameViewModel'  => $this->classnameViewModel,
            'views'               => $viewsEdit,
            'classnameController' => isset($this->classnameController)? strtolower($this->classnameController): ''
        );
        $viewsEdit = $template->parse_template($path . 'formViews.php', $data);
        
        $viewsRead = '';
        foreach($this->fields as $key => $value) {
            $viewsRead .= <<<PHP
            <tr>
                <th>{$value}</th>
                <td><?php echo \$row->{$key}; ?></td>
            </tr>
PHP;
        }

        $data = array(
            'classnameViewModel' => $this->classnameViewModel,
            'views'              => $viewsRead
        );
        $viewsRead = $template->parse_template($path . 'tableViews.php', $data);
        
        $updateOne = "\$data = array(\n";
        foreach($this->fields as $key => $value) {
            // Cmp two utf-8 string
            if( strcmp( end($this->fields), $value) == 0 ) { 
                $updateOne .= "\t\t'{$key}' => \$this->input->post('{$key}')\n"; 
            } else {
                $updateOne .= "\t\t'{$key}' => \$this->input->post('{$key}'),\n";
            }
        }
        $updateOne .= "\t);\n";
        
        $data = array(
            'fields'    => $fieldsList,
            'tablename' => $this->tablename,
            'updateOne' => $updateOne
        ); 
        $models = $template->parse_template($path . 'formModels.php', $data);
        
        $data = array(
            'classnameViewModel' => $this->classnameViewModel
        );
        $controllers = $template->parse_template($path . 'formControllers.php', $data);

        $template->create('models', $this->classnameViewModel, $models);
        $template->create('views', $this->classnameViewModel . '_edit', $viewsEdit);
        $template->create('views', $this->classnameViewModel . '_read', $viewsRead);
        
        if (isset($this->classnameController))
            $template->create('controllers', $this->classnameController, $controllers);

    }
      
}

