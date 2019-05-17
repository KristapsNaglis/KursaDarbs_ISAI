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
    case 'login':
        login();
        break;
    case 'register':
        register();
        break;
    case 'logout':
        logout();
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
    $results['pageTitle'] = "Admin Login | GROUP IV";
    header("Location: admin.php");
}

function about(){
    $results = array();
    $results['pageTitle'] = "About | GROUP IV";
    require("about.php");
}

function login(){
    $results = array();
    $results['pageTitle'] = "User Login | GROUP IV";
    header("Location: user.php");
}

function register(){
    $results = array();
    $results['pageTitle'] = "User Register | GROUP IV";
    header("Location: user.php?action=register");
}

function logout() {
    $results = array();
    $results['pageTitle'] = "Logout | GROUP IV";
    header("Location: user.php?action=logout");
}
