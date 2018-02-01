<div class="card flex-row row">
    <div class="card-left col-sm-12 col-md-6 col-lg-4">
        <div class="card-body">
            <h3 class="card-title"><?= $ticket['alert_name'] ?></h3>
            <h6 class="card-subtitle mb-2 text-muted" style="color:<?= $ticket['importance_color'] ?>!important;">
                <?= $ticket['importance_name'] ?>
            </h6>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">No. <?= $ticket['ticket_id'] ?></li>
            <li class="list-group-item"><?= $ticket['status_name'] ?></li>
            <li class="list-group-item"> Created <?= date("d F Y H:m", strtotime($ticket['ticket_created_at'])) ?></li>
            <li class="list-group-item">
                <?= ($ticket['ticket_edited_at'] != null)? 'Last edited ' . date("d F Y H:m", strtotime($ticket['ticket_edited_at'])) : 'Not edited' ?>
            </li>
            <li class="list-group-item">
                <?= ($ticket['ticket_completed_at'] != null)? 'Completed ' . date("d F Y H:m", strtotime($ticket['ticket_completed_at'])) : 'Not completed' ?>
            </li>

            <li class="list-group-item">
                <?php
                if (!empty($ticket['ticket_completed_at'])){
                    ?>
                    <a href="#" onclick="$('#ticket-modal-restore').modal('toggle')" class="btn btn-outline-success">Restore</a>
                    <?php
                } else{
                    ?>
                    <a href="#" onclick="$('#ticket-modal').modal('toggle')" class="btn btn-outline-success">Complete</a>
                    <?php
                }
                ?>
            </li>
            <li class="list-group-item">
                <a href="#" onclick="$('#ticket-modal-problem').modal('toggle')" class="btn btn-outline-warning">Edit</a>
            </li>
        </ul>
    </div>
    <div class="card-right col-sm-12 col-md-6 col-lg-8">
        <div class="card-body">
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
    </div>
</div>

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
                                ?>
                                <option value="<?= $status['status_id'] ?>" level="<?= $status['status_level'] ?>" <?= ($status['status_level'] == $ticket['status_level'])? 'disabled selected' : '' ?> <?= ($status['status_level'] == 'pending')? 'disabled' : '' ?>><?= $status['status_name'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="expl">Explanation <small>( Explain how you solved this ticket, and if it cant be solved explain why not )</small></label>
                        <textarea id="expl" name="" class="form-control" rows="12">Just had to turn it off and on again :)</textarea>
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
<!--
<div class="modal fade" id="ticket-modal-archive" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form id="archive" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Archive ticket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-msg"></div>
                    Are you sure that you want to archive this ticket
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success">Yes i'm sure</button>
                </div>
            </form>
        </div>
    </div>
</div>
-->

<script>
    function change(elem){
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>" + "ajax/getlevel/" + elem.val(),
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
    $('#complete').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>" + "ajax/completeticket/<?= $ticket['ticket_id'] ?>",
            data: formData,
            success: function(data)
            {
                var msg = $('.modal-msg');
                msg.html(data);
            }
        })
    });

    // Set up an event listener for the contact form.
    $('#edit').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>" + "ajax/editticket/<?= $ticket['ticket_id'] ?>",
            data: formData,
            success: function(data)
            {
                var msg = $('.modal-msg');
                msg.html(data);
            }
        })
    });

    // Set up an event listener for the contact form.
    $('#restore').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>" + "ajax/restoreticket/<?= $ticket['ticket_id'] ?>",
            data: formData,
            success: function(data)
            {
                var msg = $('.modal-msg');
                msg.html(data);
            }
        })
    });
</script>