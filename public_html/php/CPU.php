<?php
$loads = sys_getloadavg();
$core_n = exec("nproc --all");
for($i = 0; $i<count($loads); ++$i){
	$loads[$i] = round($loads[$i] / $core_n * 100,2);
}
echo json_encode($loads);
?>
