<?php
    include_once('../inc/inc.funcs.php');
    unset($_SESSION['user_uid_login']);
    header('Location:index');
?>