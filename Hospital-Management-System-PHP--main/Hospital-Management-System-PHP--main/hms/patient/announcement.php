<!DOCTYPE html>
<html>
<head>
    <title>Announcement</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="ann_sidenav.css">
</head>
<body>

<?php
session_start();
include("../include/header.php");
include("../include/connection.php");
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?php include("sidenav.php"); ?>
        </div>
        <div class="col-md-10">
            <h5 class="text-center">Announcement</h5>
            <?php
            $query = "SELECT * FROM announcements";
            $result = mysqli_query($connect, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $title = $row['title'];
                    $description = $row['description'];
                    ?>
                    <div class="card mt-3">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $title; ?></h3>
                            <p class="card-text"><?php echo $description; ?></p>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No announcements found.</p>";
            }
            ?>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<?php
include("../include/footer.php");
?>
</body>
</html>
