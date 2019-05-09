<?php

require( "config.php" );
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";

switch ( $action ) {
    case 'archive':
        archive();
        break;
    case 'viewTicket':
        viewTicket();
        break;
    case 'admin':
        admin();
        break;
    case 'about':
        about();
        break;
    case 'support':
        support();
        break;
    case 'register':
        register();
        break;
    default:
        homepage();
}


function archive() {
    $results = array();
    $data = Ticket::getList();
    $results['tickets'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "Ticket Archive | GROUP IV";
    require( TEMPLATE_PATH . "/archive.php" );
}

function viewTicket() {
 /*   if ( !isset($_GET["ticketID"]) || !$_GET["ticketID"] ) {
        homepage();
        return;
    }*/

    $results = array();
    $results['tickets'] = Ticket::getById( (int)$_GET["ticketId"] );
    $results['pageTitle'] = $results['tickets']->title . " | GROUP IV";
    require( TEMPLATE_PATH . "/viewTicket.php" );
}

function homepage() {
    $results = array();
    $data = Ticket::getList( HOMEPAGE_NUM_ARTICLES, "dateOfEvent ASC" );
    $results['tickets'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "Tickets | GROUP IV";
    require( TEMPLATE_PATH . "/homepage.php" );
}

function admin(){
    $results = array();
    $results['pageTitle'] = "Admin LogIn | GROUP IV";
    header("Location: admin.php");
}

function about(){
    $results = array();
    $results['pageTitle'] = "About | GROUP IV";
    require("about.php");
}

function support(){
    $results = array();
    $results['pageTitle'] = "Support | GROUP IV";
    require("support.php");
}

function register(){
    $results = array();
    $results['pageTitle'] = "Admin LogIn | GROUP IV";
    require("register.php");
}
