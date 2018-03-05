<div class="row button-row">
    <a href="/admin/right/add" class="btn btn-outline-success">
        Add Right Level
    </a>
</div>

<div class="table-responsive">
    <table id="category" class="table table-hover" style="border-collapse: collapse!important;">
        <thead>
        <tr>
            <th>Nr.</th>
            <th>Name</th>
            <th>Information</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($array as $item) {
            ?>
            <tr onclick="sessionStorage.id = '<?= $item['role_id'] ?>'">
                <td>
                    <?= $item['role_id'] ?>
                </td>
                <td>
                    <?= ucfirst($item['role_name']) ?>
                </td>
                <td>
                    <?= $item['role_info'] ?>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
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
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                <button onclick="window.location = '/admin/right/edit/' + sessionStorage.id" class="btn btn-outline-success unset-webkit-btn modal-btn">Edit</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        var table = $('#category').DataTable( {
            responsive: true,
            select: true
        });

        table.on( 'select', function ( e, dt, type, indexes ) {
            if ( type === 'row' ) {
                var data = table.cell('.selected', 0).data();

                $('.view-ticket').prop({'href': 'ticket/' + data});
                $('#modal').modal('show');
            }
        } );
    });
</script>