<?php include('view/admin_header.php'); ?>
    <nav>
        <ul class="navbar">
            <li><a href="admin.php?action=list_vehicles">View Vehicles</a></li>
            <li><a href="admin.php?action=show_add_form">Add Vehicle</a></li>
            <li><a href="make.php?action=list_makes">Edit Makes</a></li>
            <li><a href="type.php?action=list_types">Edit Types</a></li>
            <li><a href="class.php?action=list_classes">Edit Classes</a></li>
        </ul>
    </nav>

<div class="main error">
    <h1>Oops! Something went wrong</h1>
    <p><?php echo $error; ?></p>
</div>
<?php include('view/footer.php'); ?>
