// vote.php
<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['table_name']) && isset($_POST['option_id'])) {
        $table_name = $_POST['table_name'];
        $option_id = $_POST['option_id'];

        // Оновлення лічильника голосів для вибраного варіанту
        $sql_update_votes = "UPDATE $table_name SET votes = votes + 1 WHERE id = $option_id";
        $conn->query($sql_update_votes);

        echo "Голос успішно додано!";
    } else {
        echo "Помилка при обробці голосу.";
    }
} else {
    echo "Неправильний метод запиту.";
}

$conn->close();
?>
