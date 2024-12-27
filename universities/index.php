<?php
    session_start();
    require '../db_conn/database.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Universities</title>
</head>
<body>
<?php include '../header.php'; ?>
<div class="container mt-4">

<?php include('message.php'); ?>

<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h4>Universities
                    <a href="university-create.php" class="btn btn-primary float-end">Add University</a>
                </h4>
            </div>
            <div class="card-body">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $query = "SELECT id, name, address, image FROM universities";
                        $query_run = mysqli_query($link, $query);

                        if(mysqli_num_rows($query_run) > 0)
                        {
                            foreach($query_run as $university)
                            {
                                ?>
                                <tr>
                                    <td><?= $university['id']; ?></td>
                                    <td><?= $university['name']; ?></td>
                                    <td><?= $university['address']; ?></td>
                                    <td>
                                        <img src="../<?= $university['image']; ?>" alt="University Image" width="50" height="50">
                                    </td>
                                    <td class="text-center">
                                        <a href="university-edit.php?id=<?= $university['id']; ?>" class="btn btn-success btn-sm mb-1">Edit</a>
                                        <form action="code.php" method="POST" class="d-inline">
                                            <button type="submit" name="delete_university" value="<?=$university['id'];?>" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else
                        {
                            echo "<tr><td colspan='5' class='text-center'>No Record Found</td></tr>";
                        }
                    ?>
                </tbody>
            </table>

            </div>
        </div>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<?php include '../footer.php'; ?>
</body>
</html>
