<?php include "partials/head.php" ?>
<?php include "partials/nav.php" ?>

    <!--Main container-->
    <div class="mainContainer">
        <div class="middleContainer">
            <div class="mainImage">
                <?php foreach ($results['tickets'] as $ticket) {
                    if ($ticket->isMainFeatured == 1) { ?>
                        <a id="mainImageLink" href=".?action=viewTicket&amp;ticketId=<?php echo $ticket->id ?>">
                            <div class="background">
                                <img class="mainImageImage" src="public/images/media/mesa.png">
                            </div>
                        </a>
                    <?php }
                } ?>
                <div class="foreground">
                    <?php foreach ($results['tickets'] as $ticket) {
                        if ($ticket->isMainFeatured == 1) { ?>
                            <h2>
                                <div class="foregroundLeft">
                                    <span class="foregroundLeftDateOfEvent"><?php echo date('j F', $ticket->dateOfEvent) ?></span>
                                </div>
                                <div class="foregroundRight">
                                    <ul class="carouselList">
                                        <li><a class="foregroundRightPrice"><?php echo htmlspecialchars($ticket->price) ?> €</a></li>
                                        <li><a class="foregroundRightVenue"><?php echo htmlspecialchars($ticket->venue) ?></a></li>
                                        <li><a class="foregroundRightTitle"><?php echo htmlspecialchars($ticket->title) ?></a></li>
                                    </ul>
                                </div>
                            </h2>
                        <?php }
                    } ?>
                </div>
            </div>
            <div class="bottomCarousel">
                <div class="carousel">
                    <div class="backgroundCarousel">
                        <?php
                        foreach ($results['tickets'] as $ticket) {
                            if ($ticket->id >= 2) { ?>
                                <a href=".?action=viewTicket&amp;ticketId=<?php echo $ticket->id ?>">
                                    <div class="backgroundCarouselIndividual">
                                        <img class="backgroundCarouselImage"
                                             src="public/images/media/carousel<?= $ticket->id ?>.png">
                                        <div class="backgroundCarouselImageOverlay"></div>
                                    </div>
                                </a>
                            <?php }
                        } ?>
                    </div>
                    <div class="foregroundCarousel">
                        <ul id="headlines">
                            <?php
                            foreach ($results['tickets'] as $ticket) {
                                if ($ticket->id >= 2) { ?>
                                    <li>
                                        <a class="dateOfEvent small"><?php echo date('j F', $ticket->dateOfEvent) ?></a>
                                        <br>
                                        <a class="title small"
                                           href=".?action=viewTicket&amp;ticketId=<?php echo $ticket->id ?>">
                                            <?php if (strlen(htmlspecialchars($ticket->title)) >= 19) {
                                                echo substr(htmlspecialchars($ticket->title), 0, 19) . "...";
                                            } else echo htmlspecialchars($ticket->title) ?>
                                        </a>
                                    </li>
                                <?php }
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottomMiddleContainer">
            <p><a href="./?action=archive">Visas biļetes pieejamas šeit</a></p>
        </div>
    </div>

<?php include "partials/footer.php" ?>