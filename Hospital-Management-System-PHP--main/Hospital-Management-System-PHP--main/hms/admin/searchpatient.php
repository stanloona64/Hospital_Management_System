<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Patient</title>
</head>
<body>

<?php
include("../include/header.php");
include("../include/connection.php");

$output = "";

if (isset($_POST['search'])) {
    $searchKeyword = $_POST['searchKeyword'];

    if (empty($searchKeyword)) {
        $query = "SELECT * FROM patient";
    } else {
        $query = "SELECT * FROM patient WHERE firstname LIKE '%$searchKeyword%'";
    }
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {

        $output .= "
            <table class='table table-bordered'>
                <tr>
                    <th>ID</th>
                    <th>Firstname</th>
                    <th>Surname</th>
                    <th>Username</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Country</th>
                </tr>
        ";

        while ($row = mysqli_fetch_assoc($result)) {
            $patientId = $row['id'];
            $firstname = $row['firstname'];
            $surname = $row['surname'];

            $output .= "
                <tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['firstname'] . "</td>
                    <td>" . $row['surname'] . "</td>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['gender'] . "</td>
                    <td>" . $row['phone'] . "</td>
                    <td>" . $row['country'] . "</td>
                    <td>
                        <a href='view.php?id=" . $row['id'] . "'>
                            <button class='btn btn-info'>Edit</button>
                        </a>
                    </td>
                </tr>
            ";
        }

        $output .= "</table>";
    } else {
        $output .= "<p>No patients found.</p>";
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
                <h5 class="text-center my-3">Search Patients</h5>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <form method="post" class="mt-4">
                                <div class="input-group">
                                    <input type="text" name="searchKeyword" class="form-control" placeholder="Search by First Name">
                                    <div class="input-group-append">
                                        <button type="submit" name="search" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php echo $output; ?>

            </div>
        </div>
    </div>
</div>

<?php
include("../include/footer.php");
?>

</body>
</html>