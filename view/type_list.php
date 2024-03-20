<?php include('view/admin_header.php'); ?>

<main>
    <nav>
        <ul class="navbar">
            <li><a href="admin.php?action=list_vehicles">View Vehicles</a></li>
            <li><a href="admin.php?action=show_add_form">Add Vehicle</a></li>
            <li><a href="make.php?action=list_makes">Edit Makes</a></li>
            <li><a href="class.php?action=list_classes">Edit Classes</a></li>
        </ul>
    </nav>
    <section class="main table-container">
        <h1>Vehicle Type List</h1>

    <?php if (!empty($types)) : ?>
        <table>
            <tr>
                <th>Name</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($types as $type) : ?>
            <tr>
                <td><?php echo $type['typeName']; ?></td>
                <td>
                    <form action="type.php" method="post">
                        <input type="hidden" name="action" value="delete_type" />
                        <input type="hidden" name="type_id" value="<?php echo $type['typeID']; ?>"/>
                        <button class="remove-button" type="submit">Remove</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </section>
    <?php else : ?>
        <p>No Types Exist Yet</p>
    <?php endif; ?>

    <section class="main">
        <h1>Add Vehicle Type</h1>
        <form id="add_type_form" action="type.php" method="post" class="add-form">
            <input type="hidden" name="action" value="add_type" />
            <label>Name:</label>
            <input type="text" name="type_name" required/>
            <button class="button" type="submit">Add Type</button>
        </form>
    </section>
</main>

<?php include('view/footer.php'); ?>