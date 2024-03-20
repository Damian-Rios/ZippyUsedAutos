<?php
    $dsn = 'pgsql:host=user-prod-us-east-2-1.cluster-cfi5vnucvv3w.us-east-2.rds.amazonaws.com; port=5432; dbname=zippyusedautos-main-db-0962ebc610cabf136';
    $username = 'zippyusedautos-main-db-0962ebc610cabf136';
    $password = 'fXu1ae8TbdXP46wDbMnDkuQP3yrfK7';

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $error = "Database Error: ";
    $error .= $e->getMessage();
    $error .= " (Error Code: " . $e->getCode() . ", SQLSTATE: " . $e->errorInfo[0] . ")";
    include('view/error.php');
    exit();
}
?>
