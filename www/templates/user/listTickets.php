<?php
include "templates/partials/head.php";
include "templates/partials/nav.php";
?>

<div id="adminHeader">
    <h2>Biļešu p/p sistēmas lietotāja panelis</h2>
    <p>You are logged in as <b><?php echo htmlspecialchars($_SESSION['username']) ?></b>.</p>
</div>

<h1>Manas biļetes</h1>

<?php if (isset($results['errorMessage'])) { ?>
    <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>


<?php if (isset($results['statusMessage'])) { ?>
    <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
<?php } ?>

<!--<table>
    <tr>
        <th>Event Date</th>
        <th>Ticket</th>
    </tr>

    <?php /*foreach ($results['tickets'] as $ticket) { */?>

        <tr>
            <td><?php /*echo date('j M Y', $ticket->dateOfEvent) */?></td>
            <td>
                <?php /*echo $ticket->title */?>
            </td>
        </tr>

    <?php /*} */?>

</table>-->

<p><?php /*echo $results['totalRows'] */?> 0 biļete<?php echo ($results['totalRows'] != 1) ? 's' : '' ?> kopā.</p>
