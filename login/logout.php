<?php
include "../php/allinclude.php";
session_start();
if (isset($_SESSION['log_user'])) {
	unset($_SESSION['log_user']);
}
$userid = isset($_POST["userid"]) ? $_POST["userid"] : (isset($_GET["userid"]) ? $_GET["userid"] : 0);
header("Location: ../admin/?action=logout&userid=".$userid);

?>

