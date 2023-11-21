<?php
include 'db.php';

if (isset($_GET['table'])) {
    $tableName = $_GET['table'];
    $sql_votes = "SELECT SUM(votes) FROM $tableName";
    $result_votes = $conn->query($sql_votes);

    if ($result_votes->num_rows > 0) {
        $row_votes = $result_votes->fetch_row();
        echo $row_votes[0];
    } else {
        echo "0";
    }
}

$conn->close();
?>
