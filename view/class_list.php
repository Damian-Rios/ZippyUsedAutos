<?php include('view/admin_header.php'); ?>

<main>
    <nav>
        <ul class="navbar">
            <li><a href="admin.php?action=list_vehicles">View Vehicles</a></li>
            <li><a href="admin.php?action=show_add_form">Add Vehicle</a></li>
            <li><a href="make.php?action=list_makes">Edit Makes</a></li>
            <li><a href="type.php?action=list_types">Edit Types</a></li>
        </ul>
    </nav>
    <section class="main table-container">
        <h1>Vehicle Class List</h1>

    <?php if (!empty($classes)) : ?>
        <table>
            <tr>
                <th>Name</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($classes as $class) : ?>
            <tr>
                <td><?php echo $class['className']; ?></td>
                <td>
                    <form action="class.php" method="post">
                        <input type="hidden" name="action" value="delete_class" />
                        <input type="hidden" name="class_id" value="<?php echo $class['classID']; ?>"/>
                        <button class="remove-button" type="submit">Remove</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>No Classes Exist Yet</p>
    <?php endif; ?>
    </section>

    <section class="main add-form">
        <h1>Add Vehicle Class</h1>
        <form id="add_class_form" action="class.php" method="post">
            <input type="hidden" name="action" value="add_class" />
            <label>Name:</label>
            <input type="text" name="class_name" required/>
            <button class="button" type="submit">Add Class</button>
        </form>
    </section>
</main>

<?php include('view/footer.php'); ?>
