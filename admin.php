<?php
require('model/database.php');
require('model/vehicles_db.php');
require('model/class_db.php');
require('model/make_db.php');
require('model/type_db.php');

$vehicle_year = filter_input(INPUT_POST, 'vehicle_year', FILTER_SANITIZE_NUMBER_INT);
$vehicle_price = filter_input(INPUT_POST, 'vehicle_price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$vehicle_model = filter_input(INPUT_POST, 'vehicle_model', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$sort_order = filter_input(INPUT_GET, 'sort_order', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_VALIDATE_INT);
    if (!$vehicle_id) {
        $vehicle_id = filter_input(INPUT_GET, 'vehicle_id', FILTER_VALIDATE_INT);
    }

$class_id = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);
if (!$class_id) {
    $class_id = filter_input(INPUT_GET, 'class_id', FILTER_VALIDATE_INT);
}

$make_id = filter_input(INPUT_POST, 'make_id', FILTER_VALIDATE_INT);
if (!$make_id) {
    $make_id = filter_input(INPUT_GET, 'make_id', FILTER_VALIDATE_INT);
}

$type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);
if (!$type_id) {
    $type_id = filter_input(INPUT_GET, 'type_id', FILTER_VALIDATE_INT);
}

$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW);
    if ($action == NULL) {
        $action = 'list_vehicles';
    }
}

switch ($action) {
    case 'list_vehicles':
        if ($sort_order !== 'price_desc' && $sort_order !== 'year_desc') {
            $sort_order = 'price_desc';
        }

        $class_id = ($class_id === false || $class_id === null || $class_id == "all") ? null : $class_id;
        $make_id = ($make_id === false || $make_id === null || $make_id == "all") ? null : $make_id;
        $type_id = ($type_id === false || $type_id === null || $type_id == "all") ? null : $type_id;

        $class_name = ($class_id !== null) ? get_class_name($class_id) : null;
        $make_name = ($make_id !== null) ? get_make_name($make_id) : null;
        $type_name = ($type_id !== null) ? get_type_name($type_id) : null;

        $classes = list_classes();
        $makes = list_makes();
        $types = list_types();
        $vehicles = list_vehicles($make_id, $type_id, $class_id, $sort_order);

        include('view/admin_vehicle_list.php');
        break;

    case 'show_add_form':
        $classes = list_classes();
        $makes = list_makes();
        $types = list_types();
        include('view/vehicle_add.php');
        break;

    case 'add_vehicle':
        if ($class_id == NULL || $class_id == FALSE 
            || $make_id == NULL || $make_id == FALSE 
            ||$type_id == NULL || $type_id == FALSE 
            ||$vehicle_year == NULL || $vehicle_price == NULL || $vehicle_model == NULL) {
                $error = "Invalid vehicle data. Check all fields and try again.";
                include('view/error.php');
        } else {
            add_vehicle($make_id, $type_id, $class_id, $vehicle_year, $vehicle_price, $vehicle_model);
            header("Location: admin.php?action=list_vehicles");
        }
        break;

    case 'delete_vehicle':
        if ($vehicle_id) {
            delete_vehicle($vehicle_id);
            header("Location: admin.php?action=list_vehicles");
            exit();
        } else {
            $error = "Missing or incorrect vehicle ID.";
            include('view/error.php');
        }
        break;

    default:
        $error = "";
        include('view/error.php');
        break;
}
?>
