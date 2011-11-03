<?php

class Template
{
    
    function __construct($argv = array())
    {
        if (empty($argv)) {
            $this->argv = array();
            $this->name = '';
        } else {
            $this->argv = array_slice($argv, 4);
            $this->name = $argv[3];
        }
    }
    
    /**
     * Create file at template
     * @param type $name
     * @param type $type 
     */
    public function create($type = 'controllers', $className = '', $action = '')
    {

        $filenameTemplate = CIPATH . DS . 'templates' . DS . $type .'.php';
        
        // @todo $className and $this->name?
        if ($type == 'helpers') {
            $filename = BASEPATH . DS . 'application' . DS . $type . DS . strtolower($this->name) . '_helper.php';
        } else {
            $filename = BASEPATH . DS . 'application' . DS . $type . DS . strtolower($this->name) . '.php';
        }
        
        if (! empty($className)) {
            $filename = BASEPATH . DS . 'application' . DS . $type . DS . strtolower($className) . '.php';
        }
        // @end
        
        if ( empty($action) ) {
            $action = $this->action( empty($this->argv) ? array('index') : $this->argv );
        }
        if ( empty($className) ) {
            $className = ucfirst(strtolower($this->name));
        }
            
        $data = array(
            'className' => $className,
            'action'    => $action
        );

        if (DEBUG) {
            echo $this->name . ' ' . $filename . "\n";
            echo $this->parse_template($filenameTemplate, $data) . "\n";
        }

        if ($type == 'views' && !empty($this->argv)) {

            foreach($this->argv as $name) {

                $name = BASEPATH . DS . 'application' . DS . $type . DS . strtolower($name) . '.php';
                
                 if (file_exists($name)) {
                    die("File $name now exists!\n");
                } else {
                    $this->file_force_contents(
                        $name,
                        $this->parse_template($filenameTemplate, $data)
                    );
                }

            }
            
        }
        
        if (file_exists($filename) ) {
            die("File $filename now exists!\n");
        } else {
            $this->file_force_contents(
                    $filename,
                    $this->parse_template($filenameTemplate, $data)
            );
        }
        
        return true;
    }
    
    /**
     * Remove files
     * @param type $name
     * @param type $type 
     */
    public function remove($type = 'controllers')
    {
        if ($type == 'helpers') {
            $filename = BASEPATH . DS . 'application' . DS . $type . DS . basename(strtolower($this->name)) . '_helper.php';
        } else {
            $filename = BASEPATH . DS . 'application' . DS . $type . DS . basename(strtolower($this->name)) . '.php';
        }

        if (file_exists($filename))
            unlink($filename);
        else
            die('Not file exists ' . $filename);
        
        if (DEBUG) echo 'Remove ' . $filename;
        
        return true;
    }
    
    /**
     * Generate string action list from argv array
     * @param type $actionName
     * @return type 
     */
    public function action($actionName = 'index')
    {
        $filenameTemplate = CIPATH . DS . 'templates' . DS . 'actions.php';
        $result = '';
        
        foreach($actionName as $key => $value) {
            $data['actionName'] = $value;
            $result .= $this->parse_template($filenameTemplate, $data);
        }
        
        return $result;
    }
 
    /**
     * Template, replace {KEY} => {DATA}
     * @param type $filename
     * @param type $data
     * @return type 
     */
    public function parse_template($filename = '', $data = array())
    {
        // example template variables {a} and {bc}
        // example $data array
        // $data = Array("a" => 'one', "bc" => 'two');
        $q = file_get_contents($filename);
        foreach ($data as $key => $value) {
            $q = str_replace('{' . $key . '}', $value, $q);
        }
        return $q;
    }
    
    
    /**
     * For create view in subfolders. Create all subfolders then put contents at
     * file as last element of dir name.
     * @url http://php.net/manual/en/function.file-put-contents.php
     * @param type $dir
     * @param type $contents 
     */
    private function file_force_contents($dir, $contents)
    {
        $parts = explode(DS, $dir);
        $file = array_pop($parts);
        
        if (DEBUG)
            var_dump($parts);
        
        $dir = '';
        foreach($parts as $part) {
            
            if (DEBUG)
                echo $dir . "\n";
            
            if(! is_dir($dir .= $part . DS))
                mkdir($dir);
        }
        file_put_contents($dir . DS . $file, $contents);
    }
    
    
}