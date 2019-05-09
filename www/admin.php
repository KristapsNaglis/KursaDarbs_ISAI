<?php
include "templates/partials/head.php" ;

require( "config.php" );
session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$username = isset( $_SESSION['username'] ) ? $_SESSION['username'] : "";

if ( $action != "login" && $action != "logout" && !$username ) {
    login();
    exit;
}

switch ( $action ) {
    case 'login':
        login();
        break;
    case 'logout':
        logout();
        break;
    case 'newTicket':
        newTicket();
        break;
    case 'editTicket':
        editTicket();
        break;
    case 'deleteTicket':
        deleteTicket();
        break;
    default:
        listTickets();
}


function login() {

    $results = array();
    $results['pageTitle'] = "Admin Login | GROUP IV";

    if ( isset( $_POST['login'] ) ) {

        // User has posted the login form: attempt to log the user in

        if ( $_POST['username'] == ADMIN_USERNAME && $_POST['password'] == ADMIN_PASSWORD ) {

            // Login successful: Create a session and redirect to the admin homepage
            $_SESSION['username'] = ADMIN_USERNAME;
            header( "Location: admin.php" );

        } else {

            // Login failed: display an error message to the user
            $results['errorMessage'] = "Incorrect username or password. Please try again.";
            require( TEMPLATE_PATH . "/admin/loginForm.php" );
        }

    } else {

        // User has not posted the login form yet: display the form
        require( TEMPLATE_PATH . "/admin/loginForm.php" );
    }

}


function logout() {
    unset( $_SESSION['username'] );
    header( "Location: admin.php" );
}


function newTicket() {

    $results = array();
    $results['pageTitle'] = "New Ticket";
    $results['formAction'] = "newTicket";

    if ( isset( $_POST['saveChanges'] ) ) {

        // User has posted the ticket edit form: save the new ticket
        $article = new Ticket;
        $article->storeFormValues( $_POST );
        $article->insert();
        header( "Location: admin.php?status=changesSaved" );

    } elseif ( isset( $_POST['cancel'] ) ) {

        // User has cancelled their edits: return to the ticket list
        header( "Location: admin.php" );
    } else {
        // User has not posted the ticket edit form yet: display the form
        $results['tickets'] = new Ticket;
        require( TEMPLATE_PATH . "/admin/editTickets.php" );
    }

}


function editTicket() {

    $results = array();
    $results['pageTitle'] = "Edit Ticket";
    $results['formAction'] = "editTicket";

    if ( isset( $_POST['saveChanges'] ) ) {

        // User has posted the ticket edit form: save the ticket changes

        if ( !$article = Ticket::getById( (int)$_POST['ticketId'] ) ) {
            header( "Location: admin.php?error=ticketNotFound" );
            return;
        }

        $article->storeFormValues( $_POST );
        $article->update();
        header( "Location: admin.php?status=changesSaved" );

    } elseif ( isset( $_POST['cancel'] ) ) {

        // User has cancelled their edits: return to the ticket list
        header( "Location: admin.php" );
    } else {

        // User has not posted the ticket edit form yet: display the form
        $results['tickets'] = Ticket::getById( (int)$_GET['ticketId'] );
        require( TEMPLATE_PATH . "/admin/editTickets.php" );
    }

}


function deleteTicket() {

    if ( !$article = Ticket::getById( (int)$_GET['ticketId'] ) ) {
        header( "Location: admin.php?error=ticketNotFound" );
        return;
    }

    $article->delete();
    header( "Location: admin.php?status=ticketDeleted" );
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

    require( TEMPLATE_PATH . "/admin/listTickets.php" );
}

include "templates/partials/footer.php" ;