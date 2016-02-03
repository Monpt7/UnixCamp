<?php

require_once('process.php');

function recup($argv)
{
  $j = 0;
  $i = 0;
  $k = 0;
	$file = "/etc/" . "rc" . "$argv[1]" . '.d/';

 if (is_readable($file))
  {
  	$tab_file = scandir($file);
  	while (isset($tab_file[$i]))
  	{
    	if (preg_match("/[K][0-9]{2}[0-9]?(.*)/", $tab_file[$i], $output) == 1)
      {
        $array[0][$j] = $output[0];
        $j++;
      }
  		else if (preg_match("/[S][0-9]{2}[0-9]?(.*)/", $tab_file[$i], $output) == 1)
      {
        $array[1][$k] = $output[0];
        $k++;
      }
  		$i++;
  	}
  }
	return ($array);
}

process(recup($argv), $argv[1]);
