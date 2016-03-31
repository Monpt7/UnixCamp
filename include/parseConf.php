<?php

if ($confFile = fopen('process.conf', 'r'))
{
	$err = 0;
	while ($line = fgets($confFile))
	{
 		if (preg_match("/^path=\"(.*)\"$/", $line, $output))
    		$path = $output[1];
	  	else if (preg_match("/^default=([\d]+)$/", $line, $output))
    		$default = $output[1];
		else if (preg_match("/^previous=([\d]+)$/", $line, $output))
    		$previous = $output[1];
	}
	fclose($confFile);
	if (isset($previous) && isset($default) && isset($path))
	{
	if (isset($argv[1]))
  		$defInit = $argv[1];
  	else
  		$defInit = $default;
  	}
  	else
  	{
  		echo "Le fichier process.conf semble corrompu... \n";
  		echo "Il va etre recrée. Vous devrez modifier la ligne path pour profiter du programme\n";
  		$path = "/ici/le/chemin/abslolu/de/vos/dossiers/rcX.d/";
  		$default = 0;
  		$defInit = 0;
  		$err = 1;
  	}
	$confFile = fopen('process.conf', 'w');
	ftruncate($confFile, 0);
	$chaine = "path=\"" . $path . "\"\ndefault=".$default."\nprevious=".$defInit."\n";
	fputs($confFile, $chaine);
	fclose($confFile);
	if ($err == 1)
		exit;
}
else
{
	echo "Impossible d'ouvrir le fichier process.conf\n";
	exit;
}
