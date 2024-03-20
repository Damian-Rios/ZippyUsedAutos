<?php
require('model/database.php');
require('model/class_db.php');

$class_name = filter_input(INPUT_POST, 'class_name', FILTER_SANITIZE_SPECIAL_CHARS);

$class_id = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);
if (!$class_id) {
    $class_id = filter_input(INPUT_GET, 'class_id', FILTER_VALIDATE_INT);
}

$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW);
    if ($action == NULL) {
        $action = 'list_classes';
    }
}

switch ($action) {
    case 'list_classes':
        $classes = list_classes();
        include('view/class_list.php');
        break;

    case 'add_class':
        if ($class_name == NULL) {
            $error = "Invalid class name. Check name and try again.";
            include('view/error.php');
        } else {
            add_class($class_name);
            header('Location: class.php?action=list_classes');
        }
        break;

    case 'delete_class':
        if ($class_id == NULL) {
            $error = "Invalid class ID. Check ID and try again.";
            include('view/error.php');
        } else {
            if (is_referenced_class($class_id)) {
                $error = "Cannot delete this class because it is referenced in another table.";
                include('view/error.php');
            } else {
                delete_class($class_id);
                header('Location: class.php?action=list_classes');
            }
        }
        break;

    default:
        $error = "";
        include('view/error.php');
        break;
}
?>
