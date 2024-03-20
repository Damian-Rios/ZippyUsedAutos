<?php
    $dsn = 'mysql:host=h40lg7qyub2umdvb.cbetxkdyhwsb.us-east-1.rds.amazonaws.com; port=3306; dbname=z0rexwkvop4b28m8';
    $username = 'uz3yp52igo86x3gn';
    $password = 'h98vbat1ul4gqflm';

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
