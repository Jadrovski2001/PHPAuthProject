<?php
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://universities.hipolabs.com/search?country=United+States',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);

// Decode the JSON response
$data = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University List</title>
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            color: #343a40;
        }

        .table-container {
            width: 90%;
            margin: 0 auto;
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead tr {
            background-color: #007bff;
            color: #fff;
            text-align: left;
        }

        .table th, .table td {
            padding: 12px 15px;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tbody tr:hover {
            background-color: #ddd;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>University List</h1>
    <div class="table-container">
        <table id="universityTable" class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Website</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the data and populate the table
                foreach ($data as $university) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($university['name']) . '</td>';
                    echo '<td>' . htmlspecialchars($university['country']) . '</td>';
                    echo '<td><a href="' . htmlspecialchars($university['web_pages'][0]) . '" target="_blank">' . htmlspecialchars($university['web_pages'][0]) . '</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#universityTable').DataTable();
        });
    </script>
</body>
</html>
