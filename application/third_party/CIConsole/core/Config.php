<?php

class Config
{

    public function json($filename = '')
    {
        $pos = stripos($filename, 'http://');

        if ($pos === false) {
            
            $filename = CIPATH . DS . 'config' . DS . $filename . '.json';
            
            if (! file_exists($filename))
                die("Not file exists $filename\n");
            
        }

        $result = file_get_contents($filename);
        if ($result == false)
            die("Uncorrect read $filename\n");
        
        return json_decode($result, true);

    }
    
}

