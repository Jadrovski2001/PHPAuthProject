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

    <title>University Edit</title>
</head>
<body>
<?php include '../header.php'?>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>University Edit 
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id']))
                        {
                            $university_id = mysqli_real_escape_string($link, $_GET['id']);
                            $query = "SELECT * FROM universities WHERE id='$university_id' ";
                            $query_run = mysqli_query($link, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $university = mysqli_fetch_array($query_run);
                                ?>
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="university_id" value="<?= $university['id']; ?>">

                                    <div class="mb-3">
                                        <label>University Name</label>
                                        <input type="text" name="name" value="<?=$university['name'];?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Address</label>
                                        <input type="text" name="address" value="<?= $university['address']; ?>" class="form-control">
                                    </div>
                                   
                                      <!-- Student Image -->
                                    <div class="mb-3">
                                        <img src="../<?= $university['image']; ?>" alt="University Image" width="50" height="50">
                                        <label class="form-label text-black" style="text-align: left; display: block;">University Image</label>
                                        <input type="file" id="image" name="image" class="form-control">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <button type="submit" name="update_university" class="btn btn-primary">
                                            Update University
                                        </button>
                                    </div>

                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php include '../footer.php'?>
</body>
</html>