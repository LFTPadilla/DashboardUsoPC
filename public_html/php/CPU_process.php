<?php 
exec ( "top -n1 -b | head -10 | tail -3 | awk '{print $9 \" \" $12}'", $salida_cpu);
echo json_encode($salida_cpu)
?>;