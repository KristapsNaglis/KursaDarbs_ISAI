
    <div id="adminHeader">
        <h2>Biļešu p/p sistēmas admin panelis</h2>
        <p>You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></p>
    </div>

    <h1><?php echo $results['pageTitle']?></h1>

    <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">
        <input type="hidden" name="ticketId" value="<?php echo $results['tickets']->id ?>"/>

        <?php if ( isset( $results['errorMessage'] ) ) { ?>
            <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
        <?php } ?>

        <ul>

            <li>
                <label for="title">Event Title</label>
                <input type="text" name="title" id="title" placeholder="Name of the article" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['tickets']->title )?>" />
            </li>

            <li>
                <label for="price">Ticket Price</label>
                <textarea name="price" id="price" placeholder="Price of this ticket" required maxlength="1000" style="height: 5em;"><?php echo htmlspecialchars( $results['tickets']->price )?></textarea>
            </li>

            <li>
                <label for="artist">Artist</label>
                <textarea name="artist" id="artist" placeholder="Artist that will perform at this event" required maxlength="1000" style="height: 5em;"><?php echo htmlspecialchars( $results['tickets']->artist )?></textarea>
            </li>

            <li>
                <label for="venue">Venue</label>
                <textarea name="venue" id="venue" placeholder="Venue which will host the event" required maxlength="1000" style="height: 5em;"><?php echo htmlspecialchars( $results['tickets']->venue )?></textarea>
            </li>

            <li>
                <label for="seating">Seating</label>
                <textarea name="seating" id="seating" placeholder="SECTOR-ROW-SEAT" required maxlength="1000" style="height: 5em;"><?php echo htmlspecialchars( $results['tickets']->seating )?></textarea>
            </li>

            <li>
                <label for="dateOfEvent">Date Of Event</label>
                <input type="date" name="dateOfEvent" id="dateOfEvent" placeholder="YYYY-MM-DD" required maxlength="10" value="<?php echo $results['tickets']->dateOfEvent ? date( "Y-m-d", $results['tickets']->dateOfEvent ) : "" ?>" />
            </li>

            <li>
                <label for="description">Event Description</label>
                <textarea name="description" id="description" placeholder="Description of the event" required maxlength="100000" style="height: 30em;"><?php echo htmlspecialchars( $results['tickets']->description )?></textarea>
            </li>

            <li>
                <label for="dateOfInserting">Date of Inserting</label>
                <input type="date" name="dateOfInserting" id="dateOfInserting" placeholder="YYYY-MM-DD" required maxlength="10" value="<?php echo $results['tickets']->dateOfInserting ? date( "Y-m-d", $results['tickets']->dateOfInserting ) : "" ?>" />
            </li>



        </ul>

        <div class="buttons">
            <input type="submit" name="saveChanges" value="Save Changes" />
            <input type="submit" formnovalidate name="cancel" value="Cancel" />
        </div>

    </form>

<?php if ( $results['tickets']->id ) { ?>
    <p><a href="admin.php?action=deleteTicket&amp;ticketId=<?php echo $results['tickets']->id ?>" onclick="return confirm('Delete This Ticket?')">Delete This Ticket</a></p>
<?php } ?>
