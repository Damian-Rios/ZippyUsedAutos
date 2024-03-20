<?php
function list_makes() {
    global $db;
    $query = 'SELECT * FROM make
              ORDER BY makeID';
    $statement = $db->prepare($query);
    $statement->execute();
    
    $makes = $statement->fetchAll();
    $statement->closeCursor();
    return $makes; 
}

function get_make_name($make_id) {
    global $db;
    $make_name = '';
    $query = 'SELECT * FROM make
              WHERE makeID = :make_id';    
    $statement = $db->prepare($query);
    $statement->bindValue(':make_id', $make_id);
    $statement->execute();    
    $makes = $statement->fetch();
    $statement->closeCursor(); 
    if(is_array($makes)){   
        $make_name = $makes['makeName'];
    }
    return $make_name;
}

function add_make($make_name) {
    global $db;
    $query = 'INSERT INTO make (makeName)
              VALUES (:make_name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':make_name', $make_name);
    $statement->execute();
    $statement->closeCursor();    
}

function delete_make($make_id) {
    global $db;
    $query = 'DELETE FROM make
              WHERE makeID = :make_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':make_id', $make_id);
    $statement->execute();
    $statement->closeCursor();
}

function is_referenced_make($make_id) {
    global $db;

    $query = 'SELECT COUNT(*) FROM vehicles
              WHERE makeID = :make_id';
    
    $statement = $db->prepare($query);
    $statement->bindValue(':make_id', $make_id);
    $statement->execute();
    
    $result = $statement->fetchColumn();
    $statement->closeCursor();

    return $result > 0;
}
?>