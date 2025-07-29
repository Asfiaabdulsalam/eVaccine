
<?php
function pr($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function prx($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    die();
}

function safe_input($data) {
    global $conn; // relies on the $conn from inc.connection.php
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($conn, $data);
    return $data;
}   
?>


