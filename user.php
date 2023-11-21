<?php
include 'db.php';

$sql_user = "SHOW TABLES LIKE 'Vote%'";
$result_user = $conn->query($sql_user);

if ($result_user->num_rows > 0) {
    while ($row_user = $result_user->fetch_row()) {
        $table_name = $row_user[0];


        if (strpos($table_name, 'Vote') === 0) {
            echo "<div class='vote-container'>";
            echo "<h2>$table_name</h2>";

            $sql_question = "SELECT question FROM $table_name";
            $result_question = $conn->query($sql_question);

            if ($result_question->num_rows > 0) {
                $row_question = $result_question->fetch_assoc();
                $question = $row_question['question'];
                echo "<p class='question'>$question</p>";
            }

            $sql_options = "SELECT id, option_text, votes FROM $table_name";
            $result_options = $conn->query($sql_options);

            while ($row_option = $result_options->fetch_assoc()) {
                $option_id = $row_option['id'];
                $option_text = $row_option['option_text'];
                $votes = $row_option['votes'];

                echo "<div id='option_$option_id' class='option'>";
                echo "<p class='option-text'>$option_text</p>";
                echo "<button class='vote-btn' onclick=\"vote('$table_name', $option_id, this)\">Проголосувати</button>";
                echo "<span id='votes_$option_id' class='vote-count' style='display: none;'> Голосів: $votes</span>";
                echo "</div>";
            }

            echo "</div>";
        }
    }
} else {
    echo "<p class='no-votes'>Немає голосувань для відображення.</p>";
}

$conn->close();
?>

<script>
    function vote(table, option, button) {

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(xhr.responseText);


                var buttons = document.querySelectorAll(".vote-btn");
                buttons.forEach(function(b) {
                    b.style.display = "none";
                });

                var votesElements = document.querySelectorAll(".vote-count");
                votesElements.forEach(function(votesElement) {
                    votesElement.style.display = "inline";
                });
            }
        };
        xhr.open("POST", "vote.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("table_name=" + table + "&option_id=" + option);
    }
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .vote-container {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }

        .vote-container h2 {
            color: #333;
        }

        .question {
            margin: 0;
        }

        .option {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .option-text {
            margin: 0;
            margin-right: 10px;
        }

        .vote-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
        }

        .vote-btn:hover {
            background-color: #45a049;
        }

        .vote-count {
            display: none;
        }

        .no-votes {
            color: #777;
        }
    </style>
</head>
<body>
    <h1>Голосування</h1>

</body>
</html>
