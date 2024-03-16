<?php

require('model/database.php');
require('model/type_db.php');

$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW);
    if ($action == NULL) {
        $action = 'list_types';
    }
}

if($action == 'list_types') {
    $types = list_types();
    include('view/type_list.php');
}

else if($action == 'add_type') {
    $type_name = filter_input(INPUT_POST, 'type_name', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($type_name == NULL) {
        $error = "Invalid type name. Check name and try again.";
        include('view/error.php');
    } else {
        add_type($type_name);
        header('Location: type.php?action=list_types');
    }
}

else if($action == 'delete_type') {
    $type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);

    if ($type_id == NULL) {
        $error = "Invalid type id. Check id and try again.";
        include('view/error.php');
    } else {
        delete_type($type_id);
        header('Location: type.php?action=list_types');
    }
}
?>