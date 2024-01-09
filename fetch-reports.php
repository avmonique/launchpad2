<?php
require "config.php";

$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
if ($searchQuery) {
    $fetchPubProjects = "SELECT * FROM published_project INNER JOIN project ON published_project.Project_ID = project.Project_ID INNER JOIN ideation_phase ON ideation_phase.Project_ID = published_project.Project_ID INNER JOIN company_registration ON project.Company_ID = company_registration.Company_ID WHERE published_project.Project_ID AND (project.Project_title LIKE '%$searchQuery%' OR project.Project_Description LIKE '%$searchQuery%')";
    $result = $conn->query($fetchPubProjects);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="col-md-4 project-card">
                <a class="card-link" href="published-proj-view.php?project_id=<?php echo $row['PublishedProjectID']; ?>">
                    <!-- Your card content here -->
                    <img src="<?php echo $row['Project_logo']; ?>" alt="" class="card-img">
                    <div class="top-card-content">
                        <p class="card-category"></p>
                        <p class="date"><?php echo date("F j, Y", strtotime($row['Published_date'])); ?></p>
                    </div>
                    <div class="project-content">
                        <h2 class="project-title"><?php echo $row['Project_title']; ?></h2>
                        <div class="project-desc">
                            <p><?php echo $row['Project_Description']; ?></p>
                        </div>
                    </div>
                    <div class="bottom-card-content">
                        <img class="comp-logo" src="<?php echo $row['Company_logo']; ?>" alt="">
                        <p><?php echo $row['Company_name']; ?></p>
                    </div>
                </a>
            </div>
            <?php
        }
    } else {
        echo '<p>No projects found.</p>';
    }
}
?>

