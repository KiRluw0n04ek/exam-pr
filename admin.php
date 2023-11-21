<?php
include 'db.php';

function createPollTable($pollName, $question, $options)
{
    global $conn;

    $sql = "CREATE TABLE $pollName (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        option_text VARCHAR(255) NOT NULL,
        votes INT(6) DEFAULT 0,
        question TEXT
    )";

    if ($conn->query($sql) === TRUE) {
        for ($i = 0; $i < count($options); $i++) {
            $option = $conn->real_escape_string($options[$i]);
            $sql = "INSERT INTO $pollName (option_text) VALUES ('$option')";
            $conn->query($sql);
        }

        // Записуємо запитання в таблицю
        $sql_insert_question = "UPDATE $pollName SET question = '$question'";
        $conn->query($sql_insert_question);

        return true;
    } else {
        echo "Error creating table: " . $conn->error;
        return false;
    }
}

function displayPollDetails($tableName)
{
    global $conn;

    $sql_poll_details = "SELECT question, option_text, votes FROM $tableName";
    $result_poll_details = $conn->query($sql_poll_details);

    if ($result_poll_details->num_rows > 0) {
        echo "<ul>";
        while ($row_poll_details = $result_poll_details->fetch_assoc()) {
            $question = $row_poll_details['question'];
            $option_text = $row_poll_details['option_text'];
            $votes = $row_poll_details['votes'];

            echo "<li>$question - $option_text (Голосів: $votes)</li>";
        }
        echo "</ul>";
    } else {
        echo "Немає даних для відображення.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['create_vote'])) {
        $name = $conn->real_escape_string($_POST['name']);
        $question = $conn->real_escape_string($_POST['question']);
        $options_count = $_POST['options_count'];


        $options = array();
        for ($i = 1; $i <= $options_count; $i++) {
            $options[] = $_POST["option$i"];
        }

        if (createPollTable($name, $question, $options)) {

            $sql_insert_vote = "INSERT INTO Votes (name, question, status) VALUES ('$name', '$question', 'active')";
            $conn->query($sql_insert_vote);

            echo "Голосування успішно створено!";
        }
    } elseif (isset($_POST['stop_vote'])) {

        $vote_id = $_POST['stop_vote'];
        $sql_update_status = "UPDATE Votes SET status = 'inactive' WHERE id = $vote_id";
        $conn->query($sql_update_status);
        echo "Голосування зупинено!";
    } elseif (isset($_POST['delete_vote'])) {

        $vote_id = $_POST['delete_vote'];


        $sql_delete_vote = "DELETE FROM Votes WHERE id = $vote_id";
        $conn->query($sql_delete_vote);

        echo "Голосування видалено!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #333;
        }

        .poll-container {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
            width: 80%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin: 5px 0;
        }

        .no-polls {
            color: #777;
        }

        .create-form {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
            width: 80%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        textarea,
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class='create-form'>
    <h2>Створення голосування</h2>
    <form action='admin.php' method='post' id='createVoteForm'>
        <label for='name'>Назва голосування:</label>
        <input type='text' name='name' required><br>

        <label for='question'>Запитання:</label>
        <textarea name='question' required></textarea><br>

        <label for='options_count'>Кількість варіантів відповідей (від 2 до 6):</label>
        <input type='number' name='options_count' id='options_count' min='2' max='6' onchange='updateOptions()' required><br>

        <div id='optionsContainer'>

        </div>

        <button type='submit' name='create_vote'>Створити</button>
    </form>
</div>

<?php
$sql_admin = "SHOW TABLES LIKE 'Vote%'";
$result_admin = $conn->query($sql_admin);

if ($result_admin->num_rows > 0) {
    while ($row_admin = $result_admin->fetch_row()) {
        $tableName = $row_admin[0];
        echo "<div class='poll-container'>";
        echo "<h2>$tableName</h2>";
        displayPollDetails($tableName);
        echo "</div>";
    }
} else {
    echo "<p class='no-polls'>Немає голосувань для відображення.</p>";
}

$conn->close();
?>

<script>
    function updateOptions() {
        var optionsContainer = document.getElementById('optionsContainer');
        var optionsCountInput = document.getElementById('options_count');
        var optionsCount = optionsCountInput.value;

        optionsContainer.innerHTML = '';

        for (var i = 1; i <= optionsCount; i++) {
            var newOption = document.createElement('input');
            newOption.type = 'text';
            newOption.name = 'option' + i;
            newOption.placeholder = 'Варіант ' + i;

            optionsContainer.appendChild(newOption);
        }
    }

    window.onload = updateOptions;
</script>

</body>
</html>
