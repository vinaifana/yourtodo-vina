<?php
include 'db.php';

// Proses Insert
if (isset($_POST['add'])) {
    $q_insert = "INSERT INTO task (task_lable, task_status) VALUE (
        '" . $_POST['task'] . "',
        'open'
    )";

    $run_q_insert = mysqli_query($conn, $q_insert);
    // if($run_q_insert){
    //     header('Refresh:0; url=index.php');
    // }

    if (!$run_q_insert) {
        echo 'Error: ' . mysqli_error($conn);
    } else {
        header('Refresh:0 url=mytodo.php');
    }
}

// Show Data
$q_select = "SELECT * FROM task ORDER BY task_id DESC";
$run_q_select = mysqli_query($conn, $q_select);

// Delete Data
if (isset($_GET['delete'])) {
    $q_delete = "DELETE FROM task WHERE task_id = '" . $_GET['delete'] . "'";
    $run_q_delete = mysqli_query($conn, $q_delete);
    header('Refresh:0; url=mytodo.php');
}

// Update Status Data Open/Close
if (isset($_GET['done'])) {
    $status = 'close';
    if ($_GET['status'] == 'open') {
        $status = 'close';
    } else {
        $status = 'open';
    }

    $q_update = "UPDATE task SET task_status = '" . $status . "' WHERE task_id = '" . $_GET['done'] . "'";
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

<body class="mytodo_body">
    <div class="container_parent">
        <div class="image">
            <img src="images/bannerhome.png" alt="">
        </div>

        <div class="container">

            <!-- Header -->
            <div class="text_mytodo">
                <h1 class="todo_head">Your To-Do, Here For You!</h1>
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

            <!-- Content -->
            <div class="content">
                <div class="card">
                    <form action="" method="post">
                        <input name="task" type="text" class="input-control" placeholder="Add Your To Do">
                        <div class="text-right">
                            <button type="submit" name="add" class="btn_add">Add</button>
                        </div>
                    </form>
                </div>

            </div>


            <?php
            if (mysqli_num_rows($run_q_select) > 0) {
                while ($r = mysqli_fetch_array($run_q_select)) {

            ?>
                    <div class="card">
                        <div class="task-item <?= $r['task_status'] == 'close' ? 'done' : '' ?>">
                            <div>
                                <input type="checkbox" onclick="window.location.href = '?done=<?= $r['task_id'] ?>&status=<?= $r['task_status'] ?>'" <?= $r['task_status'] == 'close' ? 'checked' : '' ?>>
                                <span><?= $r['task_lable'] ?></span>
                            </div>
                            <div>
                                <a href="edit.php?id=<?= $r['task_id'] ?>" class="edit-task" title="Edit"><i class='bx bx-message-square-edit'></i></a>
                                <a href="?delete=<?= $r['task_id'] ?>" class="delete-task" title="Remove" onclick="return confirm('Are you sure?')"><i class='bx bxs-trash'></i></a>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <div class="add_todo">Add Your To-Do immediately!</div>
            <?php } ?>

        </div>
    </div>
</body>

</html>