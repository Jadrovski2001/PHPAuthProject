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

    <title>University Create</title>

    <!-- Custom Styles -->
    <style>
      .university-add-section {
        background-color: skyblue; /* Sky blue background */
        padding: 20px;
        border-radius: 8px;
      }
    </style>
  </head>
<body>

<?php include '../header.php'?>

    <div class="container mt-5 university-add-section">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-primary">University Add 
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label class="form-label text-black" style="text-align: left; display: block;">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-black" style="text-align: left; display: block;">Address</label>
                                <input type="text" name="address" class="form-control">
                            </div>
                            Query so ke gi zemi site univeristi. i ke gi ispeactime so loop vo dropdown.
                            a kako value rakame university id koga zacuvuvame student

                   <!-- Student Image -->
                   <div class="mb-3">
           <label class="form-label text-black" style="text-align: left; display: block;">University Image</label>
           <input type="file" id="image" name="image" class="form-control">
             </div>

                          <!-- Submit Button -->
                            <div class="mb-3">
                                <button type="submit" name="save_university" class="btn btn-primary">Save University</button>
                            </div>
        
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php include '../footer.php'?>
    ;
</script>
</body>
</html>
