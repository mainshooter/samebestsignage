<div class="col-12" style="margin-bottom: 20px">
    <form id="config" method="post">
        <?php
        foreach ($array as $key => $item) {
            if ($key != 'id') {
                ?>
                <div class="form-group">
                    <label for="<?= $key ?>"><?= ucfirst($key) ?></label>
                    <input type="text" class="form-control" id="<?= $key ?>" name="<?= $key ?>" value="<?= $item ?>">
                </div>
                <?php
            }
        }
        ?>
        <button type="button" onclick="$('#modal').modal('show');" class="btn btn-outline-danger">Reset Defaults</button>
        <button type="submit" class="btn btn-outline-success">Save</button>
    </form>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" id="reset" class="btn btn-outline-success" data-dismiss="modal">Close</button>
                <button onclick="Reset()" id="reset" class="btn btn-outline-danger unset-webkit-btn modal-btn">Reset</button>
            </div>
        </div>
    </div>
</div>



<script>
    // Set up an event listener for the contact form.
    $('#config').submit(function(event) {
        event.preventDefault();
        <?= ajax('POST', 'updateMail', '$(this).serialize()') ?>
    });
    // Set up an event listener for the contact form.
    $('#reset').submit(function(event) {
        event.preventDefault();
    });

    function Reset() {
        $('#modal').modal('hide');
        <?= ajax('POST', 'resetMail') ?>
    }
</script>