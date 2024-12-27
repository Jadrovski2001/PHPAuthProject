<?php
session_start();
require '../db_conn/database.php';

if (isset($_POST['delete_university'])) {
    $university_id = mysqli_real_escape_string($link, $_POST['delete_university']);

    $query = "DELETE FROM universities WHERE id='$university_id' ";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $_SESSION['message'] = "University Deleted Successfully";
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['message'] = "University Not Deleted";
        header("Location: index.php");
        exit(0);
    }
}

if (isset($_POST['update_university'])) {
    $university_id = mysqli_real_escape_string($link, $_POST['university_id']);

    $name = mysqli_real_escape_string($link, $_POST['name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $phone = mysqli_real_escape_string($link, $_POST['phone']);
    $address = mysqli_real_escape_string($link, $_POST['address']);
   // $image = mysqli_real_escape_string($link, $_POST['image']);

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
              header("Location: university-edit.php?id=$university_id");
              exit(0);
          }
  
          // Check file size (max 5MB)
          $maxFileSize = 5 * 1024 * 1024; // 5MB
          if ($_FILES['image']['size'] > $maxFileSize) {
              $_SESSION['message'] = "File size exceeds the maximum limit of 5MB.";
              header("Location: university-edit.php?id=$university_id");
              exit(0);
          }
  
          // Create the uploads directory if it doesn't exist
          if (!file_exists('../uploads')) {
              mkdir('../uploads', 0777, true);
          }
  
          // Delete the old image if it's being replaced
          $query = "SELECT image FROM universities WHERE id='$university_id'";
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
              header("Location: university-edit.php?id=$university_id");
              exit(0);
          }
      } else {
          // Retain the existing image if no new image is uploaded
          $query = "SELECT image FROM students WHERE id='$university_id'";
          $result = mysqli_query($link, $query);
  
          if ($result && mysqli_num_rows($result) > 0) {
              $existing_student = mysqli_fetch_assoc($result);
              $imagePath = $existing_student['image']; // Retain the old image
          } else {
              $_SESSION['message'] = "Failed to retrieve existing image.";
              header("Location: university-edit.php?id=$university_id");
              exit(0);
          }
      }
  

    $query = "UPDATE universities SET name='$name', address='$address', image='$imagePath' WHERE id='$university_id' ";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $_SESSION['message'] = "University Updated Successfully";
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['message'] = "University Not Updated";
        header("Location: index.php");
        exit(0);
    }
}

if (isset($_POST['save_university'])) {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $address = mysqli_real_escape_string($link, $_POST['address']);
  

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
              header("Location: university-create.php");
              exit(0);
          }
  
          // Validate file size (max 5MB)
          $maxFileSize = 5 * 1024 * 1024;
          if ($_FILES['image']['size'] > $maxFileSize) {
              $_SESSION['message'] = "File size exceeds the maximum limit of 5MB.";
              header("Location: index.php");
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
              header("Location: index.php");
              exit(0);
          }
      }

    $query = "INSERT INTO universities (name, address, image) VALUES ('$name', '$address', '$imagePath')";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $_SESSION['message'] = "University Created Successfully";
        header("Location: university-create.php");
        exit(0);
    } else {
        $_SESSION['message'] = "University Not Created";
        header("Location: university-create.php");
        exit(0);
    }
}
?>
