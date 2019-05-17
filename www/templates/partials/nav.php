<?php
session_start();
?>
<!--Navigation-->
<nav id="navigation">
    <div id="logo">
        <a href="./"><img id="logoImage" src="public/images/logo.png"></a>
    </div>
    <ul id="navigationList">
        <li class="nav listItem"><a href="./">Home</a></li>
        <li class="nav listItem"><a href="./?action=about">About Us</a></li>
        <li class="nav listItem"><a href="<?php
            if (isset($_SESSION['username']) && $_SESSION['username'] == ADMIN_USERNAME) {
                echo "./?action=admin";
            } else {
                echo "./?action=login";
            }
            ?>">
                <?php
                    if(isset($_SESSION['username'])) {
                        echo $_SESSION['username'];
                    } else
                        echo "Login";
                    ?>
            </a></li>
        <li class="nav listItem">
            <?php
            if (isset($_SESSION['username'])){ ?>
                <a href="./?action=logout">Logout</a>
            <?php } else { ?>
                <a href="./?action=register">Register</a>
            <?php } ?>
        </li>
    </ul>
</nav>