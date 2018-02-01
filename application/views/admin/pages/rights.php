<div class="row button-row">
    <button href="/admin/right/add" class="btn btn-outline-success" disabled>
        Add Right Level
    </button>
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
            <tr onclick="sessionStorage.id = '<?= $item['id'] ?>'">
                <td>
                    <?= $item['id'] ?>
                </td>
                <td>
                    <?= ucfirst($item['name']) ?>
                </td>
                <td>
                    <?= $item['info'] ?>
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
                <!--
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="agree">
                    <label class="form-check-label" for="agree">I authorize this.</label>
                </div>
                -->
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                <button onclick="Href('edit')" class="btn btn-outline-success unset-webkit-btn modal-btn" disabled>Edit</button>
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

    $('#agree').change(function () {
        if ($(this).prop('checked') === true){
            $(".modal-btn").removeAttr('disabled');
        } else {
            $(".modal-btn").attr('disabled', true);
        }
    });

    function Href(type) {
        $('#agree').prop('checked', false);
        $(".modal-btn").attr('disabled', true);

        window.location.href = '/admin/category/' + type + '/' + sessionStorage.id;
    }
</script>