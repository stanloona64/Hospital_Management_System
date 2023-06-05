<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Reports</title>
</head>
<body>

<?php
include("../include/header.php");
include("../include/connection.php");

if (isset($_POST['read'])) {
    $reportId = $_POST['report_id'];
    $query = "UPDATE report SET is_read = 1 WHERE id = '$reportId'";
    mysqli_query($connect, $query);
}

if (isset($_POST['reply'])) {
    $reportId = $_POST['report_id'];
    $replyMessage = $_POST['reply_message'];

    $query = "UPDATE report SET reply_message = '$replyMessage' WHERE id = '$reportId'";
    mysqli_query($connect, $query);
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
                <h5 class="text-center">Total Report</h5>
                <?php
                $query = "SELECT * FROM report";
                $res = mysqli_query($connect,$query);

                $output = "";
                $output .= "
	 					<table class='table table-bordered'>
	 					<tr>
	 					<td>ID</td>
	 					<td>Title</td>
	 					<td>Message</td>
	 					<td>Username</td>
	 					<td>Date Send</td>
	 					<td>Reply</td>
	 					<td>Read</td>
	 					</tr>
	 					";

                if (mysqli_num_rows($res) < 1) {
                    $output .="
	 						<tr>
	 						<td class='text-centered' colspan='7'>No Report</td>
	 						</tr>
	 						";
                }

                while($row = mysqli_fetch_array($res))
                {
                    $output .="
	 							<tr>
	 							<td>".$row['id']."</td>
	 							<td>".$row['title']."</td>
	 							<td>".$row['message']."</td>
	 							<td>".$row['username']."</td>
	 							<td>".$row['date_send']."</td>
	 							<td>
	 								<form method='post'>
	 									<input type='hidden' name='report_id' value='".$row['id']."'>
	 									<textarea name='reply_message' class='form-control' rows='2' placeholder='Enter Reply'></textarea>
	 									<input type='submit' name='reply' value='Send' class='btn btn-success btn-sm mt-2'>
	 								</form>
	 							</td>
	 							<td>
	 								<form method='post'>
	 									<input type='hidden' name='report_id' value='".$row['id']."'>
	 									<input type='submit' name='read' value='Mark as Read' class='btn btn-primary btn-sm'>
	 								</form>
	 							</td>
	 						";
                }

                $output .= "</tr></table>";
                echo $output;

                ?>
            </div>
        </div>
    </div>
</div>

<?php
include("../include/footer.php");
?>

</body>
</html>
