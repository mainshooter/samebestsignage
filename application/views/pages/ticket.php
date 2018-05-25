<div class="card flex-row row">
    <div class="card-left col-sm-12 col-md-6 col-lg-4">
        <div class="card-body">
            <div class="row w-100">
                <h3 class="card-title"><?= $ticket['cat_name'] ?></h3>
                <div class="material-icons share" onclick="$('#ticket-share').modal('toggle')">share</div>
            </div>

            <h6 class="card-subtitle mb-2 text-muted">
                <a href="#" onclick="$('#ticket-modal-comp').modal('toggle')"> <?= $ticket['client_name'] ?> &#9432; </a>
            </h6>
            <h6 class="card-subtitle mb-2 text-muted" style="color:<?= $ticket['importance_color'] ?>!important;">
                <?= $ticket['importance_name'] ?>
            </h6>

        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Handler: <?= ($this_user['DX_user_id'] == $ticket['ticket_master'])? '(You)' : $ticket['email'] ?></li>
            <li class="list-group-item">No. <?= $ticket['ticket_id'] ?></li>
            <li class="list-group-item"><?= $ticket['status_name'] ?></li>
            <li class="list-group-item"> Created: <?= date("d F Y H:i", strtotime($ticket['ticket_created_at'])) ?></li>
            <li class="list-group-item">
                <?= ($ticket['ticket_edited_at'] != null)? 'Last edited: ' . date("d F Y H:i", strtotime($ticket['ticket_edited_at'])) : 'Not edited' ?>
            </li>
            <li class="list-group-item">
                <?= ($ticket['ticket_completed_at'] != null)? 'Completed: ' . date("d F Y H:i", strtotime($ticket['ticket_completed_at'])) : 'Not completed' ?>
            </li>
            <?php
            if ($this_user['DX_user_id'] == $ticket['ticket_master'] || $this_user['DX_role_id'] >= 2) {
                ?>
                <li class="list-group-item">
                    <?php
                    if (!empty($ticket['ticket_completed_at'])) {
                        ?>
                        <a href="#" onclick="$('#ticket-modal-restore').modal('toggle')"
                           class="btn btn-outline-success">Restore</a>
                        <?php
                    } else {
                        ?>
                        <a href="#" onclick="$('#ticket-modal').modal('toggle')" class="btn btn-outline-success">Complete</a>
                        <?php
                    }
                    ?>
                </li>
                <li class="list-group-item">
                    <a href="#" onclick="$('#ticket-modal-problem').modal('toggle')" class="btn btn-outline-warning">Edit</a>
                </li>

                <li class="list-group-item">
                    <a href="#" onclick="$('#ticket-modal-assign').modal('toggle')" class="btn btn-outline-danger">Re-Assign</a>
                </li>
                <?php
            }
            ?>
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
                            <h5 class="modal-title-img" style="text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;">Modal title</h5>
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

                if ($ticket['status_level'] == 'solved'){
                    ?>
                    <p id="solution" class="card-text">
                    <h4><small>Solution</small></h4>
                    <?= $ticket['ticket_solution'] ?>
                    </p>
                    <?php
                }

                if ($ticket['status_level'] == 'failed'){
                    ?>
                    <p id="unsolved" class="card-text ticket-unsolved">
                    <h4><small>Reason Unsolved</small></h4>
                    <?= $ticket['ticket_comment'] ?>
                    </p>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="progress-box col-sm-12 col-md-6 float-right">
            <div class="progress-head">Progress</div>
            <div class="progress-item-group dragscroll">
                <?php
                if (!empty($progress)) {
                    foreach ($progress as $item) {
                        ?>
                        <div class="progress-item <?= $item['id'] == $this_user['DX_user_id'] ? 'progress-left' : '' ?>">
                            <div class="progress-user">
                                <a href="mailto:<?= $item['email'] ?>"><?= $item['username'] ?></a>
                            </div>
                            <div class="progress-date">
                                <?= date('d F Y H:i', strtotime($item['progress_date'])) ?>
                            </div>
                            <div class="progress-comment">
                                <?= $item['progress_comment'] ?>
                            </div>
                        </div>
                        <?php
                    }
                } else{
                    ?>
                    <div class="progress-item text-center">
                        <div class="progress-comment">
                            No progress yet
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="progress-add">
                <form id="progress" method="post">
                    <div class="form-group input-group">
                        <label for="reply"></label>
                        <input type="text" name="reply" id="reply" class="form-control" placeholder="Reply...">
                        <div class="input-group-append">
                            <button class="btn btn-outline-success" type="submit">Sent</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if (!empty($ticket['ticket_completed_at'])){
    ?>
    <!-- Modal -->
    <div class="modal fade" id="ticket-modal-restore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form id="restore" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Restore ticket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-msg"></div>
                        This will set the ticket to incomplete. This means that you still need to finish this ticket.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-success">Restore</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Set up an event listener for the contact form.
        $('#restore').submit(function(event) {
            event.preventDefault();
            <?= ajax('POST', 'restoreTicket', '$(this).serialize()', $ticket['ticket_id']) ?>
        });
    </script>
    <?php
} else{
    ?>
    <!-- Modal -->
    <div class="modal fade" id="ticket-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="complete" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Complete ticket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-msg"></div>
                        <div class="form-group">
                            <label for="exampleSelect1">Status</label>
                            <select class="form-control" id="exampleSelect1" name="status" onchange="change($(this))" required>
                                <?php
                                foreach ($statuses as $status){
                                    if ($status['status_name'] != $ticket['status_name']) {
                                        ?>
                                        <option value="<?= $status['status_id'] ?>"
                                                level="<?= $status['status_level'] ?>"><?= $status['status_name'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="expl">Explanation <small>( Explain how you solved this ticket, and if it cant be solved explain why not )</small></label>
                            <textarea id="expl" name="solution" class="form-control" rows="12">Just had to turn it off and on again :)</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Set up an event listener for the contact form.
        $('#complete').submit(function(event) {
            event.preventDefault();
            <?= ajax('POST', 'completeTicket', '$(this).serialize()', $ticket['ticket_id']) ?>
        });
    </script>
    <?php
}
?>

<!-- Modal -->
<div class="modal fade" id="ticket-modal-problem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="edit" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit ticket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-msg"></div>
                    <div class="form-group">
                        <label for="expl">Problem <small>( Explain what the problem is )</small></label>
                        <textarea id="expl" name="problem" class="form-control" rows="12"><?= $ticket['ticket_problem'] ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success">Save changes</button>
                </div>
            </form>
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
                    <?php
                    if (!empty($ticket['client_email'])) {
                        ?>
                        <li class="list-group-item">
                            <a href="mailto:<?= $ticket['client_email'] ?>">
                                <?= $ticket['client_email'] ?>
                            </a>
                        </li>
                        <?php
                    }
                    if (!empty($ticket['client_tel'])) {
                        ?>
                        <li class="list-group-item">
                            <a href="tel:<?= $ticket['client_tel'] ?>">
                                <?= $ticket['client_tel'] ?>
                            </a>
                        </li>
                        <?php
                    }
                    if (!empty($ticket['client_country']) && !empty($ticket['client_state'])) {
                        ?>
                        <li class="list-group-item">
                            <?= $ticket['client_country'] .', '. $ticket['client_state'] ?>
                        </li>
                        <?php
                    } elseif (empty($ticket['client_country']) && !empty($ticket['client_state'])){
                        ?>
                        <li class="list-group-item">
                            <?= $ticket['client_state'] ?>
                        </li>
                        <?php
                    } elseif (empty($ticket['client_state'])  && !empty($ticket['client_country'])){
                        ?>
                        <li class="list-group-item">
                            <?= $ticket['client_country'] ?>
                        </li>
                        <?php
                    }

                    if (!empty($ticket['client_street'])
                        || !empty($ticket['client_street_number'])
                        || !empty($ticket['client_city'])
                        || !empty($ticket['client_zipcode'])) {
                        ?>
                        <li class="list-group-item">
                            <address>
                                <?php if (!empty($ticket['client_zipcode'])) {
                                    $arr = preg_split('/(?<=[0-9])\s*(?=[a-zA-Z]+)/xi', $ticket['client_zipcode']);
                                } ?>
                                <a target="_blank"
                                   href="https://www.google.nl/maps/place/<?= (!empty($ticket['client_street'])) ? $ticket['client_street'] : '-'; ?>+<?= (!empty($ticket['client_street_number'])) ? $ticket['client_street_number'] : '-'; ?>+<?= (!empty($arr[0])) ? $arr[0] : '-'; ?>+<?= (!empty($arr[1])) ? $arr[1] : '-'; ?>+<?= (!empty($ticket['client_city'])) ? $ticket['client_city'] : '-'; ?>/">
                                    <?=
                                    (!empty($ticket['client_street'])) ? $ticket['client_street'] . ' ' : ''
                                    . (!empty($ticket['client_street_number'])) ? $ticket['client_street_number'] . ' ' : ''
                                    . (!empty($ticket['client_city'])) ? $ticket['client_city'] . ', ' : ''
                                    . (!empty($ticket['client_zipcode'])) ? $ticket['client_zipcode'] : ''
                                    ?>
                                </a>
                            </address>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="ticket-share" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <form id="share">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Share</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body form-group">
                    <div class="modal-msg"></div>
                    <label for="email">Sent to</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success">Sent</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
if ($this_user['DX_user_id'] == $ticket['ticket_master'] || $this_user['DX_role_id'] >= 2) {
    ?>
    <!-- Modal -->
    <div class="modal fade" id="ticket-modal-assign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="assign" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Re-Assign</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-msg"></div>
                        <div class="form-group">
                            <label for="exampleSelect1">User</label>
                            <select class="form-control" id="exampleSelect1" name="user" onchange="change($(this))"
                                    required>
                                <option selected disabled>Select a user</option>
                                <?php
                                foreach ($users as $user) {
                                    ?>
                                    <option value="<?= $user['id'] ?>"><?= ucfirst($user['username']) . ': ' . $user['email'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="expl">Reason to re-assign
                                <small>( Explain why you have to re-assign this ticket )</small>
                            </label>
                            <textarea id="expl" name="comment" class="form-control" rows="12">You can do it, because i can't.</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Set up an event listener for the contact form.
        $('#assign').submit(function(event) {
            event.preventDefault();
            <?= ajax('POST', 'assignTicket', '$(this).serialize()', $ticket['ticket_id']) ?>
        });
    </script>
    <?php
}
?>
<script>
    function change(elem){
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>" + "ajax/getLevel/" + elem.val(),
            success: function(data)
            {
                if(data == 'solved'){
                    $('#expl').attr('name', 'solution');
                } else if(data == 'failed'){
                    $('#expl').attr('name', 'failed');
                }
            }
        });
    }

    // Set up an event listener for the contact form.
    $('#edit').submit(function(event) {
        event.preventDefault();
        <?= ajax('POST', 'editTicket', '$(this).serialize()', $ticket['ticket_id']) ?>
    });

    // Set up an event listener for the contact form.
    $('#share').submit(function(event) {
        event.preventDefault();
        <?= ajax('POST', 'shareTicket', '$(this).serialize()', $ticket['ticket_id']) ?>
    });

    // Set up an event listener for the contact form.
    $('#progress').submit(function(event) {
        event.preventDefault();
        <?= ajax('POST', 'insertProgress', '$(this).serialize()', $ticket['ticket_id']) ?>
    });
</script>