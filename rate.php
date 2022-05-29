<?php
    $conn = new mysqli('localhost', 'root', '', 'db_ecommerce');

    if (isset($_POST['save'])) {
        $uID = $conn->real_escape_string($_POST['uID']);
        $ratedIndex = $conn->real_escape_string($_POST['ratedIndex']);
        $proid = $conn->real_escape_string($_POST['proid']);
        $ratedIndex++;

        if (!$uID) {
            $conn->query("INSERT INTO ratings (`PROID`,`rateIndex`) VALUES ('$proid','$ratedIndex')");
            $sql = $conn->query("SELECT iders FROM ratings ORDER BY iders DESC LIMIT 1");
            $uData = $sql->fetch_assoc();
            $uID = $uData['iders'];
        } else
            $conn->query("UPDATE ratings SET rateIndex='$ratedIndex' WHERE iders='$uID'");

        exit(json_encode(array('iders' => $uID)));
    }

    $sql = $conn->query("SELECT iders FROM ratings WHERE PROID='$proid'");
    $numR = $sql->num_rows;

    $sql = $conn->query("SELECT SUM(rateIndex) AS total FROM ratings WHERE PROID='$proid'");
    $rData = $sql->fetch_array();
    $total = $rData['total'];

    $avg = $total / $numR;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rating System</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>


    <script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>

</body>
</html>