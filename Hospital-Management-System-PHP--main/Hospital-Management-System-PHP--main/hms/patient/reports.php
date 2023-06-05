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
            <h5 class="text-center">Reports</h5>

<?php
$query = "SELECT * FROM report";
$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $title = $row['title'];
        $message = $row['message'];
        $username = $row['username'];
        $dateSend = $row['date_send'];
        $replyMessage = $row['reply_message'];
        $isRead = $row['is_read'];

        echo "<div class='card mb-3'>";
        echo "<div class='card-body'>";
        echo "<h3 class='card-title'>$title</h3>";
        echo "<p class='card-text'>$message</p>";
        echo "<p class='card-text'>Sent by: $username</p>";
        echo "<p class='card-text'>Date Sent: $dateSend</p>";

        if (!empty($replyMessage)) {
            echo "<p class='card-text'>Reply: $replyMessage</p>";
        }

        if ($isRead) {
            echo "<p class='card-text'>Read: Yes</p>";
        } else {
            echo "<p class='card-text'>Read: No</p>";
        }

        echo "</div>";

        echo "<div class='card-footer'>";
        echo "<form method='post'>";
        echo "<input type='hidden' name='report_id' value='$id'>";
        echo "<textarea name='reply_message' class='form-control' rows='2' placeholder='Enter Reply'></textarea>";
        echo "<input type='submit' name='reply' value='Send Reply' class='btn btn-primary btn-sm mt-2'>";
        echo "</form>";
        echo "</div>";

        echo "</div>";
    }
} else {
    echo "<p>No reports found.</p>";
}

if (isset($_POST['reply'])) {
    $reportId = $_POST['report_id'];
    $replyMessage = $_POST['reply_message'];

    $query = "UPDATE report SET reply_message = '$replyMessage' WHERE id = '$reportId'";
    mysqli_query($connect, $query);

    $query = "UPDATE report SET is_read = 1 WHERE id = '$reportId'";
    mysqli_query($connect, $query);
}
?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>

<?php
include("../include/footer.php");
?>

    </body>
</html>
