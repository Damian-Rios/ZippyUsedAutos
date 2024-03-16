<?php

require('model/database.php');
require('model/class_db.php');

$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW);
    if ($action == NULL) {
        $action = 'list_classes';
    }
}

if($action == 'list_classes') {
    $classes = list_classes();
    include('view/class_list.php');
}

else if($action == 'add_class') {
    $class_name = filter_input(INPUT_POST, 'class_name', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($class_name == NULL) {
        $error = "Invalid class name. Check name and try again.";
        include('view/error.php');
    } else {
        add_class($class_name);
        header('Location: class.php?action=list_classes');
    }
}

else if($action == 'delete_class') {
    $class_id = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);

    if ($class_id == NULL) {
        $error = "Invalid class id. Check id and try again.";
        include('view/error.php');
    } else {
        delete_class($class_id);
        header('Location: class.php?action=list_classes');
    }
}
?>