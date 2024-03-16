<?php
function list_types() {
    global $db;
    $query = 'SELECT * FROM type
              ORDER BY typeID';
    $statement = $db->prepare($query);
    $statement->execute();
    
    $types = $statement->fetchAll();
    $statement->closeCursor();
    return $types; 
}

function get_type_name($type_id) {
    global $db;
    $type_name = '';
    $query = 'SELECT * FROM type
              WHERE typeID = :type_id';    
    $statement = $db->prepare($query);
    $statement->bindValue(':type_id', $type_id);
    $statement->execute();    
    $types = $statement->fetch();
    $statement->closeCursor(); 
    if(is_array($types)){   
        $type_name = $types['typeName'];
    }
    return $type_name;
}

function add_type($type_name) {
    global $db;
    $query = 'INSERT INTO type (typeName)
              VALUES (:type_name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':type_name', $type_name);
    $statement->execute();
    $statement->closeCursor();    
}

function delete_type($type_id) {
    global $db;
    $query = 'DELETE FROM type
              WHERE typeID = :type_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':type_id', $type_id);
    $statement->execute();
    $statement->closeCursor();
}
?>