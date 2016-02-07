<?php

function process($tab, $init, $path)
{
	$logger = " 2>&1";//  >> logger -i 2>&1";
	$i = 0;
	while (isset($tab[0][$i]))
	{
		$commande = $path."rc".$init.".d/".$tab[0][$i]." stop";
		exec($commande.$logger, $tabReturn, $verif);
		preg_match("/^[K|S][\d]{2}(.*)$/", $tab[0][$i], $nomFinal);
		logReturn($tabReturn, $nomFinal[1]);
		affichageStop($verif, $nomFinal[1]);
		$i++;
	}
	$i = 0;
	while (isset($tab[1][$i]))
	{
		$commande = $path."rc".$init.".d/".$tab[1][$i]." start";
		exec($commande.$logger, $tabReturn, $verif);
		preg_match("/^[K|S][\d]{2}(.*)$/", $tab[1][$i], $nomFinal);
		logReturn($tabReturn, $nomFinal[1]);
		if ($verif == 0)
			echo "Starting ".$nomFinal[1]."...\t\t\t\t[ \033[32mOK\033[0m ]\n";
		else
			echo "Starting ".$nomFinal[1]."...\t\t\t\t[\033[31mFAIL\033[0m]\n";
		$i++;
	}
}

function killOld($tab, $init, $path)
{
	$logger = " 2>&1";// >> logger -i 2>&1";
	$i = 0;
	while (isset($tab[$i]))
	{
		$commande = $path."rc".$init.".d/".$tab[$i]." stop";
		exec($commande.$logger, $tabReturn, $verif);
		preg_match("/^[K|S][\d]{2}(.*)$/", $tab[$i], $nomFinal);
		logReturn($tabReturn, $nomFinal[1]);
		affichageStop($verif, $nomFinal[1]);
		$i++;
	}
}

function affichageStop($verif, $nom)
{
	if ($verif == 0)
		echo "Stopping ".$nom."...\t\t\t\t[ \033[32mOK\033[0m ]\n";
	else
		echo "Stopping ".$nom."...\t\t\t\t[\033[31mFAIL\033[0m]\n";
}

function logReturn($tabReturn, $nom)
{
	$strFinal = implode("\n", $tabReturn);
	exec("echo \"$nom : $strFinal\" | logger");
}