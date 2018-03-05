<style> .container { max-width: 90%; } </style>
<div class="tickets-body row justify-content-center">
    <?php
    if (!empty($tickets)){
        $pages = [];
        $page_count = 0;
        $ticket_count = 0;
        end($tickets);
        $end = key($tickets);

        foreach ($tickets as $key => $ticket) {

            $ticket_count++;
            if ($ticket_count == 1){
                $page_count++;
                $pages[] = $page_count;
                ?>
                <div class="page page_<?= $page_count ?> row justify-content-center" style="display: none">
                <?php
            }
            ?>
            <a href="/ticket/<?= $ticket['ticket_id'] ?>" class="ticket unset-link">
                <div class="card ticket-card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?= ucfirst($ticket['client_name']) ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= checkShowOrHide($ticket['status_level'], 'pending', '<importance style="color:' . $ticket['importance_color'] . ';">' . $ticket['importance_name'] . '</importance>').'<br/>'.$ticket['cat_name'].'<br/>'.$ticket['email']; ?></h6>
                        <p class="card-text dotted"><?= $ticket['ticket_problem'] ?></p>
                        <a href="/ticket/<?= $ticket['ticket_id'] ?>" class="card-link">More...</a>
                    </div>
                </div>
            </a>

            <?php
            if ($ticket_count == 20 || $key == $end){
                $ticket_count = 0;
                ?>
                </div>
                <?php
            }
        }
    }else{
        ?>
        <span class="w-100 text-center">There are no tickets.</span>
        <br />
        <button class="btn btn-outline-success" onclick="$('#add-ticket-modal').modal('toggle')">Create one</button>
        <?php
    }
    ?>
</div>
<?php
if (!empty($tickets)) {
    ?>
    <div class="row justify-content-center pages">
        <ul class="pagination bg-dark">
            <li class="page-item"><a class="page-link" onclick="previous()">Previous</a></li>
            <?php
            foreach ($pages as $key => $page) {
                if ($key == 0) {
                }
                ?>
                <li id="<?= $key + 1 ?>" class="page-item page-nr" onclick="fetchPage($(this))"><a
                            class="page-link"><?= $key + 1 ?></a></li>
                <?php
            }
            ?>
            <li class="page-item"><a class="page-link bg-dark text-light" onclick="next()">Next</a></li>
        </ul>
        <script>
            $(function () {
                var pages = $('.page').length;

                if (!sessionStorage['archive'] || pages < sessionStorage['archive']) {
                    sessionStorage['archive'] = 1;
                }

                $('#' + sessionStorage['archive']).addClass('active');
                $('.page_' + sessionStorage['archive']).fadeIn();
            });

            function fetchPage(elem) {
                var ID = parseInt($(elem).attr('id'));
                if (sessionStorage['archive'] != ID) {
                    animatePagination(ID);
                }
                sessionStorage['archive'] = ID;
            }

            function next() {
                var pages = $('.page').length;

                if (parseInt(sessionStorage['archive']) < pages) {
                    var ID = parseInt(sessionStorage['archive']) + 1;
                    if (sessionStorage['archive'] != ID) {
                        animatePagination(ID)
                    }
                }
            }

            function previous() {
                if (parseInt(sessionStorage['archive']) > 1) {
                    var ID = parseInt(sessionStorage['archive']) - 1;
                    if (sessionStorage['archive'] != ID) {
                        animatePagination(ID)
                    }
                }
            }

            function animatePagination(ID) {
                $('.page-item').removeClass('active');
                $('.page').css({'display': 'none'});

                $('#' + ID).addClass('active');
                $('.page_' + ID).show();

                $('html, body').animate({
                    scrollTop: $("html").offset().top
                }, 500);

                sessionStorage['archive'] = ID;
            }
        </script>
    </div>
    <?php
}
?>
