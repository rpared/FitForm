<?php
include("../partials/user_header.php");
require_once '../../models/Repository_class.php';
include("../../controllers/backgroundImage.php");

// This check is needed beacuse the user_header.php starts session too
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session
}
// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
}
$user_id = $_SESSION['user_id']; //Retrieve from the _Session superglobal
$first_name = $_SESSION['first_name'];

// Initialize the repository
$repository = new Repository();
$errors=[];
// Load the profile
try {
    $user = $repository->getUserProfile($user_id);

    $user_desired_objective = $user['desired_objective'];

    if($user_desired_objective == "Weight Loss"){
        $greeting = "Let's crush those extra calories together, <b>" . $first_name . "</b>!";
    }
    if($user_desired_objective == "Muscle Gain"){
        $greeting = "Time to build those muscles, <b>" . $first_name . "</b>! Let's get those gains!";
    }
    if($user_desired_objective == "Maintain Weight"){
        $greeting = "You're doing great, <b>" . $first_name . "</b>! Keep up the fantastic work!";
    }


} catch (Exception $e) {
    $errors[] = "An error occurred: " . $e->getMessage();
}

// Define the number of records per page
$records_per_page = 6;

// Get the current page from the query parameter, default to 1 if not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// Fetch paginated data
try {
    $statistics = $repository->getUserStatisticsPaginated($user_id, $records_per_page, $offset);
} catch (PDOException $e) {
    $errors[] = "Error connecting to database: " . $e->getMessage();
}

// Fetch total count of records for pagination
try {
    $total_records = $repository->getTotalStatisticsCount($user_id);
    $total_pages = ceil($total_records / $records_per_page);
} catch (PDOException $e) {
    $errors[] = "Error connecting to database: " . $e->getMessage();
}

    // Sort data for chart display (ascending order)
try{
    $full_statistics = $repository->getUserStatistics($user_id);
    $statistics_for_chart = $full_statistics;
    usort($statistics_for_chart, function($a, $b) {
        return strtotime($a['date']) - strtotime($b['date']);
    });


} catch (PDOException $e) {
    $errors[] = "Error connecting to database: " . $e->getMessage();
}



?>

<div class="sidebar">
    <a href="user_home.php">User Dashboard</a>
    <a href="add_progress.php">Add Progress</a>
    <a href="/FitForm/views/users/edit_objective_form.php">Edit Objective</a>
    <a href="/FitForm/views/users/edit_profile_form.php">Edit Profile</a>
    <a href="/FitForm/views/users/edit_user_form.php">Edit Account</a>
    <a href="#" id="delete-account-link">Delete Account</a>
    <a href="../../controllers/logout.php">Logout</a>
</div>

