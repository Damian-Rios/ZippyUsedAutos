<?php
require('model/database.php');
require('model/type_db.php');

$type_name = filter_input(INPUT_POST, 'type_name', FILTER_SANITIZE_SPECIAL_CHARS);

$type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);
if (!$type_id) {
    $type_id = filter_input(INPUT_GET, 'type_id', FILTER_VALIDATE_INT);
}

$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW);
    if ($action == NULL) {
        $action = 'list_types';
    }
}

switch ($action) {
    case 'list_types':
        $types = list_types();
        include('view/type_list.php');
        break;

    case 'add_type':
        if ($type_name == NULL) {
            $error = "Invalid type name. Check name and try again.";
            include('view/error.php');
        } else {
            add_type($type_name);
            header('Location: type.php?action=list_types');
        }
        break;

    case 'delete_type':
        if ($type_id == NULL) {
            $error = "Invalid type ID. Check ID and try again.";
            include('view/error.php');
        } else {
            if (is_referenced_type($type_id)) {
                $error = "Cannot delete this type because it is referenced in another table.";
                include('view/error.php');
            } else {
                delete_type($type_id);
                header('Location: type.php?action=list_types');
            }
        }
        break;

    default:
        $error = "";
        include('view/error.php');
        break;
}
?>