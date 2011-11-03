<?php

/**
 * Description of Deploy
 *
 * @author 
 */
class Deploy
{

    /**
     * 
     */
    function __construct()
    {
        
        set_time_limit(0);

        $config = new Config;
        $this->deploy = $config->json('deploy');
        $this->ignore = $config->json('ignore');

    }

    /**
     *
     * @param type $config 
     */
    public function deploy($config = 'default')
    {

        $conn_id = ftp_connect($this->deploy[$config]['host']);
        $login_result = ftp_login($conn_id, $this->deploy[$config]['login'], $this->deploy[$config]['password']);

        if ((!$conn_id) || (!$login_result))
            die("Not connect to ftp\n");

         $this->ftpPutAll($conn_id, BASEPATH, $this->deploy[$config]['dir']);
         ftp_close($conn_id);
         
    }
    
    /**
     * @link http://php.net/manual/ru/function.ftp-put.php
     * @param type $conn_id
     * @param type $src_dir
     * @param type $dst_dir 
     */
    private function ftpPutAll($conn_id, $src_dir, $dst_dir)
    {

        $d = dir($src_dir);
        while($file = $d->read()) {

            // Не обрабатывать файлы-каталоги в списке игнорируемых
            if ( $file != '.' && $file != '..' &&
                 array_search($file, $this->ignore['ignore']) != true ) {
            
                if (is_dir($src_dir . DS . $file)) {

                    if (! @ftp_chdir($conn_id, $dst_dir . '/' . $file) ) {
                        ftp_mkdir($conn_id, $dst_dir . '/' . $file);
                    }
                    
                    $this->ftpPutAll($conn_id, $src_dir . DS . $file, $dst_dir . "/" . $file);
                    
                } else {
                    
                    ftp_pasv($conn_id, true); // включение пассивного режима
                    $upload = ftp_put($conn_id, $dst_dir . "/" . $file, $src_dir . DS . $file, FTP_BINARY); // put the files
                    //var_dump($upload);
                    if (! $upload)
                        echo "[E] PUT {$dst_dir}/{$file}\n";
                    
                } 
            }
        }
        $d->close();
    }
   
}

