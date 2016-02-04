<?php

function process($tab, $init, $path)
{
	$i = 0;
	while (isset($tab[0][$i]))
	{
		exec("bash ".$path."rc".$init.".d/".$tab[0][$i]." stop");
		$verif = shell_exec("echo $?");
		$verif = intval($verif);
		if ($verif == 0)
			echo "Stopping " . $tab[0][$i] . "...\t\t\t[ \033[32mOK\033[0m ]\n";
		else
			echo "Stopping " . $tab[0][$i] . "...\t\t\t[ \033[31mFAIL\033[0m ]\n";
		$i++;
	}
	$i = 0;
	while (isset($tab[1][$i]))
	{
		exec("bash ".$path."rc".$init.".d/".$tab[1][$i]." start");
		$verif = shell_exec("echo $?");
		$verif = intval($verif);
		if ($verif == 0)
			echo "Starting " . $tab[1][$i] . "...\t\t\t[ \033[32mOK\033[0m ]\n";
		else
			echo "Starting " . $tab[1][$i] . "...\t\t\t[ \033[31mFAIL\033[0m ]\n";
		$i++;
	}
}

function killOld($tab, $init, $path)
{
	$i = 0;
	while (isset($tab[$i]))
	{
		exec("bash ".$path."rc".$init.".d/".$tab[$i]." stop");
		$verif = shell_exec("echo $?");
		$verif = intval($verif);
		if ($verif == 0)
			echo "Stopping " . $tab[$i] . "...\t\t\t[ \033[32mOK\033[0m ]\n";
		else
			echo "Stopping " . $tab[$i] . "...\t\t\t[ \033[31mFAIL\033[0m ]\n";
		$i++;
	}
}