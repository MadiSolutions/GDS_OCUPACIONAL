<?php
    session_start();

    session_destroy();

    header("location: login.php");
    exit();
?>

<img src="images/clinica.jpg" class="img-circle elevation-2" alt="User Image">   