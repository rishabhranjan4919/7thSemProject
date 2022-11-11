<?php
session_start();
error_reporting(0);
$dbUsername = "root";
$dbPassword = "";
$dbName = "7thsemprojectdatabase";
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Profile</title>

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

        img {
            float: right;
            height: 20%;
            width: 20%;
            margin-right: 2%;
            margin-top: 2%; 
        }

        table{
            float: left;
            margin-left: 2%;
            margin-top: 2%; 
            max-width: 40%;
        }
    </style>
    <!-- css end -->
</head>

<body>
    <!-- navbar start -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">App-Name</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <?php
                    $category = $_SESSION['category'];
                    if ($category == 0) {
                        echo '<a class="nav-link" href="teacherView.php">Back</a>';
                    } else if ($category == 1) {
                        echo '<a class="nav-link" href="studentView.php">Back</a>';
                    }
                    ?>
                </li>
            </ul>
        </div>
    </nav>
    <!-- navbar end -->

    <!-- profile start -->
    <?php
    $id = $_SESSION['id'];
    $category = $_SESSION['category'];    
    try {   //Initiate database connection
        $conn = new mysqli("localhost", "$dbUsername", "$dbPassword", "$dbName");
    } catch (Exception $e) {
        echo '<div class="alert alert-danger alert-box" role="alert">
                Cannot connect to database. Error: ' . $conn->connect_error . '
                .</div>';
        exit(0);
    }
    $sql = "SELECT name, email, image FROM userdetails WHERE id='$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo '<img src="'. $row['image'] .'" alt="Profile picture" />';    
    echo '<table class="table">
            <tbody><tr>
                <th scope="row">Name</th>
                <td>' . $row['name'] . '</td>
                </tr>
                <tr>
                <th scope="row">Id</th>
                <td>' . $id . '</td>
                </tr>  
                <tr>
                <th scope="row">Email</th>
                <td>' . $row['email'] . '</td>
                </tr>                
                </tbody>
            </table>';

    $conn->close();     //Closing connection
    ?>
    <!-- profile end -->
</body>

</html>