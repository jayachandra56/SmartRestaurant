<?php
session_start();
echo "<script>alert(\"loged out successfully\")</script>";
echo "<script>window.location=\"index.php\"</script>";
unset($_SESSION['logged']);
session_destroy();

?>