<div class="main-content">
    <main>
        <br>
        <h3 class="text-center"><?php echo $greeting; ?>!</h3>

        <h5> &rarr; Objective: <b class="objective"><?php echo htmlspecialchars($user_desired_objective); ?></b></h5>

        <!-- Display Records -->
        <div class="container mt-5">
            <div class="form-container mt-4">
                <h2 class="text-center">Progress Tracker</h2>
                <p>Your statistics so far:</p>
                <!-- Make the table responsive -->
                <div class="table-responsive">
                    <table class="table table-striped progress-tracker">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Weight</th>
                                <th>Calories</th>
                                <th>Protein</th>
                                <th>Carbs</th>
                                <th>Fats</th>
                                <th>-</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($statistics)): ?>
                                <?php foreach ($statistics as $row): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['date']); ?></td>
                                        <td><?php echo htmlspecialchars(number_format($row['weight'], 1)) . ' kg'; ?></td>
                                        <td><?php echo htmlspecialchars($row['calorie_intake'] ?? 'NULL'); ?></td>
                                        <td><?php echo htmlspecialchars(number_format($row['protein'], 0) ?? 'NULL') . ' g'; ?></td>
                                        <td><?php echo htmlspecialchars(number_format($row['carbs'], 0) ?? 'NULL') . ' g'; ?></td>
                                        <td><?php echo htmlspecialchars(number_format($row['fats'], 0) ?? 'NULL') . ' g'; ?></td>
                                        <td>
                                            <form method="post" action="../../controllers/delete_statistic.php" style="display: inline;">
                                                <input type="hidden" name="stat_id" value="<?php echo htmlspecialchars($row['stat_id']); ?>">
                                                <button type="submit" name="delete_statistic" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7">No statistics found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                
            
                
                    <!-- Pagination Controls -->
                    <div class="pagination">
                        <?php if ($page > 1): ?>
                            <a href="?page=<?php echo $page - 1; ?>" class="btn">← Previous</a>
                        <?php endif; ?>
                        
                        <?php if ($page < $total_pages): ?>
                            <a href="?page=<?php echo $page + 1; ?>" class="btn">Next →</a>
                        <?php endif; ?>
                    </div>
            </div>
        </div>

            <!-- Canvas for Chart.js -->
            <div class="form-container mt-4">
                <h3>Weight Over Time</h3>
                <p>Define Range (default is All Time)</p>
                <button class="chart-range" id="last5">Last 5 records</button>
                <button class="chart-range" id="lastYear">Last Year</button>
                <button class="chart-range active" id="allTime" class="active">All Time</button>
                <canvas id="weightChart" width="400" height="200"></canvas>
                <br>
                <h3>Calories Over Time</h3>
                <canvas id="caloriesChart" width="400" height="200"></canvas>
            
            </div>

            <button class="btn btn-success btn-calculate">
                <a style="color: white; text-decoration: none;" href="add_progress.php">Add Progress</a>
            </button>

            

        </div>
    </main>
    <script>
    document.querySelector('#delete-account-link').addEventListener('click', function(event) {
        
        event.preventDefault(); // Prevent the default action
        console.log("clicked");
        if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
            window.location.href = '../../controllers/delete_user.php';
        }
    });

   
        document.addEventListener('DOMContentLoaded', function() {
            // Extract data from PHP
            const statistics = <?php echo json_encode($statistics_for_chart); ?>;
            
            // Prepare data for Chart.js
           // Function to get filtered data based on the range

           let filter = 'allTime'; //Default
            const getFilteredData = (filter) => {
                const now = new Date();
                let filtered = [];

                if (filter === 'last5') {
                    // Get the last 5 entries
                    filtered = statistics.slice(-5);
                } else if (filter === 'lastYear') {
                    // Get data from the last year
                    filtered = statistics.filter(stat => {
                        const date = new Date(stat.date);
                        return date >= new Date(now.getFullYear() - 1, now.getMonth(), now.getDate());
                    });
                } else {
                    // Default: All Time
                    filtered = statistics;
                }

                return {
                    labels: filtered.map(stat => stat.date),
                    weights: filtered.map(stat => stat.weight),
                    calories: filtered.map(stat => stat.calorie_intake || 0),
                };
            };

             // Function to update charts
    const updateCharts = (filter) => {
        const filteredData = getFilteredData(filter);

        // Log data to debug
        console.log('Filtered Data:', filteredData);

        if (weightChart && caloriesChart) {
            weightChart.data.labels = filteredData.labels;
            weightChart.data.datasets[0].data = filteredData.weights;
            weightChart.update();
            
            caloriesChart.data.labels = filteredData.labels;
            caloriesChart.data.datasets[0].data = filteredData.calories;
            caloriesChart.update();
        } else {
            console.error('Chart instances are not initialized.');
        }
    };

            
            // Create the weight chart
            const ctx = document.getElementById('weightChart').getContext('2d');
            const weightChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: getFilteredData(filter).labels,
                    datasets: [
                        {
                            label: 'Weight (kg)',
                            data: getFilteredData(filter).weights,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: true,
                        }
                    ]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        },
                        y: {
                            beginAtZero: false,
                            title: {
                                display: true,
                                text: 'Kg.'
                            }
                        }
                    }
                }
            });

            // Create the calories chart
            const ctx2 = document.getElementById('caloriesChart').getContext('2d');
            const caloriesChart = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: getFilteredData(filter).labels,
                    datasets: [
                        
                        {
                            label: 'Daily Calories',
                            data: getFilteredData(filter).calories,
                            borderColor: 'rgba(255, 159, 64, 1)',
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            fill: true,
                        }
                    ]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        },
                        y: {
                            beginAtZero: false,
                            // min: 1000, // Minimum value for y-axis
                            // max: 3000, // Maximum value for y-axis
                            title: {
                                display: true,
                                text: 'Calories'
                            }
                        }
                    }
                }
            });

        // Button event listeners
        document.getElementById('last5').addEventListener('click', () => {
                updateCharts('last5');
                document.getElementById('last5').classList.add('active');
                document.getElementById('lastYear').classList.remove('active');
                document.getElementById('allTime').classList.remove('active');
            });

            document.getElementById('lastYear').addEventListener('click', () => {
                updateCharts('lastYear');
                document.getElementById('last5').classList.remove('active');
                document.getElementById('lastYear').classList.add('active');
                document.getElementById('allTime').classList.remove('active');
            });

            document.getElementById('allTime').addEventListener('click', () => {
                updateCharts('allTime');
                document.getElementById('last5').classList.remove('active');
                document.getElementById('lastYear').classList.remove('active');
                document.getElementById('allTime').classList.add('active');
            });

        });





    </script>



<?php
$_SESSION['user_id'] = $user_id;
$_SESSION['first_name'] = $first_name;

include("../partials/footer.php")
?>