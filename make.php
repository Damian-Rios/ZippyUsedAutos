<?php
require('model/database.php');
require('model/make_db.php');

$make_name = filter_input(INPUT_POST, 'make_name', FILTER_SANITIZE_SPECIAL_CHARS);

$make_id = filter_input(INPUT_POST, 'make_id', FILTER_VALIDATE_INT);
if (!$make_id) {
    $make_id = filter_input(INPUT_GET, 'make_id', FILTER_VALIDATE_INT);
}

$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW);
    if ($action == NULL) {
        $action = 'list_makes';
    }
}

switch ($action) {
    case 'list_makes':
        $makes = list_makes();
        include('view/make_list.php');
        break;

    case 'add_make':
        if ($make_name == NULL) {
            $error = "Invalid make name. Check name and try again.";
            include('view/error.php');
        } else {
            add_make($make_name);
            header('Location: make.php?action=list_makes');
        }
        break;

    case 'delete_make':
        if ($make_id == NULL) {
            $error = "Invalid make ID. Check ID and try again.";
            include('view/error.php');
        } else {
            if (is_referenced_make($make_id)) {
                $error = "Cannot delete this make because it is referenced in another table.";
                include('view/error.php');
            } else {
                delete_make($make_id);
                header('Location: make.php?action=list_makes');
            }
        }
        break;

    default:
        $error = "";
        include('view/error.php');
        break;
}
?>
