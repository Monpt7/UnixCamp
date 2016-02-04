<?php

$confFile = fopen('process.conf', 'r');
while ($line = fgets($confFile))
{
  if (preg_match("/^path=\"(.*)\"$/", $line, $output))
    $path = $output[1];
  else if (preg_match("/^default=([\d]+)$/", $line, $output))
    $defInit = $output[1];
}
