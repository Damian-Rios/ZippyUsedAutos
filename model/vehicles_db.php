<?php 

function list_vehicles($make_id, $type_id, $class_id, $sort_order) {
    global $db;

    if(!$make_id && !$type_id && !$class_id){
        $query = 'SELECT * FROM vehicles';
    } else {
        if($make_id){
            $query = 'SELECT * FROM vehicles
                    WHERE vehicles.makeID = :make_id';
        } elseif($type_id) {
            $query = 'SELECT * FROM vehicles
                    WHERE vehicles.typeID = :type_id';
        } elseif($class_id) {
            $query = 'SELECT * FROM vehicles
                    WHERE vehicles.classID = :class_id';
        }
    }

    switch ($sort_order) {
        case 'price_desc':
            $query .= ' ORDER BY Price DESC';
            break;
        case 'year_desc':
            $query .= ' ORDER BY Year DESC';
            break;
        default:
            $query .= ' ORDER BY Price DESC';
            break;
    }

    $statement = $db->prepare($query);

    if ($make_id) {
        $statement->bindValue(':make_id', $make_id);
    } elseif ($type_id) {
        $statement->bindValue(':type_id', $type_id);
    } elseif ($class_id) {
        $statement->bindValue(':class_id', $class_id);
    }

    $statement->execute();
    $vehicles = $statement->fetchAll();
    $statement->closeCursor();
    return $vehicles;
}

function delete_vehicle($vehicle_id) {
    global $db;
    $query = 'DELETE FROM vehicles
              WHERE vehicleID = :vehicle_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':vehicle_id', $vehicle_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_vehicle($make_id, $type_id, $class_id, $year, $price, $model) {
    global $db;
    $query = 'INSERT INTO vehicles (makeID, typeID, classID, Year, Price, Model) 
            VALUES (:make_id, :type_id, :class_id, :year, :price, :model)';

    $statement = $db->prepare($query);

    $statement->bindValue(':make_id', $make_id);
    $statement->bindValue(':type_id', $type_id);
    $statement->bindValue(':class_id', $class_id);
    $statement->bindValue(':year', $year);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':model', $model);

    $statement->execute();
    $statement->closeCursor();
}
?>
