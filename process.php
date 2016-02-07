<?php

function process($tab, $init, $path)
{
	$logger = " 2>&1 | logger -i";
	$i = 0;
	while (isset($tab[0][$i]))
	{
		$commande = $path."rc".$init.".d/".$tab[0][$i]." stop";
		exec($commande.$logger, $tabReturn, $verif);
		preg_match("/^[K|S][\d]{2}(.*)$/", $tab[0][$i], $nomFinal);
		if ($verif == 0)
			echo "Stopping ".$nomFinal[1]."...\t\t\t\t[ \033[32mOK\033[0m ]\n";
		else
			echo "Stopping ".$nomFinal[1]."...\t\t\t\t[\033[31mFAIL\033[0m]\n";
		$i++;
	}
	$i = 0;
	while (isset($tab[1][$i]))
	{
		$commande = $path."rc".$init.".d/".$tab[1][$i]." start";
		exec($commande.$logger, $tabReturn, $verif);
		preg_match("/^[K|S][\d]{2}(.*)$/", $tab[1][$i], $nomFinal);
		if ($verif == 0)
			echo "Starting ".$nomFinal[1]."...\t\t\t\t[ \033[32mOK\033[0m ]\n";
		else
			echo "Starting ".$nomFinal[1]."...\t\t\t\t[\033[31mFAIL\033[0m]\n";
		$i++;
	}
}

function killOld($tab, $init, $path)
{
	$logger = " 2>&1 | logger -i";
	$i = 0;
	while (isset($tab[$i]))
	{
		$commande = $path."rc".$init.".d/".$tab[$i]." stop";
		exec($commande.$logger, $tabReturn, $verif);
		preg_match("/^[K|S][\d]{2}(.*)$/", $tab[$i], $nomFinal);
		if ($verif == 0)
			echo "Stopping ".$nomFinal[1]."...\t\t\t\t[ \033[32mOK\033[0m ]\n";
		else
			echo "Stopping ".$nomFinal[1]."...\t\t\t\t[\033[31mFAIL\033[0m]\n";
		$i++;
	}
}