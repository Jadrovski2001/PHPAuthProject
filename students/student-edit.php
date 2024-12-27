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

    <title>Student Edit</title>

    <style>
    .mb-3 label {
    color: blue;
    text-align: left;
    display: block; 
    margin-bottom: 5px;  
         }

         .card-header h4{
            color:blue;
            text-align:left;
         }
        </style>
         
</head>
<body>
<?php include '../header.php' ?>

<div class="container mt-5">

    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Student Edit 
                        <a href="index.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php
                    if (isset($_GET['id'])) {
                        $student_id = mysqli_real_escape_string($link, $_GET['id']);
                        $query = "SELECT * FROM students WHERE id='$student_id'";
                        $query_run = mysqli_query($link, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            $student = mysqli_fetch_array($query_run);
                            ?>
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="student_id" value="<?= $student['id']; ?>">

                                

                                <!-- Name -->
                                <div class="mb-3">
                                    <label>Student Name</label>
                                    <input type="text" name="name" value="<?= htmlspecialchars($student['name']); ?>" class="form-control" required>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label>Student Email</label>
                                    <input type="email" name="email" value="<?= htmlspecialchars($student['email']); ?>" class="form-control" required>
                                </div>

                                <!-- Phone -->
                                <div class="mb-3">
                                    <label>Student Phone</label>
                                    <input type="text" name="phone" value="<?= htmlspecialchars($student['phone']); ?>" class="form-control" required>
                                </div>

                                <!-- Address -->
                                <div class="mb-3">
                                    <label>Student Address</label>
                                    <input type="text" name="address" value="<?= htmlspecialchars($student['address']); ?>" class="form-control" required>
                                </div>

                                <!-- Course -->
                                <div class="mb-3">
                                    <label>Student Course</label>
                                    <input type="text" name="course" value="<?= htmlspecialchars($student['course']); ?>" class="form-control" required>
                                </div>

                                <!-- Birth Date -->
                                <div class="mb-3">
                                    <label>Birth Date</label>
                                    <input type="date" name="birth" value="<?= htmlspecialchars($student['birth']); ?>" class="form-control" required>
                                </div>

                                  <div class="mb-3">
                                <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                    <option value="" disabled>Select Status</option>
                    <option value="Active" <?= $student['status'] == 'Active' ? 'selected' : ''; ?>>Active</option>
                    <option value="Inactive" <?= $student['status'] == 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
                    <option value="Graduated" <?= $student['status'] == 'Graduated' ? 'selected' : ''; ?>>Graduated</option>
                </select>
            </div>



                                <!-- Gender -->
                                <div class="mb-3">
                                    <label>Gender</label>
                                    <select name="gender" class="form-select" required>
                                        <option value="Male" <?= $student['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                                        <option value="Female" <?= $student['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                                        <option value="Other" <?= $student['gender'] == 'Other' ? 'selected' : ''; ?>>Other</option>
                                    </select>
                                </div>

                                <!-- University -->
                                <div class="mb-3">
                                    <label>University</label>
                                    <select name="university_id" class="form-select" required>
                                        <?php
                                        $uni_query = "SELECT id, name FROM universities";
                                        $uni_result = mysqli_query($link, $uni_query);

                                        if (mysqli_num_rows($uni_result) > 0) {
                                            while ($uni = mysqli_fetch_assoc($uni_result)) {
                                                $selected = $student['university_id'] == $uni['id'] ? 'selected' : '';
                                                echo "<option value='{$uni['id']}' $selected>" . htmlspecialchars($uni['name']) . "</option>";
                                            }
                                        } else {
                                            echo '<option value="" disabled>No Universities Found</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Current Image -->
                                <div class="mb-3">
                                    <label>Current Image</label>
                                    <?php if (!empty($student['image']) && file_exists($student['image'])): ?>
                                        <div>
                                            <img src="<?= htmlspecialchars($student['image']); ?>" alt="Student Image" width="150">
                                        </div>
                                    <?php else: ?>
                                        <p>No Image Uploaded</p>
                                    <?php endif; ?>
                                </div>

                                <!-- New Image Upload -->
                                <div class="mb-3">
                                    <label>Upload New Image</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                </div>

                                <!-- Submit Button -->
                                <div class="mb-3">
                                    <button type="submit" name="update_student" class="btn btn-primary">Update Student</button>
                                </div>
                            </form>
                            <?php
                        } else {
                            echo "<h4>No Such Student Found</h4>";
                        }
                    } else {
                        echo "<h4>No ID Provided</h4>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<?php include '../footer.php' ?>
</body>
</html>
