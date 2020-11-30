<?php
exec ( 'df -m | tail -n +2', $salida);
echo json_encode($salida);
?>