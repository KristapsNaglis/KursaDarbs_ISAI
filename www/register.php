<?php include("templates/partials/head.php") ?>
<?php include("templates/partials/nav.php") ?>

<!--Main content-->
<h2>Register</h2>
<form method="POST" action="#">

    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email Address" required>
    <input type="password" name="password" placeholder="Password" required>

    <button type="submit">Register</button>

</form>

<?php include("templates/partials/footer.php") ?>

