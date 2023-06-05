<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Announcement</title>
</head>
<body>

<?php
include("../include/header.php");
include("../include/connection.php");

if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    if (empty($title) || empty($description)) {
        echo "<script>alert('Please fill in all fields')</script>";
    } else {
        $query = "INSERT INTO announcements (title, description) VALUES ('$title', '$description')";
        $result = mysqli_query($connect, $query);

        if ($result) {
            echo "<script>alert('Announcement added successfully')</script>";
        } else {
            echo "<script>alert('Failed to add announcement')</script>";
        }
    }
}
?>

<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2" style="margin-left: -30px;">
                <?php
                include("sidenav.php");
                ?>
            </div>
            <div class="col-md-10">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Add Announcement</h2>
                            <form method="post">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter Announcement Title">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter Announcement Description"></textarea>
                                </div>
                                <input type="submit" name="add" value="Add Announcement" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("../include/footer.php");
?>

</body>
</html>
