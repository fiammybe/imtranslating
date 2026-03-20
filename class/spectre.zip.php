<?php
// USES THE PHPMYADMIN ZIP LIBRARY


define("SZIP_DUMP",'dump');
define("SZIP_FILE",'file');
define("SZIP_SAVE",'save');

class spectreZip {
 public $zip;
 public $options;

 public function __construct($warn = true, $safe = true) {
  $this->zip = new zipfile;
  $this->options['warn'] = $warn;
  $this->options['safe'] = $safe;
 }

 function addFile($file) {
  if (file_exists($file)) {
   $this->zip->addFile(implode('',file($file)),$file);
  }
  else {
   $this->__error(SZIP_FILE,'File <u>'.$file.'</u> does not exist!');
  }
 }

 function addDir($dira,$path = -1) {
  if (file_exists($dira)) {
   if ($path == -1) {
    $path = $dira;
   }
   $dir = opendir($dira);
   while ($file = readdir($dir)) {
    if (is_file($dira.$file)) {
     $this->zip->addFile(implode('',file($dira.$file)),$path.$file);
    }
   }
  }
  else {
   $this->__error(SZIP_FILE,'Directory <u>'.$dira.'</u> does not exist!');
  }
 }

 function render($file,$type = 'dump') {
  if ($type == 'dump') {
   header('Content-type: application/zip');
   header('Content-Disposition: attachment; filename="'.$file.'"');
   echo $this->zip->file();
  }
  elseif ($type == 'save') {
   @unlink($file);
   $f = fopen($file,'a+');
   fwrite($f,$this->zip->file());
   fclose($f);
  }
  else {
   $this->__error('creation','Unknown method: <u>'.$type.'</u>. Use constants <b>SZIP_DUMP</b> or <b>SZIP_SAVE</b>.');
  }
 }


 function __error($type,$message) {
  if ($this->options['warn']) {
   echo '<b>spectreZip '.$type.' error:</b> '.$message.'<br>'."\n";
  }
  if ($this->options['safe']) {
   die();
  }
 }
}
?>