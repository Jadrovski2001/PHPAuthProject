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

    <title>Student CRUD</title>
</head>

<style>
        .card-header h4 {
            color: blue; 
            text-align: left;
        }
    </style>


<body>
<?php include '../header.php'; ?>
<div class="container mt-4">

<?php include('message.php'); ?>

<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h4>All Students
                    <a href="student-create.php" class="btn btn-primary float-end">Add Students</a>
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                <?php 
                    $query = "SELECT * FROM students";
                    $query_run = mysqli_query($link, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        foreach ($query_run as $student) {
                            ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 text-center">
                                    <div class="card-body">
                                    <img src="<?= file_exists('../' . $student['image']) && !empty($student['image']) ? '../' . htmlspecialchars($student['image']) : '../uploads/default-image.jpg'; ?>" 
                                alt="Student Image" 
                                class="img-fluid rounded-circle mb-3" 
                                style="width: 100px; height: 100px; object-fit: cover;">

                                        
                                        <h5><?= htmlspecialchars($student['name']) ?></h5>
                                        <p class="text-muted small mb-1"><b>Email:</b> <?= htmlspecialchars($student['email']) ?></p>
                                        <p class="text-muted small mb-1"><b>Phone:</b> <?= htmlspecialchars($student['phone']) ?></p>
                                        <p class="text-muted small mb-1"><b>Course:</b> <?= htmlspecialchars($student['course']) ?></p>
                                    </div>
                                    <div class="card-footer d-flex justify-content-center">
                                     <a href="student-view.php?id=<?= $student['id'] ?>" class="btn btn-primary btn-sm me-2">
                                    <i class="fas fa-eye"></i> 
                                     </a>
                                    <a href="student-edit.php?id=<?= $student['id'] ?>" class="btn btn-warning btn-sm me-2">
                                    <i class="fas fa-pencil-alt"></i> 
                                    </a>
                                    <form action="code.php" method="POST" class="d-inline">
                                    <button type="submit" name="delete_student" value="<?= $student['id'] ?>" class="btn btn-danger btn-sm">
                                  <i class="fas fa-trash"></i> 
                                        </button>
                                    </form>
                                </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<p>No records found.</p>";
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<?php include '../footer.php'; ?>
</body>
</html>
