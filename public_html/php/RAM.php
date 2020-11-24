<?php

$total_memory = exec("free -m | awk 'NR==2{print $2 }'");
$used_memory = exec("free -m | awk 'NR==2{print $3 }'");
$free_memory = $total_memory - $used_memory;
echo $total_memory . " " . $used_memory ." ". $free_memory;

?>