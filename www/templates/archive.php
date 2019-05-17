<?php include "partials/head.php" ?>
<?php include "partials/nav.php" ?>

    <div id="archiveContainer">
        <h1>Visas biļetes</h1>


        <div id="archives">
            <div id="archiveBackground">

                <?php foreach ($results['tickets'] as $tickets) { ?>

                    <!--<img id="archiveBackgroundImage"
                         src="public/images/ticketArchive/archive<?= $tickets->id ?>.png">
-->
                <?php } ?>

            </div>

            <div id="archiveForeground">

                <ul id="ticketsAllInfo">

                    <?php foreach ($results['tickets'] as $tickets) { ?>

                        <li id="ticketArchiveList">
                            <div id="ticketArchiveListLeft">
                                <span class="pubDate"><?php echo date('j F Y', $tickets->dateOfEvent) ?></span>
                                <br>
                                <a id="archiveTitle"
                                   href=".?action=viewArticle&amp;articleId=<?php echo $tickets->id ?>"><?php echo htmlspecialchars($tickets->title) ?></a>
                            </div>
                            <div id="ticketArchiveListRight">
                                <p class="description"><?php echo htmlspecialchars($tickets->description) ?></p>
                            </div>
                        </li>

                        <?php
                        if(isset($_SESSION['username'])) {?>
                            <div class="buyButton"><a>BUY BUTTON</a></div>
                    <?php } } ?>

                </ul>
            </div>
        </div>

        <div id="archiveTotal">
            <p><?php echo $results['totalRows'] ?> ticket<?php echo ($results['totalRows'] != 1) ? 's' : '' ?> in
                total.</p>
        </div>
    </div>

<?php include "partials/footer.php" ?>