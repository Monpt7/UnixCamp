<?php
require_once('process.php');
require_once('recup.php');
require_once('parseConf.php');

$tab = recup($defInit, $path);
$tabOld = recupOld($previous, $path);
killOld($tabOld, $previous, $path);
process($tab, $defInit, $path);
