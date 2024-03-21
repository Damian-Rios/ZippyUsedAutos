<?php include('view/admin_header.php'); ?>
<main>
    <nav>
        <ul class="navbar">
            <li><a href="admin.php?action=list_vehicles">View Vehicles</a></li>
            <li><a href="class.php?action=list_classes">Edit Classes</a></li>
            <li><a href="make.php?action=list_makes">Edit Makes</a></li>
            <li><a href="type.php?action=list_types">Edit Types</a></li>
        </ul>
    </nav>
    <section class="main add-vehicle-form">
        <h1>Add Vehicle</h1>

        <form action="admin.php" method="post" id="add_vehicle_form" class="options">
            <input type="hidden" name="action" value="add_vehicle">

            <label>Make:</label>
            <select name="make_id">
            <?php foreach ( $makes as $make ) : ?>
                <option value="<?php echo $make['makeID']; ?>">
                    <?php echo $make['makeName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>

            <label>Type:</label>
            <select name="type_id">
            <?php foreach ( $types as $type ) : ?>
                <option value="<?php echo $type['typeID']; ?>">
                    <?php echo $type['typeName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>

            <label>Class:</label>
            <select name="class_id">
            <?php foreach ( $classes as $class ) : ?>
                <option value="<?php echo $class['classID']; ?>">
                    <?php echo $class['className']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>

            <label>Year:</label>
            <input type="text" name="vehicle_year" required/>
            <br>

            <label>Model:</label>
            <input type="text" name="vehicle_model" required/>
            <br>

            <label>Price:</label>
            <?php $formatted_price = '$' . number_format((float) $vehicle_price, 2);?>
            <input type="text" name="vehicle_price" value="<?php echo $formatted_price; ?>" required/>
            <br>

            <label>&nbsp;</label>
            <button class="button" type="submit" name="action" value="add_vehicle">Add Vehicle</button>
            <br>
        </form>
    </section>
</main>
<?php include('view/footer.php'); ?>
