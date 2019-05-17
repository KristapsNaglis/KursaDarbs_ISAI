<?php include("templates/partials/head.php") ?>
<?php include("templates/partials/nav.php") ?>

<!--Main content-->
<h2>Register</h2>

<form action="user.php?action=register" method="post" style="width: 50%;">
    <input type="hidden" name="register" value="true"/>

    <?php if (isset($results['errorMessage'])) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
    <?php } ?>

    <ul>

        <li>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Your username" required autofocus
                   maxlength="20"/>
        </li>

        <li>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="Your email" required maxlength="20"/>
        </li>

        <li>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Your password" required maxlength="20"/>
        </li>

    </ul>

    <div class="buttons">
        <input type="submit" name="register" value="Register"/>
    </div>

</form>

<?php include("templates/partials/footer.php") ?>

