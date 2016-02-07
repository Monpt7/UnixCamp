<?php
require_once('include/process.php');
require_once('include/recup.php');
require_once('include/parseConf.php');

$tab = recup($defInit, $path);
$tabOld = recupOld($previous, $path);
killOld($tabOld, $previous, $path);
process($tab, $defInit, $path);
