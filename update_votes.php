<?php
include 'db.php';

$response = array();

$sql = "SELECT id, votes FROM $table_name";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $response[] = array(
        'option_id' => $row['id'],
        'votes' => $row['votes']
    );
}

echo json_encode($response);

$conn->close();
?>
