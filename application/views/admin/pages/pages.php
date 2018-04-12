<link rel="stylesheet" type="text/css" href="<?= asset('datatables/css/dtBS4.css');?>">
<link type="text/css" rel="stylesheet" href="<?= asset('datatables/css/rBS4.css');?>"/>
<link type="text/css" rel="stylesheet" href="<?= asset('datatables/css/sBS4.css');?>"/>

<div class="row button-row">
    <a href="/admin/page/add" class="btn btn-outline-success">
        Add Page
    </a>
</div>

<div class="table-responsive">
    <table id="category" class="table table-hover" style="border-collapse: collapse!important;">
        <thead>
        <tr>
            <th>Nr.</th>
            <th>Name</th>
            <th>Link</th>
            <th>Type</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($array as $item) {
            ?>
            <tr onclick="sessionStorage.id = '<?= $item['page_id'] ?>'">
                <td>
                    <?= $item['page_id'] ?>
                </td>
                <td>
                    <?= ucfirst($item['page_name']) ?>
                </td>
                <td>
                    <?= $item['page_link'] ?>
                </td>
                <td>
                    <?= ucfirst($item['page_type']) ?>-End
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
<br/>
<span class="alert alert-danger">If there is no entry for a page file you MUST create it, otherwise you won't have the rights necessary.</span>

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
                <button onclick="window.location = '/admin/page/edit/' + sessionStorage.id" class="btn btn-outline-success unset-webkit-btn modal-btn">Edit</button>
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

<script src="<?= asset('datatables/js/jqDT.js');?>"></script>
<script src="<?= asset('datatables/js/dtBS4.js');?>"></script>
<script src="<?= asset('datatables/js/dtR.js');?>"></script>
<script src="<?= asset('datatables/js/rBS4.js');?>"></script>
<script src="<?= asset('datatables/js/dtS.js');?>"></script>