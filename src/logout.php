<?php
header("location: ../public/pages/index.php");
setcookie("email", null, -1, '/');
setcookie("senha", null, -1, '/');
session_start();
session_destroy();

