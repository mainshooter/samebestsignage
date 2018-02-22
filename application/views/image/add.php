<div class="card flex-row row">
    <div class="card-left col-sm-12 col-md-6 col-lg-4">
        <div class="card-body">
            <h3 class="card-title"><?= $ticket['cat_name'] ?></h3>
            <h6 class="card-subtitle mb-2 text-muted">
                <a href="#" onclick="$('#ticket-modal-comp').modal('toggle')"> <?= $ticket['client_name'] ?> &#9432; </a>
            </h6>
            <h6 class="card-subtitle mb-2 text-muted" style="color:<?= $ticket['importance_color'] ?>!important;">
                <?= $ticket['importance_name'] ?>
            </h6>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Handler: <?= $ticket['email'] ?></li>
            <li class="list-group-item">No. <?= $ticket['ticket_id'] ?></li>
            <li class="list-group-item"><?= $ticket['status_name'] ?></li>
            <li class="list-group-item"> Created <?= date("d F Y H:m", strtotime($ticket['ticket_created_at'])) ?></li>
        </ul>
    </div>
    <div class="card-right col-sm-12 col-md-6 col-lg-8 position-relative">
        <div class="card-body">
            <div class="body-img">
                <script type="text/javascript" src="https://cdn.rawgit.com/asvd/dragscroll/master/dragscroll.js"></script>
                <div class="slider">
                    <div class="slider-content dragscroll">
                        <?php
                        foreach ($images as $image){
                            ?>
                            <a class="slider-item" data-toggle="modal" data-target="#exampleModal" onclick="$('.modal-item-img').attr('src', '<?= $image['img_path'].$image['img_name'] ?>'), $('.modal-title-img').html('<?= $image['img_name'] ?>')">
                                <img class="slider-item-img d-block" src="<?= $image['img_path'].$image['img_thumb'] ?>" alt="<?= $image['img_name'] ?>">
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header-img">
                            <h5 class="modal-title-img">Modal title</h5>
                            <button type="button" class="close-img" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-img">
                            <img class="modal-item-img d-block" src="" alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(function () {
                    $('.carousel-item:first-of-type').addClass('active');
                });
            </script>

            <div class="body-text">
                <p id="problem" class="card-text">
                <h4><small>Problem</small></h4>
                <?= $ticket['ticket_problem'] ?>
                </p>


                <?php
                $data = '
                <p id="solution" class="card-text">
                    <h4><small>Solution</small></h4>
                    '. $ticket['ticket_solution'] .'
                </p>';

                echo checkShowOrHide($ticket['status_level'], 'solved', $data);

                $data = '
                <p id="unsolved" class="card-text ticket-unsolved">
                    <h4><small>Reason Unsolved</small></h4>
                    '. $ticket['ticket_comment'] .'
                </p>';

                echo checkShowOrHide($ticket['status_level'], 'failed', $data) ?>
            </div>
            <div class="body-text add-img">
                <form id="add-image" method="post">
                    <div class="form-group">
                        <label for="image">Images</label>
                        <input type="file" accept="image/*" class="form-control" id="image-add" name="add-images" multiple>
                    </div>

                    <button type="submit" class="btn btn-outline-success" style="line-height: 1">Add Images</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ticket-modal-comp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-msg"></div>
                <ul class="list-group">
                    <li class="list-group-item"><?= $ticket['client_name'] ?></li>
                    <li class="list-group-item"><a href="mailto:<?= $ticket['client_email'] ?>"><?= $ticket['client_email'] ?></a></li>
                    <li class="list-group-item"><a href="tel:<?= $ticket['client_tel'] ?>"><?= $ticket['client_tel'] ?></a></li>
                    <li class="list-group-item"><?= $ticket['client_country'].', '.$ticket['client_state'] ?></li>
                    <li class="list-group-item">
                        <address>
                            <?php $arr = preg_split('/(?<=[0-9])\s*(?=[a-zA-Z]+)/xi',$ticket['client_zipcode']); ?>
                            <a target="_blank" href="https://www.google.nl/maps/place/<?= $ticket['client_street'] ?>+<?= $ticket['client_street_number'] ?>+<?= $arr[0] ?>+<?= $arr[1] ?>+<?= $ticket['client_city'] ?>/">
                                <?= $ticket['client_street'].' '.$ticket['client_street_number'].' '.$ticket['client_city'].', '.$ticket['client_zipcode'] ?>
                            </a>
                        </address>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Set up an event listener for the contact form.
    $('#add-image').submit(function(event) {
        event.preventDefault();

        var data = new FormData();
        var ins = document.getElementById('image-add').files.length;

        for (var x = 0; x < ins; x++) {
            data.append("image[]", document.getElementById('image-add').files[x]);
        }


        <?= image('POST', 'insert', 'data', $ticket['ticket_images'].'/'.$ticket['ticket_id'], null, 'enctype: "multipart/form-data", processData: false, contentType: false,') ?>
    });
</script>