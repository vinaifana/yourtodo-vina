<?php
include 'db.php';
// select data yang akan di edit
$q_select = "SELECT * FROM task WHERE task_id = '" . $_GET['id'] . "'";
$run_q_select = mysqli_query($conn, $q_select);
$d = mysqli_fetch_object($run_q_select);

// Update Data
if (isset($_POST['edit'])) {
    $q_update = "UPDATE task SET task_lable = '" . $_POST['task'] . "' WHERE task_id = '" . $_GET['id'] . "'";
    $run_q_update = mysqli_query($conn, $q_update);
    header('Refresh:0; url=mytodo.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your To Do</title>
    <!-- Link CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Box Icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body class="body_edit">
    <div class="container_parent">
        <div class="image">
            <img src="images/bannerhome.png" alt="">
        </div>

        <div class="container">

            <!-- Header -->
            <div class="text_mytodo">
                <h1 class="todo_head">Edit Your To-Do Here!</h1>
            </div>

            <div class="header">
                <div class="title">
                    <i class='bx bx-sun'></i>
                    <span>To Do List</span>
                </div>
                <div class="description">
                    <?= date("l, d M Y") ?>
                </div>
            </div>
            <div class="content">
                <div class="card">
                    <form action="" method="post">
                        <input name="task" type="text" class="input-control" placeholder="Edit Your To Do" value="<?= $d->task_lable ?>">
                        <div class="text-right">
                            <button type="submit" name="edit" class="btn_save">Save</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- Content -->

    </div>
</body>

</html>