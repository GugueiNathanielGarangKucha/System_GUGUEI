<?php
session_start();
session_unset();
session_destroy();

// Use a proper PHP header redirect
header("Location: ../index.php");
exit(); // Ensure no further code is executed after the redirect
?>
