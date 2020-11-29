<?php 
exec ( "top -bn1 -o %MEM | head -10 | tail -3 | awk '{print $10 \" \" $12}'", $salida_ram);
echo json_encode($salida_ram)
?>;