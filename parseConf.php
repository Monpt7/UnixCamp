<?php

if ($confFile = fopen('process.conf', 'r'))
{
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
	if (isset($argv[1]))
  		$defInit = $argv[1];
  	else
  		$defInit = $default;
	$confFile = fopen('process.conf', 'w');
	ftruncate($confFile, 0);
	$chaine = "path=\"" . $path . "\"\ndefault=".$default."\nprevious=".$defInit."\n";
	fputs($confFile, $chaine);
	fclose($confFile);
}
else
{
	echo "Impossible d'ouvrir le fichier process.conf\n";
	exit;
}