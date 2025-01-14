<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$output = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from form
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $cp = $_POST['cp'];
    $trestbps = $_POST['trestbps'];
    $chol = $_POST['chol'];
    $fbs = $_POST['fbs'];
    $restecg = $_POST['restecg'];
    $thalach = $_POST['thalach'];
    $exang = $_POST['exang'];
    $oldpeak = $_POST['oldpeak'];
    $slope = $_POST['slope'];
    $ca = $_POST['ca'];
    $thal = $_POST['thal'];

    // Save data to the database
    $conn = new mysqli("localhost", "root", "", "heart_disease");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into database
    $stmt = $conn->prepare("INSERT INTO predictions (age, sex, cp, trestbps, chol, fbs, restecg, thalach, exang, oldpeak, slope, ca, thal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiiiiiiiiiii", $age, $sex, $cp, $trestbps, $chol, $fbs, $restecg, $thalach, $exang, $oldpeak, $slope, $ca, $thal);
    $stmt->execute();
    $stmt->close();

    // Call Python script for prediction
    $command = escapeshellcmd("python predict.py $age $sex $cp $trestbps $chol $fbs $restecg $thalach $exang $oldpeak $slope $ca $thal");
    $output = shell_exec($command);

    // Trim and extract JSON from the output
    $output = trim($output);
    $json_start = strpos($output, '{');
    if ($json_start !== false) {
        $output = substr($output, $json_start);
        $output = json_decode($output, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $output = null;
            $error_message = "JSON Error: " . json_last_error_msg();
        }
    } else {
        $output = null;
        $error_message = "Error: JSON not found in the output.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heart Disease Prediction</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .graphs-section {
            margin-top: 30px;
            text-align: center;
        }
        .graphs-section .graph-item {
            display: inline-block;
            margin: 15px;
            text-align: center;
        }
        .graphs-section .graph-img {
            max-width: 300px;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
        }
        .graphs-section .graph-caption {
            font-size: 14px;
            color: #555;
            text-transform: capitalize;
        }

        .overall-result {
            text-align: center;
            font-size: 2em;
            margin-bottom: 20px;
            color: #333;
            font-weight: bold;
        }
        .overall-result i {
            font-size: 2.5em;
            vertical-align: middle;
            margin-right: 10px;
        }
        .result {
            margin-top: 20px;
        }
        .result .prediction {
            font-size: 1.5em;
            font-weight: bold;
            color: #f44336;
        }
        .result .prediction.healthy {
            color: #4CAF50;
        }
        .neighbor-list {
            list-style: none;
            padding: 0;
        }
        .neighbor-item {
            background-color: #f4f4f4;
            margin: 10px 0;
            padding: 10px;
            border-left: 4px solid #f44336;
            border-radius: 5px;
        }
        .neighbor-item.healthy {
            border-left-color: #4CAF50;
        }

        footer {
            text-align: center;
            margin: 20px 0;
            color: #888;
        }
        pre {
    margin: 0;
    padding: 10px;
    font-family: 'Courier New', Courier, monospace;
    background-color: #333; /* Dark background for the code box */
    color: #fff; /* White text color */
    border-radius: 5px;
    white-space: pre-wrap; /* Wraps long lines */
    overflow-wrap: break-word; /* Ensures lines break properly */
    line-height: 1.4; /* Adjust line height to reduce spacing */
}

.code-box {
    background-color: #f5f5f5; /* Light background for the entire box */
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.table th, .table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

.table th {
    background-color: #f4f4f4;
}

.table td {
    background-color: #fff;
}


    </style>
</head>
<body>
    <header>
        <h1>Heart Disease Prediction Result</h1>
    </header>
    <div class="container">
        <?php if (isset($output) && is_array($output)): ?>
            <?php
            // Determine overall result
            $overallResult = $output['prediction'] == 1 ? "High Risk of Heart Disease" : "No Heart Disease";
            $iconClass = $output['prediction'] == 1 ? "fas fa-heart-broken" : "fas fa-heart";
            ?>
            <div class="overall-result">
                <i class="<?= $iconClass ?>"></i>
                <strong><?= $overallResult ?></strong>
            </div>

            <!-- New section for displaying accuracy, classification report, and confusion matrix -->
            <div class="result">
    <div class="code-box">
        <h2>Accuracy and Evaluation</h2>
        <p><strong>Accuracy:</strong> <?= $output['accuracy'] ?>%</p>
        <h3>Classification Report:</h3>
        <pre><?= $output['classification_report'] ?></pre>

        <h3>Confusion Matrix:</h3>
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Predicted 0</th>
                    <th>Predicted 1</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Actual 0</td>
                    <td><?= $output['confusion_matrix'][0][0] ?></td>
                    <td><?= $output['confusion_matrix'][0][1] ?></td>
                </tr>
                <tr>
                    <td>Actual 1</td>
                    <td><?= $output['confusion_matrix'][1][0] ?></td>
                    <td><?= $output['confusion_matrix'][1][1] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>



        <?php elseif (isset($error_message)): ?>
            <p class="error"><?= $error_message ?></p>
        <?php else: ?>
            <p>Error decoding prediction output or no output received.</p>
        <?php endif; ?>

        <div class="graphs-section">
            <h2>Training and Analysis Visualizations</h2>
            <p>Below are the graphs generated during training and analysis:</p>
            <?php
            // Define the path to the graphs folder
            $graphs_path = 'Graphs/';
            $graph_files = array_diff(scandir($graphs_path), ['.', '..']); // Exclude . and ..
            
            // Loop through each graph file and display it
            foreach ($graph_files as $graph) {
                $graph_url = $graphs_path . $graph;
                echo "<div class='graph-item'>";
                echo "<img src='{$graph_url}' alt='Graph: {$graph}' class='graph-img'>";
                echo "<p class='graph-caption'>" . ucfirst(str_replace('_', ' ', pathinfo($graph, PATHINFO_FILENAME))) . "</p>";
                echo "</div>";
            }
            ?>
        </div>

    </div>
    <footer>
        &copy; 2024 Heart Disease Prediction System
    </footer>
</body>
</html>
