<?php include('view/admin_header.php'); ?>

<main>
    <nav>
        <ul class="navbar">
            <li><a href="admin.php?action=list_vehicles">View Vehicles</a></li>
            <li><a href="admin.php?action=show_add_form">Add Vehicle</a></li>
            <li><a href="class.php?action=list_classes">Edit Classes</a></li>
            <li><a href="type.php?action=list_types">Edit Types</a></li>
        </ul>
    </nav>
    <section class="main table-container">
        <h1>Vehicle Make List</h1>

    <?php if (!empty($makes)) : ?>
        <table>
            <tr>
                <th>Name</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($makes as $make) : ?>
            <tr>
                <td><?php echo $make['makeName']; ?></td>
                <td>
                    <form action="make.php" method="post">
                        <input type="hidden" name="action" value="delete_make" />
                        <input type="hidden" name="make_id" value="<?php echo $make['makeID']; ?>"/>
                        <button class="remove-button" type="submit">Remove</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </section>
    <?php else : ?>
        <p class="main">No Makes Exist Yet</p>
    <?php endif; ?>

    <section class="main">
        <h1>Add Vehicle Make</h1>
        <form id="add_make_form" action="make.php" method="post" class="add-form">
            <input type="hidden" name="action" value="add_make" />
            <label>Name:</label>
            <input type="text" name="make_name" required/>
            <button class="button" type="submit">Add Make</button>
        </form>
    </section>
</main>
<?php include('view/footer.php'); ?>