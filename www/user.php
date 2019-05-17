<?php
include "templates/partials/head.php" ;

require( "config.php" );
session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$username = isset( $_SESSION['username'] ) ? $_SESSION['username'] : "";

if ( $action == "register") {
    register();
    exit;
}

if ( $action != "login" && $action != "logout" && !$username ) {
    login();
    exit;
}

switch ( $action ) {
    case 'register':
        register();
        break;
    case 'login':
        login();
        break;
    case 'logout':
        logout();
        break;
    default:
        listTickets();
}


function login() {

    $results = array();
    $results['pageTitle'] = "User Login | GROUP IV";

    if ( isset( $_POST['login'] ) ) {

        $newUsername = $_POST['username'];
        $newPassword = $_POST['password'];
        $newPassword = md5($newPassword);

        $dbUsername = User::getUsernameByUsername($newUsername);
        $dbPassword = User::getPasswordByUsername($newUsername);

        // User has posted the login form: attempt to log the user in
        if ( $newUsername == $dbUsername && $newPassword == $dbPassword ) {

            // Login successful: Create a session and redirect to the user homepage

            $_SESSION['username'] = $newUsername;
            header( "Location: index.php" );

        } else {
            // Login failed: display an error message to the user
            $results['errorMessage'] = "Incorrect username or password. Please try again.";
            require( TEMPLATE_PATH . "/user/userLoginForm.php" );
        }

    } else {

        // User has not posted the login form yet: display the form
        require( TEMPLATE_PATH . "/user/userLoginForm.php" );
    }
}

function register() {
    $results = array();
    $results['pageTitle'] = "New User";
    $results['formAction'] = "newUser";

    if ( isset( $_POST['register'] ) ) {

        // User has posted the ticket edit form: save the new ticket
        $user = new User;
        $user->storeFormValues( $_POST );
        $user->insert();
        header( "Location: user.php?status=changesSaved" );

    } elseif ( isset( $_POST['cancel'] ) ) {

        // User has cancelled their edits: return to the ticket list
        header( "Location: user.php" );
    } else {
        // User has not posted the ticket edit form yet: display the form
        $results['users'] = new User;
        require( TEMPLATE_PATH . "/user/register.php" );
    }
}


function logout() {
    unset( $_SESSION['username'] );
    header( "Location: index.php" );
}

function listTickets() {
    $results = array();
    $data = Ticket::getList();
    $results['tickets'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "All Tickets | GROUP IV";

    if ( isset( $_GET['error'] ) ) {
        if ( $_GET['error'] == "ticketNotFound" ) $results['errorMessage'] = "Error: Ticket not found.";
    }

    if ( isset( $_GET['status'] ) ) {
        if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
        if ( $_GET['status'] == "ticketDeleted" ) $results['statusMessage'] = "Ticket deleted.";
    }

    require( TEMPLATE_PATH . "/user/listTickets.php" );
}

