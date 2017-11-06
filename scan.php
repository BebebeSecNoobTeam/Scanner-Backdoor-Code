#!/usr/bin/php

<?php

$bad = array(
        "system\((.*?)\)",
        "passthru\((.*?)\)",
        "popen\((.*?)\)",
        "gzdeflate\((.*?)\)",
        "gzinflate\((.*?)\)",
        "eval\((.*?)\)",
        "base64_decode\((.*?)\)",
        "exec\((.*?)\)",
        "shell_exec\((.*?)\)",
        "mail\((.*?)\)",
        "str_replace\((.*?)\)",
        "file_get_contents\((.*?)\)",
);

$time_start = microtime(true);
$time_end = microtime(true);
$time = $time_end - $time_start;

error_reporting(0);
class traveloka{

  function __construct($option){
      switch($option){
          default:
             $this->banner();
             $this->start();
             $this->footer();
          break;
      }
       
  }

  function banner() {
    echo "\033[34m";?>

               
                   (   (   (   
                 ( )\( )\( )\  
                 )((_)((_)((_) 
                ((_)((_)((_)_  
                 | _ ) _ ) _ ) 
                 | _ \ _ \ _ \ 
                 |___/___/___/ n00bTeam
                        
     ========================================                          
             Backdoor Code Scanner V1.0
                 Researcher BBB Team
     ======================================== 

    <?php
    echo "\033[0m\n";
  }

  function start(){
    $di = new RecursiveDirectoryIterator(__DIR__,RecursiveDirectoryIterator::SKIP_DOTS);
    $it = new RecursiveIteratorIterator($di);
      foreach($it as $file) {
          if (pathinfo($file, PATHINFO_EXTENSION) == "php") {
              $this->scan($file);
          }
      }
      
  }

  function scan($path) {
      global $bad;
      global $argv;
      $baru = array();
      foreach($bad as $b) {
          $file = file_get_contents($path);
          if($path != __FILE__) {
              if(preg_match("#$b#", $file)) {
                  $new = $this->clean($b);
                  echo "[\033[32m".$new."\033[0m] $path\n";
                  array_push($baru, $new.",".$path);
              }
          }
      }
      $filename = "reportscan-".date('d-m-Y').".csv";
      $file = fopen($filename,"a");
      foreach($baru as $new) {
        fputcsv($file, explode(",", $new));

      }
      fclose($file);
  }

  function footer(){
    global $time;
    $hitung = explode("\n", file_get_contents("reportscan-".date('d-m-Y').".csv"));
    echo "=======================================================================\n";
    echo 'Execution time : '.$time.' seconds'."\n";
    echo "Total files : ".count($hitung)."\n";
    echo "=======================================================================\n";
  }

  function clean($path) {
      return str_replace(array("\\","(.*?)"), "", $path);
  }

}
 
$tes = new traveloka($argv[1]);

?>
