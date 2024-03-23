<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
            padding-top: 0;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"] {
            width: 200px;
            padding: 8px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 8px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, td, th {
            border: 2px solid red;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Search Faculty</h2>
    <form method="GET">
        <label for="school">School:</label>
        <input type="text" id="school" name="school">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
        <input type="submit" value="Search">
    </form>

    <?php
    $con = mysqli_connect('localhost', 'root', '', 'my_db');

    // Initialize variables
    $whereClause = "";

    // Check if 'school' parameter is set and not empty
    if (isset($_GET['school']) && !empty($_GET['school'])) {
        $school = $_GET['school'];
        // Add condition to the WHERE clause
        $whereClause .= "school LIKE '%$school%' AND ";
    }

    // Check if 'name' parameter is set and not empty
    if (isset($_GET['name']) && !empty($_GET['name'])) {
        $name = $_GET['name'];
        // Add condition to the WHERE clause
        $whereClause .= "name LIKE '%$name%' AND ";
    }

    // Trim trailing "AND" from the WHERE clause
    $whereClause = rtrim($whereClause, " AND ");

    // Construct the SQL query with the WHERE clause
    $query = "SELECT * FROM faculty_info";
    if (!empty($whereClause)) {
        $query .= " WHERE $whereClause";
    }

    $result = mysqli_query($con, $query);

    echo "<table>
    <tr>
    <th>Name</th>
    <th>School</th>
    <th>Designation</th>
    </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['school'] . "</td>";
        echo "<td>" . $row['designation'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    mysqli_close($con);
    ?>
</div>

</body>
</html>
