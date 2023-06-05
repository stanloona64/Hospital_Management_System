<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Doctor Details</title>
    <link rel="stylesheet" href="edit_form.css">
</head>
<body>

<?php
include("../include/header.php");
include("../include/connection.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];

    if(isset($_POST['update'])){
        $firstname = $_POST['firstname'];
        $surname = $_POST['surname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $country = $_POST['country'];
        $salary = $_POST['salary'];

        $query = "UPDATE doctors SET firstname='$firstname', surname='$surname', username='$username', email='$email', phone='$phone', gender='$gender', country='$country', salary='$salary' WHERE id='$id'";
        $result = mysqli_query($connect, $query);

        if($result){
            header("Location: edit.php?id=$id");
            exit();
        }else{
            echo "Error: " . mysqli_error($connect);
        }
    }

    if(isset($_POST['delete'])){
        $query = "DELETE FROM doctors WHERE id='$id'";
        $result = mysqli_query($connect, $query);

        if($result){
            echo "<script>alert('User deleted.');</script>";
            header("Location: doctor.php");
            exit();
        }else{
            echo "Error: " . mysqli_error($connect);
        }
    }

    $query = "SELECT * FROM doctors WHERE id='$id'";
    $res = mysqli_query($connect,$query);
    $row = mysqli_fetch_array($res);
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
                <h5 class="text-center my-3">View Doctor Details</h5>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo "<img src='../doctor/img/".$row['profile']."' class='col-md-12 my-2' height='250px;'>" ?>

                            <table class="table table-bordered">
                                <tr>
                                    <th class="text-center" colspan="2">Details</th>
                                </tr>
                                <tr>
                                    <td>Firstname</td>
                                    <td><?php echo $row['firstname'] ?></td>
                                </tr>
                                <tr>
                                    <td>Surname</td>
                                    <td><?php echo $row['surname'] ?></td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td><?php echo $row['username'] ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo $row['email'] ?></td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td><?php echo $row['phone'] ?></td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td><?php echo $row['gender'] ?></td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td><?php echo $row['country'] ?></td>
                                </tr>
                                <tr>
                                    <td>Salary</td>
                                    <td><?php echo $row['salary'] ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6" id="form-section">
                            <form method="post">
                                <div class="form-group">
                                    <label>Firstname</label>
                                    <input type="text" name="firstname" class="form-control" value="<?php echo $row['firstname'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Surname</label>
                                    <input type="text" name="surname" class="form-control" value="<?php echo $row['surname'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" value="<?php echo $row['username'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $row['email'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" value="<?php echo $row['phone'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select name="gender" class="form-control">
                                        <option value="Male" <?php if($row['gender'] == 'Male') echo "selected" ?>>Male</option>
                                        <option value="Female" <?php if($row['gender'] == 'Female') echo "selected" ?>>Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Country</label>
                                    <input type="text" name="country" class="form-control" value="<?php echo $row['country'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Enter Doctor's Salary</label>
                                    <input type="number" name="salary" class="form-control" autocomplete="off" placeholder="Enter Doctor's Salary" value="<?php echo $row['salary']; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="update" value="Update" class="btn btn-success">
                                    <input type="submit" name="delete" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                </div>
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
