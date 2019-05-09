
    <div id="adminHeader">
        <h2>Biļešu p/p sistēmas admin panelis</h2>
        <p>You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></p>
    </div>

    <h1>All Tickets</h1>

<?php if ( isset( $results['errorMessage'] ) ) { ?>
    <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>


<?php if ( isset( $results['statusMessage'] ) ) { ?>
    <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
<?php } ?>

    <table>
        <tr>
            <th>Event Date</th>
            <th>Ticket</th>
        </tr>

        <?php foreach ( $results['tickets'] as $ticket ) { ?>

            <tr onclick="location='admin.php?action=editTicket&amp;ticketId=<?php echo $ticket->id?>'">
                <td><?php echo date('j M Y', $ticket->dateOfEvent)?></td>
                <td>
                    <?php echo $ticket->title?>
                </td>
            </tr>

        <?php } ?>

    </table>

    <p><?php echo $results['totalRows']?> ticket<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>

    <p><a href="admin.php?action=newTicket">Add a New Ticket</a></p>
