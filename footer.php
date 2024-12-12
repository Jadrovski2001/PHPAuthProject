<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer with Cards</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .dashboard {
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .card {
            text-align: center;
            padding: 20px;
            color: white;
            border-radius: 8px;
            width: 150px;
        }

        .card.students {
            background-color: #007bff;
        }

        .card.universities {
            background-color: #28a745;
        }

        .card.courses {
            background-color: #17a2b8;
        }

        footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
        }

        .footer-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .footer-section {
            margin: 10px;
        }

        .footer-section h3 {
            margin-bottom: 10px;
        }

        .footer-section a {
            display: block;
            color: #007bff;
            text-decoration: none;
            margin: 5px 0;
        }

        .footer-section a:hover {
            text-decoration: underline;
        }

        .footer-bottom {
            margin-top: 20px;
            font-size: 14px;
            color: #6c757d;
        }
    </style>
</head>
<body>

<footer>
    <div class="footer-container">
        <div class="footer-section">
            <h3>ABOUT US</h3>
            <p>Students is a platform for managing students and universities.</p>
        </div>
        <div class="footer-section">
            <h3>QUICK LINKS</h3>
            <a href="#">Home</a>
            <a href="#">Profile</a>
            <a href="#">Contact</a>
        </div>
        <div class="footer-section">
            <h3>FOLLOW US</h3>
            <a href="#">Facebook</a>
            <a href="#">Twitter</a>
            <a href="#">Instagram</a>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; 2024 Cosmic Development. All rights reserved.
    </div>
</footer>

</body>
</html>
