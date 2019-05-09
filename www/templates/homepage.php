<?php include "partials/head.php" ?>
<?php include "partials/nav.php" ?>

<!--Main container-->
    <div class="mainContainer">
        <div class="middleContainer">
            <div class="mainImage">
                <div class="background">
                    <img class="mainImageImage" src="public/images/media/mesa.png">
                </div>
                <div class="foreground">
                    <?php foreach ($results['tickets'] as $ticket) { if ($ticket->isMainFeatured == 1) { ?>
                        <h2>
                            <div class="foregroundLeft">
                                <span class="foregroundLeftDateOfEvent"><?php echo date('j F', $ticket->dateOfEvent) ?></span>
                            </div>
                            <div class="foregroundRight">
                                <ul class="carouselList">
                                    <li><a class="foregroundRightPrice" href=".?action=viewTicket&amp;ticketId=<?php echo $ticket->id ?>"><?php echo htmlspecialchars($ticket->price) ?> €</a></li>
                                    <li><a class="foregroundRightVenue" href=".?action=viewTicket&amp;ticketId=<?php echo $ticket->id ?>"><?php echo htmlspecialchars($ticket->venue) ?></a></li>
                                    <li><a class="foregroundRightTitle" href=".?action=viewTicket&amp;ticketId=<?php echo $ticket->id ?>"><?php echo htmlspecialchars($ticket->title) ?></a></li>
                                </ul>
                            </div>
                        </h2>
                    <?php }} ?>
                </div>
            </div>
            <div class="bottomCarousel">
                <ul id="headlines">
                    <?php
                    foreach ($results['tickets'] as $ticket) { if ($ticket->id >= 2) {  ?>
                        <li>
                            <h2>
                                <span class="dateOfEvent"><?php echo date('j F', $ticket->dateOfEvent) ?></span>
                                <br>
                                <a href=".?action=viewTicket&amp;ticketId=<?php echo $ticket->id ?>"><?php echo htmlspecialchars($ticket->title) ?></a>
                            </h2>
                        </li>
                    <?php }} ?>
                </ul>
            </div>
        </div>
        <div class="bottomMiddleContainer">
            <p><a href="./?action=archive">All tickets</a></p>
        </div>
    </div>

<?php include "partials/footer.php" ?>