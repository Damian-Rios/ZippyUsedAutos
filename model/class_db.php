<?php
function list_classes() {
    global $db;
    $query = 'SELECT * FROM class
              ORDER BY classID';
    $statement = $db->prepare($query);
    $statement->execute();
    
    $classes = $statement->fetchAll();
    $statement->closeCursor();
    return $classes; 
}

function get_class_name($class_id) {
    global $db;
    $class_name = '';
    $query = 'SELECT * FROM class
              WHERE classID = :class_id';    
    $statement = $db->prepare($query);
    $statement->bindValue(':class_id', $class_id);
    $statement->execute();    
    $classes = $statement->fetch();
    $statement->closeCursor(); 
    if(is_array($classes)){   
        $class_name = $classes['className'];
    }
    return $class_name;
}

function add_class($class_name) {
    global $db;
    $query = 'INSERT INTO class (className)
              VALUES (:class_name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':class_name', $class_name);
    $statement->execute();
    $statement->closeCursor();    
}

function delete_class($class_id) {
    global $db;
    $query = 'DELETE FROM class
              WHERE classID = :class_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':class_id', $class_id);
    $statement->execute();
    $statement->closeCursor();
}
?>