<?php
session_start();
require '../db_conn/database.php';

if(isset($_POST['delete_student']))
{
    $student_id = mysqli_real_escape_string($link, $_POST['delete_student']);

    $query = "DELETE FROM students WHERE id='$student_id' ";
    $query_run = mysqli_query($link, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Deleted Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Deleted";
        header("Location: index.php");
        exit(0);
    }
}



// Save Student
if (isset($_POST['save_student'])) {
    require '../db_conn/database.php';

    // Input sanitization
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $phone = mysqli_real_escape_string($link, $_POST['phone']);
    $course = mysqli_real_escape_string($link, $_POST['course']);
    $address = mysqli_real_escape_string($link, $_POST['address']);
    $birth = mysqli_real_escape_string($link, $_POST['birth']);
    $university_id = mysqli_real_escape_string($link, $_POST['university_id']);

    // Validate gender and status
    $allowed_genders = ['Male', 'Female', 'Other'];
    $allowed_statuses = ['Active', 'Inactive', 'Graduated'];
    $gender = in_array($_POST['gender'], $allowed_genders) ? $_POST['gender'] : 'Other';
    $status = in_array($_POST['status'], $allowed_statuses) ? $_POST['status'] : 'Active';

    // Handle image upload
    $imagePath = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = time() . '_' . $_FILES['image']['name'];
        $filePath = '../uploads/' . $fileName;
        
        // Validate file type
        $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($fileTmpPath);
        if (!in_array($fileType, $allowedFileTypes)) {
            $_SESSION['message'] = "Invalid file type. Only JPG, PNG, and GIF are allowed.";
            header("Location: student-create.php");
            exit(0);
        }

        // Validate file size (max 5MB)
        $maxFileSize = 5 * 1024 * 1024;
        if ($_FILES['image']['size'] > $maxFileSize) {
            $_SESSION['message'] = "File size exceeds the maximum limit of 5MB.";
            header("Location: student-create.php");
            exit(0);
        }

        // Create uploads directory if not exists
        if (!file_exists('../uploads')) {
            mkdir('../uploads', 0777, true);
        }

        // Move the file
        if (move_uploaded_file($fileTmpPath, $filePath)) {
            $imagePath = 'uploads/' . $fileName; // Save relative path for database
        } else {
            $_SESSION['message'] = "Image Upload Failed.";
            header("Location: student-create.php");
            exit(0);
        }
    }

    // Insert into database
    $query = "INSERT INTO students (name, email, phone, course, address, birth, gender, status, image, university_id) 
              VALUES ('$name', '$email', '$phone', '$course', '$address', '$birth', '$gender', '$status', '$imagePath', '$university_id')";

    if (mysqli_query($link, $query)) {
        $_SESSION['message'] = "Student Created Successfully";
        header("Location: student-create.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Student Not Created: " . mysqli_error($link);
        header("Location: student-create.php");
        exit(0);
    }
}













// Update student
if (isset($_POST['update_student'])) {
    $student_id = mysqli_real_escape_string($link, $_POST['student_id']);
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $phone = mysqli_real_escape_string($link, $_POST['phone']);
    $course = mysqli_real_escape_string($link, $_POST['course']);
    $address = mysqli_real_escape_string($link, $_POST['address']);
    $birth = mysqli_real_escape_string($link, $_POST['birth']);
    $university_id = mysqli_real_escape_string($link, $_POST['university_id']);

    // Validate gender and status against allowed ENUM values
    $allowed_genders = ['Male', 'Female', 'Other'];
    $allowed_status = ['Active', 'Inactive', 'Graduated'];

    $gender = in_array($_POST['gender'], $allowed_genders) ? $_POST['gender'] : 'Other';
    $status = in_array($_POST['status'], $allowed_status) ? $_POST['status'] : 'Active';

    // Handle image upload
    $imagePath = ''; // Initialize image path variable

    // Check if a new image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        // Temporary file and file name
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = time() . '_' . $_FILES['image']['name'];
        $filePath = '../uploads/' . $fileName;  // Correct path relative to project folder
        
        // Allowed file types
        $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($fileTmpPath);

        // Check if file type is valid
        if (!in_array($fileType, $allowedFileTypes)) {
            $_SESSION['message'] = "Invalid file type. Only JPG, PNG, and GIF are allowed.";
            header("Location: student-edit.php?id=$student_id");
            exit(0);
        }

        // Check file size (max 5MB)
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        if ($_FILES['image']['size'] > $maxFileSize) {
            $_SESSION['message'] = "File size exceeds the maximum limit of 5MB.";
            header("Location: student-edit.php?id=$student_id");
            exit(0);
        }

        // Create the uploads directory if it doesn't exist
        if (!file_exists('../uploads')) {
            mkdir('../uploads', 0777, true);
        }

        // Delete the old image if it's being replaced
        $query = "SELECT image FROM students WHERE id='$student_id'";
        $result = mysqli_query($link, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $existing_student = mysqli_fetch_assoc($result);
            if (!empty($existing_student['image']) && file_exists($existing_student['image'])) {
                unlink($existing_student['image']); // Deletes the old image file
            }
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($fileTmpPath, $filePath)) {
            $imagePath = 'uploads/' . $fileName;  // Save relative path for database
        } else {
            $_SESSION['message'] = "Image Upload Failed.";
            header("Location: student-edit.php?id=$student_id");
            exit(0);
        }
    } else {
        // Retain the existing image if no new image is uploaded
        $query = "SELECT image FROM students WHERE id='$student_id'";
        $result = mysqli_query($link, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $existing_student = mysqli_fetch_assoc($result);
            $imagePath = $existing_student['image']; // Retain the old image
        } else {
            $_SESSION['message'] = "Failed to retrieve existing image.";
            header("Location: student-edit.php?id=$student_id");
            exit(0);
        }
    }

    // Update student data in the database
    $query = "UPDATE students 
              SET name='$name', email='$email', phone='$phone', course='$course', 
                  address='$address', birth='$birth', gender='$gender', status='$status', university_id='$university_id', image='$imagePath' 
              WHERE id='$student_id'";

    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $_SESSION['message'] = "Student Updated Successfully";
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Student Not Updated. Please try again.";
        header("Location: student-edit.php?id=$student_id");
        exit(0);
    }
}
?>