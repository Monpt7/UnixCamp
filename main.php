<?php
require_once('process.php');
require_once('recup.php');
require_once('parseConf.php');

if (isset($argv[1]))
  $defInit = $argv[1];
$tab = recup($defInit, $path)
process($tab, $defInit, $path);