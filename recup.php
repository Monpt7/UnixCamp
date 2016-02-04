<?php

function recup($initNbr, $path)
{
  $j = 0;
  $i = 0;
  $k = 0;
	$file = $path . "rc" . $initNbr . '.d/';

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
    return ($array);
  }
}

function recupOld($previous, $path)
{
  $j = 0;
  $i = 0;
  $file = $path . "rc" . $previous . '.d/';

 if (is_readable($file))
  {
    $tab_file = scandir($file);
    while (isset($tab_file[$i]))
    {
      if (preg_match("/[S][0-9]{2}[0-9]?(.*)/", $tab_file[$i], $output) == 1)
      {
        $arrayOld[$j] = $output[0];
        $j++;
      }
      $i++;
    }
    return ($arrayOld);
  }
}
