<?php
$total_cpu = exec("top -bn1 | grep \"Cpu(s)\" | awk '{print 100-$8}'");
echo $total_cpu;
?>