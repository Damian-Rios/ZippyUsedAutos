<?php

require('model/database.php');
require('model/make_db.php');

$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW);
    if ($action == NULL) {
        $action = 'list_makes';
    }
}

if($action == 'list_makes') {
    $makes = list_makes();
    include('view/make_list.php');
}

else if($action == 'add_make') {
    $make_name = filter_input(INPUT_POST, 'make_name', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($make_name == NULL) {
        $error = "Invalid make name. Check name and try again.";
        include('view/error.php');
    } else {
        add_make($make_name);
        header('Location: make.php?action=list_makes');
    }
}

else if($action == 'delete_make') {
    $make_id = filter_input(INPUT_POST, 'make_id', FILTER_VALIDATE_INT);

    if ($make_id == NULL) {
        $error = "Invalid make id. Check id and try again.";
        include('view/error.php');
    } else {
        delete_make($make_id);
        header('Location: make.php?action=list_makes');
    }
}
?>