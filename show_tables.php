<?php
include 'config/database.php';
$res = mysqli_query($conn, "SHOW TABLES");
while($row = mysqli_fetch_array($res)) {
    echo "TABLE: " . $row[0] . "\n";
    $cols = mysqli_query($conn, "SHOW COLUMNS FROM `" . $row[0] . "`");
    while($c = mysqli_fetch_assoc($cols)) {
        echo "  - " . $c['Field'] . " (" . $c['Type'] . ")\n";
    }
}
?>
