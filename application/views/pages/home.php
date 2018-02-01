<div class="ticket-container col-12">
    <div class="tickets-body row justify-content-center">
        <?php
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
            <a href="ticket/<?= $ticket['ticket_id'] ?>" class="ticket unset-link">
                <div class="card ticket-card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $ticket['alert_name'] ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $ticket['email'] ?><?php echo  checkShowOrHide($ticket['status_level'], 'pending', ' - <importance style="color:' . $ticket['importance_color'] . ';">' . $ticket['importance_name'] . '</importance>'); ?></h6>
                        <p class="card-text dotted"><?= $ticket['ticket_problem'] ?></p>
                        <a href="ticket/<?= $ticket['ticket_id'] ?>" class="card-link">More...</a>
                    </div>
                </div>
            </a>

            <?php
            if ($ticket_count == 9 || $key == $end){
                $ticket_count = 0;
                ?>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <div class="row justify-content-center pages">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" onclick="previous()">Previous</a></li>
            <?php
            foreach ($pages as $key => $page){
                if ($key == 0){}
                ?>
                <li id="<?= $key+1 ?>" class="page-item page-nr" onclick="fetchPage($(this))"><a class="page-link"><?= $key+1 ?></a></li>
                <?php
            }
            ?>
            <li class="page-item"><a class="page-link" onclick="next()">Next</a></li>
        </ul>
        <script>
            $(function () {
                var pages = $('.page').length;

                if(!sessionStorage['archive'] || pages < sessionStorage['archive']){
                    sessionStorage['archive'] = 1;
                }

                $('#' + sessionStorage['archive']).addClass('active');
                $('.page_' + sessionStorage['archive']).fadeIn();
            });

            function fetchPage(elem){
                var ID = parseInt($(elem).attr('id'));
                if (sessionStorage['archive'] != ID){
                    animatePagination(ID);
                }
                sessionStorage['archive'] = ID;
            }

            function next(){
                var pages = $('.page').length;

                if (parseInt(sessionStorage['archive']) < pages){
                    var ID = parseInt(sessionStorage['archive']) + 1;
                    if (sessionStorage['archive'] != ID){
                        animatePagination(ID)
                    }
                }
            }

            function previous() {
                if (parseInt(sessionStorage['archive']) > 1){
                    var ID = parseInt(sessionStorage['archive']) - 1;
                    if (sessionStorage['archive'] != ID){
                        animatePagination(ID)
                    }
                }
            }

            function animatePagination(ID){
                $('.page-item').removeClass('active');
                $('.page').css({'display': 'none'});

                $('#' + ID).addClass('active');
                $('.page_' + ID ).show();

                $('html, body').animate({
                    scrollTop: $("html").offset().top
                }, 500);

                sessionStorage['archive'] = ID;
            }
        </script>
    </div>
</div>