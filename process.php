<?php

function process($tab, $init)
{
	var_dump($tab);
	$i = 0;
	while (isset($tab[0][$i]))
	{
		echo shell_exec("bash /etc/rc".$init.".d/".$tab[0][$i]." stop");
		$i++;
	}
	$i = 0;
	while (isset($tab[1][$i]))
	{
		echo shell_exec("bash /etc/rc".$init.".d/".$tab[1][$i]." start");
		$i++;
	}
}