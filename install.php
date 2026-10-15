<?php
// Optional database installer. Import database/hms.sql manually if your hosting blocks database creation.
require_once __DIR__ . '/include/config.php';
header('Content-Type: text/plain; charset=utf-8');
$path=__DIR__.'/database/hms.sql';
if (!is_file($path)) { exit("database/hms.sql not found\n"); }
$sql=file_get_contents($path);
if (mysqli_multi_query($con,$sql)) {
    do { if($r=mysqli_store_result($con)){ mysqli_free_result($r); } } while(mysqli_more_results($con) && mysqli_next_result($con));
    echo "Database import completed. Remove install.php after setup.\n";
} else { echo "Import failed: ".mysqli_error($con)."\n"; }
?>
