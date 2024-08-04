<?php
require_once '../models/Repository_class.php';
// This file will display all records from the tables in the Database

$repository = new Repository();

echo "<h1>Admin page</h1> <p>Displays all records from the tables in the Database.";

# Returning All Users
try {
    $users = $repository->fetchAllUsers();
    if ($users) {
        echo "<h2>Users Table</h2>
            <table border='1'>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Action</th>
            </tr>";

        foreach ($users as $row) {
            echo "<tr>
                    <td>{$row['user_id']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['first_name']}</td>
                    <td>{$row['last_name']}</td>
                    <td>
                        <form method='post' action='admin_delete.php' style='display:inline;'>
                            <input type='hidden' name='user_id' value='{$row['user_id']}'>
                            <button type='submit' name='delete_user' class='btn btn-danger btn-sm'>Delete</button>
                        </form>
                    </td>
                </tr>";
        }

        echo "</table><br>";
    } else {
        echo "No items found.";
    }

} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo "<p>Error connecting to database: $error_message </p>";
}

# Returning All Profiles
try {
    $profiles = $repository->fetchAllProfiles();
    if ($profiles) {
        echo "<h2>Profile Table</h2>
            <table border='1'>
            <tr>
                <th>User ID</th>
                <th>Gender</th>
                <th>Weight</th>
                <th>Height</th>
                <th>Age</th>
                <th>Activity Level</th>
                <th>Desired Objective</th>
                <th>Action</th>
            </tr>";

        foreach ($profiles as $row) {
            echo "<tr>
                    <td>{$row['user_id']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['weight']}</td>
                    <td>{$row['height']}</td>
                    <td>{$row['age']}</td>
                    <td>{$row['activity_level']}</td>
                    <td>{$row['desired_objective']}</td>
                    <td>
                        <form method='post' action='admin_delete.php' style='display:inline;'>
                            <input type='hidden' name='user_id' value='{$row['user_id']}'>
                            <button type='submit' name='delete_profile' class='btn btn-danger btn-sm'>Delete</button>
                        </form>
                    </td>
                </tr>";
        }

        echo "</table><br>";
    } else {
        echo "No items found.";
    }

} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo "<p>Error connecting to database: $error_message </p>";
}

# Returning All Statistics
try {
    $statistics = $repository->fetchAllStatistics();
    if ($statistics) {
        echo "<h2>Statistics Table</h2>
            <table border='1'>
            <tr>
                <th>Stat ID</th>
                <th>User ID</th>
                <th>Date</th>
                <th>Weight</th>
                <th>Calorie Intake</th>
                <th>Protein</th>
                <th>Carbs</th>
                <th>Fats</th>
                <th>Action</th>
            </tr>";

        foreach ($statistics as $row) {
            echo "<tr>
                    <td>{$row['stat_id']}</td>
                    <td>{$row['user_id']}</td>
                    <td>{$row['date']}</td>
                    <td>{$row['weight']}</td>
                    <td>{$row['calorie_intake']}</td>
                    <td>{$row['protein']}</td>
                    <td>{$row['carbs']}</td>
                    <td>{$row['fats']}</td>
                    <td>
                        <form method='post' action='admin_delete.php' style='display:inline;'>
                            <input type='hidden' name='stat_id' value='{$row['stat_id']}'>
                            <button type='submit' name='delete_statistic' class='btn btn-danger btn-sm'>Delete</button>
                        </form>
                    </td>
                </tr>";
        }

        echo "</table><br>";
    } else {
        echo "No items found.";
    }

} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo "<p>Error connecting to database: $error_message </p>";
}
?>
