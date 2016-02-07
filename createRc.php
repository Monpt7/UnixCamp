<?php

$init = my_readline("Quel init modifier ?\n > ");
$dossier = my_readline("Dans quel dossier (chemin absolu avec slash a la fin\n > ");
$verif = preg_match("/[\d]*/", $init, $output);
if ($verif)
{
	$service = "a";
	$i = 0;
	$dossierFinal = $dossier."rc".$init.".d/";
	exec("mkdir ".$dossierFinal);
	echo "Entrer les services que vous souhaitez stopper dans cet init\n";
	echo "Par ordre de priorite\n";
	echo "Tapez q pour l'etape suivante\n";
	$i = 0;
	while (strcmp($service, "q") != 0)
	{
		if ($i < 10)
			$nbr = "0".$i;
		else
			$nbr = $i;
		$service = my_readline(" > ");
		if (file_exists("/etc/init.d/".$service) != 0)
		{
			if (symlink("/etc/init.d/".$service, $dossierFinal."K".$nbr.$service))
			{
				echo "OK\n"; 
				$i++;
			}
		}
		else if (strcmp($service, "q") != 0)
			echo "Erreur\n";
	}
	$service = "a";
	$i = 0;
	echo "Entrer les services que vous souhaitez start dans cet init\n";
	echo "Par ordre de priorite\n";
	echo "Tapez q pour l'etape suivante\n";
	while (strcmp($service, "q") != 0)
	{
		if ($i < 10)
			$nbr = "0".$i;
		else
			$nbr = $i;
		$service = my_readline(" > ");
		if (file_exists("/etc/init.d/".$service))
		{
			if (symlink("/etc/init.d/".$service, $dossierFinal."S".$nbr.$service))
			{
				echo "OK\n"; 
				$i++;
			}
		}
		else if (strcmp($service, "q") != 0)
			echo "Erreur\n";
	}
}
else
{
	echo "Veuillez rentrer un nombre\n";
}

function my_readline($prompt = null){
    if($prompt){
        echo $prompt;
    }
    $fp = fopen("php://stdin","r");
    $line = rtrim(fgets($fp, 1024));
    return $line;
    fclose($fp);
}