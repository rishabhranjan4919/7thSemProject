<?php
session_start();
error_reporting(0);
$dbUsername = "root";
$dbPassword = "";
$dbName = "7thsemprojectdatabase";
?>
<!doctype html>
<html>

<head>
    <title>Video Player</title>

    <!-- Meta tag start -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Meta tag end -->

    <!-- Bootstrap code start -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <!-- Bootstrap code end -->

    <!-- css start -->
    <style>
        /* Font import code start */
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Mono:wght@100;300;400&display=swap');
        /* Font import code end */

        * {
            font-family: 'Noto Sans Mono';
        }

        .alert-box {
            position: absolute;
            top: 5%;
            width: 96%;
            z-index: -1;
            margin-left: 2%;
        }

        video {
            border: 1px solid black;
            margin-left: 2%;
            margin-right: 2%;
            margin-top: 2%;
            height: 550px;
            max-width: 96%;
        }

        table {
            margin-left: 2%;
            margin-right: 2%;
            margin-top: 2%;
            max-width: 96%;
        }
    </style>
    <!-- css end -->
</head>

<body>
    <?php
    $slno = $_GET['slno'];
    try {   //Initiating database connnection
        $conn = new mysqli("localhost", $dbUsername, $dbPassword, $dbName);
    } catch (Exception $e) {
        echo '<div class="alert alert-danger alert-box" role="alert">Cannot connect to database. Error: ' . $conn->connect_error . '.</div>';
        exit(0);
    }
    $sql = "SELECT title, description, video FROM lecturelinks WHERE slno='$slno'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo '<video controls>
            <source src="' . $row['video'] . '" type="video/mp4">        
        </video>';
    echo '<table class="table">    
            <tbody>
                <tr>
                    <th scope="col">Title</th>
                    <td>' . $row['title'] . '</td>
                </tr> 
                <tr>
                    <th scope="row">Description</th>
                    <td>' . $row['description'] . '</td>
                </tr>      
            </tbody>
        </table>';
    $conn->close();     //Closing database connection
    ?>
</body>

</html>