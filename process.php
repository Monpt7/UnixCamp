<?php

function process($tab, $init, $path)
{
	var_dump($tab);
	$i = 0;
	while (isset($tab[0][$i]))
	{
		exec("bash ".$path."rc".$init.".d/".$tab[0][$i]." stop");
		$verif = shell_exec("echo $?");
		if ($verif)
			echo "Stopping " . $tab[0][$i] . "...   [ \033[32mOK\033[0m ]\n";
		else
			echo "Stopping " . $tab[0][$i] . "...   [ \033[31mFAIL\033[0m ]\n";
		$i++;
	}
	$i = 0;
	while (isset($tab[1][$i]))
	{
		exec("bash ".$path."rc".$init.".d/".$tab[1][$i]." start");
		$verif = shell_exec("echo $?");
		if ($verif)
			echo "Starting " . $tab[1][$i] . "...   [ \033[32mOK\033[0m ]\n";
		else
			echo "Starting " . $tab[1][$i] . "...   [ \033[31mFAIL\033[0m ]\n";
		$i++;
	}
}
