<?php
session_start();
require '../db_conn/database.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Student Create</title>

    <style>
      .student-add-section {
        background-color: skyblue;
        padding: 20px;
        border-radius: 8px;
      }

      .mb-3 .form-label {
    color: black;
    text-align: left;
    display: block;  /* Ensure the label is on its own line */
    margin-bottom: 5px;  /* Optional: Add some space between the label and the input */
}

    </style>
  </head>
<body>

<?php include '../header.php'?>

<div class="container mt-5 student-add-section">
    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-primary">Student Add 
                        <a href="index.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Update form for image upload -->
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Course</label>
                            <input type="text" name="course" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Birth Date</label>
                            <input type="date" name="birth" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="" disabled selected>Select Status</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Graduated">Graduated</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select" required>
                                <option value="" disabled selected>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">University</label>
                            <select name="university_id" class="form-select" required>
                                <option value="" disabled selected>Select University</option>
                                <?php
                                $query = "SELECT id, name FROM universities";
                                $result = mysqli_query($link, $query);

                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['name']) . '</option>';
                                    }
                                } else {
                                    echo '<option value="" disabled>No Universities Found</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <!-- File input for image upload -->
                        <div class="mb-3">
                            <label class="form-label">Upload Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <button type="submit" name="save_student" class="btn btn-primary">Save Student</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<?php include '../footer.php'?>
</body>
</html>
