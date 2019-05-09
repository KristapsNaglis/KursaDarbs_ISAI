<?php include "partials/head.php" ?>
<?php include "partials/nav.php" ?>

    <h1>Ticket Archive</h1>

    <ul id="ticketsAllInfo" class="archive">

        <?php foreach ($results['tickets'] as $tickets) { ?>

            <li>
                <h2>
                    <span class="pubDate"><?php echo date('j F Y', $tickets->dateOfEvent) ?></span>
                    <a href=".?action=viewArticle&amp;articleId=<?php echo $tickets->id ?>"><?php echo htmlspecialchars($tickets->title) ?></a>
                </h2>
                <p class="description"><?php echo htmlspecialchars($tickets->description) ?></p>
            </li>

        <?php } ?>

    </ul>

    <p><?php echo $results['totalRows'] ?> ticket<?php echo ($results['totalRows'] != 1) ? 's' : '' ?> in total.</p>

    <p><a href="./">Return to Homepage</a></p>

<?php include "partials/footer.php" ?>