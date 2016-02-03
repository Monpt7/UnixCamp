<?php

function recup($argv)
{
  $j = 0;
	$file = "/etc/" . "rc" . "$argv[1]" . '.d/';
  if (is_readable($file))
  {
  	$tab_file = scandir($file);
  	while ($tab_file[$i])
  	{
    	if (preg_match("/[K][0-9]{2}[0-9]?(.*)/", $tab_file[$i]) == 0)
      {
        $array[0][$j] = $tab_file[$i];
        $j++;
      }
  		else if (preg_match("/[S][0-9]{2}[0-9]?(.*)/", $tab_file[$i]) == 0)
      {
        $array[1][$j] = $tab_file[$i];
        $j++;
      }
  		$i++;
  	}
  }
	return ($array);
}

recup($argv);
