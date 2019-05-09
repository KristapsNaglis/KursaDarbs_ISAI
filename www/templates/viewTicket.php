<?php include "partials/head.php" ?>
<?php include "partials/nav.php" ?>

    <h1 style="width: 75%;"><?php echo htmlspecialchars( $results['tickets']->title )?></h1>
    <h2 style="width: 75%;"><?php echo $results['tickets']->price?> €</h2>
    <div style="width: 75%; font-style: italic;"><?php echo htmlspecialchars( $results['tickets']->description )?></div>
    <p class="dateOfEvent">Pasākums norisināsies <?php echo date('j F Y', $results['tickets']->dateOfEvent)?></p>

    <p><a href="./">Return to Homepage</a></p>

<?php include "partials/footer.php" ?>