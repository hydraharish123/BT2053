<!DOCTYPE html>
<html>
<head>
    <title>Gene Interaction Results</title>
    <link rel="stylesheet" href="./style.css" />
</head>
<body>
    <div class="container">
        <h1>BT2053: Practical</h1>
        <?php
        // Database connection
        $conn = mysqli_connect("localhost", "root", "", "csv_db 7");

        // Check connection
        if ($conn === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        // Retrieve form inputs
        $gene1 = $_REQUEST['Gene1'];
        $gene2 = $_REQUEST['Gene2'];

        // Query to select rows where "Expression status of Gene 2" is 'Yes'
        $sql = "SELECT * FROM sl_interactions 
                    WHERE `Gene 1` = '$gene1' 
                    AND `Gene 2` = '$gene2' 
                    AND `Expression status of Gene2` = 'Yes'";

        $result = mysqli_query($conn, $sql);
        

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // Fetch the single row
                $row = mysqli_fetch_assoc($result);
        
                // Display the row data
                echo "<p class ='output'><b>Gene 1:</b> " . $row['Gene 1'] . "</p>";
                echo "<p class ='output'><b>Gene 2:</b> " . $row['Gene 2'] . "</p>";
                echo "<p class ='output'><b>Dependency Score:</b> " . $row['Dependency Score'] . "</p>";
                echo "<p class ='output'><b>Cell Line:</b> " . $row['Cell Line'] . "</p>";
                echo "<p class ='output'><b>Mutation:</b> " . $row['Mutation'] . "</p>";
                echo "<p class ='output'><b>Mutation Type:</b> " . $row['Mutation Type'] . "</p>";
                echo "<p class ='output'><b>Present in SynLethDB:</b> " . $row['Present in SynLethDB'] . "</p>";
                echo "<p class ='output'><b>Pubmed ID:</b> " . $row['Pubmed ID'] . "</p>";
                echo "<p class ='output'><b>Expression Status of Gene 1:</b> " . $row['Expression status of Gene1'] . "</p>";
                echo "<p class ='output'><b>Expression Status of Gene 2:</b> " . $row['Expression status of Gene2'] . "</p>";
            } else {
                echo "<p>No results found for Gene 1: <b>$gene1</b> and Gene 2: <b>$gene2</b> where Expression Status of Gene 2 is 'Yes'.</p>";
            }
        } else {
            echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
        }
        

        // Close connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>

