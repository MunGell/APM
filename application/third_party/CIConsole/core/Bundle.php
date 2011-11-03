<?php

class Bundle
{

    function __construct() {
        $this->bundles = null;
    }
    
    /**
     * Download file to temp folder
     * @param type $url
     * @return string 
     */
    private function downloadRemoteFile($url = '')
    {
        if (empty($url))
            return false; // Not need download archive
        
        //$filename = BASEPATH . DS . basename($url);
        $filename = sys_get_temp_dir() . DS . basename($url);
        
        try {
            file_put_contents($filename, file_get_contents($url));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        
        return $filename;
    }
    
    /**
     * Eval run php code string on remote system
     * @param type $param 
     */
    private function runRemoteScript($url = '')
    {
        if (! empty($url)) {
            eval('?>' . file_get_contents($url)); 
            
            if (DEBUG)
                var_dump(file_get_contents($url));
        }
        
        return true;
    }

    /**
     * Extract archive in temp folder to destination. Save sort all files & dir
     * in archive
     * @param type $filenameArchive
     * @param type $name
     * @return type
     */
    private function extractArchive($filenameArchive = '', $name = '')
    {
        $zip = new ZipArchive;
        if ($zip->open($filenameArchive) === true) {

            /*
             * Save file list for log. In top save files and at bottom directory.
             * This need for along remove all files at command remove bundle.
             */
			if (file_exists(BASEPATH . DS . 'application' . DS . 'logs' . DS)) {
			
				$folders = array(); // List of directopy to append bottom file

				if (!($fileHandle = fopen(BASEPATH . DS . 'application' . DS . 'logs' . DS . "$name.log", 'w'))) {
					die('Cannot open log file');
				}

				// Add all files
				for ($i = 0; $i < $zip->numFiles; $i++) {

					// This need for Windows system
					$filename = str_replace('\\', DS . DS, BASEPATH . '/' . $zip->getNameIndex($i));
					$filename = str_replace('/', DS . DS, $filename);
					
					if (is_dir($filename)) {
						$folders[] = $filename;
						if (DEBUG) echo "[D] $filename\n";         
					} else {
						fwrite($fileHandle, $filename . "\n");
						if (DEBUG) echo "[F] $filename\n";  
					}
				}

				// Add all folders.                      
				// $folders = array_reverse($folders); // Need for success recursiv delete folders
				foreach ($folders as $folder) {
					fwrite($fileHandle, $folder . "\n");
				}

				fclose($fileHandle);
			}
			
            $zip->extractTo(BASEPATH);
            $zip->close();
        } else {
            echo "Not file $name found";
            return false;
        }
        return true;
    }

    /**
     * Download bundles and extract archives
     * @param string $name bundle code name
     */
    public function install($name = '')
    {
        if (empty($name))
            die("Empty bundle name\n");
        
        if (! $this->bundleExists($name))
            die("This bundle not find\n");
               
        /*
         * Run download bundle file
         */
        $filename = $this->downloadRemoteFile($this->bundles[$name]['url']); 
        if ($filename != false)
            $this->extractArchive($filename, $name);
        
        /*
         * Run install script
         */
        $this->runRemoteScript($this->bundles[$name]['install']); 
    
        return true;
    }

    /**
     * Remove bundles delete all files at path
     * @param type $name 
     */
    public function uninstall($name = '')
    {
        
        if (empty($name))
            die("Empty bundle name\n");
        
        if (! $this->bundleExists($name))
            die("This bundle not find\n");
        
        // Delete all files at bundle
        $uninstallFilelist = BASEPATH . DS . 'application' . DS . 'logs' . DS . $name . '.log';
        if (file_exists($uninstallFilelist)) {
            
            $filelist = explode("\n", file_get_contents($uninstallFilelist));
            
            // Sort directory for first delete subfolders then root if not empty
            usort($filelist, function($a, $b) {
                return strlen($b)-strlen($a);
            });
            
            foreach($filelist as $filename) {
                if (is_dir($filename)) {
                    rmdir($filename);
                    
                    if (DEBUG)
                        echo "[D] $filename\n";
                    
                } else {
                    if (file_exists($filename)) {
                        unlink($filename);
                        
                        if (DEBUG)
                            echo "[F] $filename\n";
                        
                    }
                }
            }
            
            unlink($uninstallFilelist);
 
        } else {
            if (! empty($this->bundles[$name]['url']))
                die("Not uninstall files list at $uninstallFilelist\n");
        }
 
        /*
         * Run remove script
         */
        $this->runRemoteScript($this->bundles[$name]['uninstall']);
      
        return true;
    }
    
    /**
     * Directory is empty?
     * @param type $dir
     * @return type 
     */
    private function isEmptyDir($dir)
    {
        return (($files = @scandir($dir)) && count($files) <= 2);
    }
    
    /**
     * View list of bundle name in config/bundles.json
     */
    public function _list()
    {
        if ($this->bundleList()) {
            $bundles = array_keys($this->bundles);
            foreach($bundles as $bundle) {
               echo "$bundle\n";
            }  
        } else
            die("Bundle list empty\n");
    }
    
    /**
     * View remote readme file
     * @param type $name 
     */
    public function readme($name = '')
    {

        if (empty($name))
            die("Empty bundle name\n");
       
        if (! $this->bundleExists($name))
            die("This bundle not find\n");

        echo file_get_contents($this->bundles[$name]['readme']);
        
    }
    
    /**
     *
     * @param type $name 
     */
    private function bundleExists($name = '')
    {
        $config = CIPATH . DS . 'config' . DS . 'bundles.json';
        
        // First search local bundles list and use it
        if (file_exists($config)) {        
            $this->bundles = json_decode(file_get_contents($config), true);                   
        }
        
        if ( is_null($this->bundles[$name]) ) {
        
            // Next search local bundles list and use it
            $this->bundles = json_decode(file_get_contents('http://bundle.org.ua/bundles.json'), true);

            if (is_null($this->bundles[$name])) {
                return false;
            }

        } 
        
        if (DEBUG)
            var_dump($this->bundles);
        
        return true;
    }
    
    /**
     *
     * @param type $name 
     */
    private function bundleList($name = '')
    {

        $config = new Config;
        $this->bundles = $config->json('bundles');

        if ( is_null($this->bundles) ) {
        
            // Next search local bundles list and use it
            $this->bundles = $config->json('http://bundle.org.ua/bundles.json');

            if (is_null($this->bundles)) {
                return false;
            }

        } 

        return true;
    }
    
}
