<?php
session_start();

include("../include/header.php");
include("../include/connection.php");
$show = "";

if (isset($error['u'])) {
    $er = $error['u'];
    $show = "<h5 class='text-center alert alert-danger'>$er</h5>";
}
$query = "SELECT * FROM patient";
$res = mysqli_query($connect, $query);

$output = "";
$output .= "
    <table class='table table-bordered'>
        <tr>
            <td>ID</td>
            <td>Firstname</td>
            <td>Surname</td>
            <td>Username</td>
            <td>Email</td>
            <td>Phone</td>
            <td>Gender</td>
            <td>Country</td>
            <td>Date Reg.</td>
            <td>Action</td>
        </tr>
";

if (mysqli_num_rows($res) < 1) {
    $output .= "
        <tr>
            <td class='text-center' colspan='10'>No Patient Yet</td>
        </tr>
    ";
}

while ($row = mysqli_fetch_array($res)) {
    $output .= "
        <tr>
            <td>" . $row['id'] . "</td>
            <td>" . $row['firstname'] . "</td>
            <td>" . $row['surname'] . "</td>
            <td>" . $row['username'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['phone'] . "</td>
            <td>" . $row['gender'] . "</td>
            <td>" . $row['country'] . "</td>
            <td>" . $row['date_reg'] . "</td>
            <td>
                <a href='view.php?id=" . $row['id'] . "'>
                    <button class='btn btn-info'>View</button>
                </a>
            </td>
        </tr>
    ";
}

$output .= "
    </table>
";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Total Patient</title>
</head>
<body>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2" style="margin-left: -30px;">
                <?php
                include("sidenav.php");
                ?>
            </div>
            <div class="col-md-10">
                <h5 class="text-centered my-3">Total Patient</h5>
                <?php
                echo $output;
                ?>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 offset-md-3">
    <h5 class="text-center">Add Patient</h5>
    <form method="post" enctype="multipart/form-data">
        <div>
            <?php echo $show; ?>
        </div>
        <div class="form-group">
            <label>Firstname</label>
            <input type="text" name="fname" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label>Surname</label>
            <input type="text" name="surname" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="uname" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="pass" class="form-control">
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label>Gender</label>
            <select name="gender" class="form-control">
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div class="form-group">
            <label>Country</label>
            <input type="text" name="country" class="form-control" autocomplete="off">
        </div>
        <input type="submit" name="add" value="Add New Patient" class="btn btn-success">
    </form>
</div>

<?php
include("../include/footer.php");
?>

</body>
</html>
