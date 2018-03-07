<style> .container { max-width: 90%; } </style>
<div class="tickets-body row justify-content-center">
    <div class="page row justify-content-center">
        <?php
        if (!empty($array)){
            foreach ($array as $key => $ticket) {
                ?>

                <div class="card ticket-card" style="width: 18rem;"
                     onclick="window.location = '/ticket/<?= $ticket['ticket_id'] ?>'">
                    <div class="card-body">
                        <h5 class="card-title"><?= ucfirst($ticket['client_name']) ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            <importance style="color:<?= $ticket['importance_color'] ?>">
                                <?= $ticket['importance_name'] ?>
                            </importance
                            <br/><br/>
                            <?= $ticket['cat_name'] ?>
                            <br/>
                            <?= $ticket['email'] ?>
                        </h6>
                        <p class="card-text dotted"><?= $ticket['ticket_problem'] ?></p>
                        <a href="/ticket/<?= $ticket['ticket_id'] ?>" class="card-link">More...</a>
                    </div>
                </div>
                <?php
            }
        }else {
            ?>
            <span class="w-100 text-center">There are no completed tickets.</span>
            <br/>
            <button class="btn btn-outline-success" onclick="$('#add-ticket-modal').modal('toggle')">Create one</button>
            <?php
        }
        ?>
    </div>
</div>

<?= $links ?>