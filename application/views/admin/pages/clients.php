<link rel="stylesheet" type="text/css" href="<?= asset('datatables/css/dtBS4.css');?>">
<link type="text/css" rel="stylesheet" href="<?= asset('datatables/css/rBS4.css');?>"/>
<link type="text/css" rel="stylesheet" href="<?= asset('datatables/css/sBS4.css');?>"/>
<link type="text/css" rel="stylesheet" href="<?= asset('css/toggle.css');?>"/>

<div class="row button-row">
    <a href="/admin/client/add" class="btn btn-outline-success">
        Add Client
    </a>
</div>

<div class="table-responsive">
    <table id="status" class="table table-hover" style="border-collapse: collapse!important;">
        <thead>
        <tr>
            <th>Nr.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Address</th>
            <th>Zipcode</th>
            <th>State</th>
            <th>Country</th>
            <th>Active</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($array as $key => $item) {
            ?>
            <tr category="<?= $item['client_id'] ?>" onclick="sessionStorage.id = '<?= $item['client_id'] ?>'; $('#check-box').attr('checked', <?= ($item['client_active'] == true)? " true" : "false"; ?>);">
                <td>
                    <?= $item['client_id'] ?>
                </td>
                <td>
                    <?= ucfirst($item['client_name']) ?>
                </td>
                <td>
                    <?= $item['client_email'] ?>
                </td>
                <td>
                    <?= $item['client_tel'] ?>
                </td>
                <td>
                    <?= $item['client_street'].' '.$item['client_street_number'].', '.$item['client_city'] ?>
                </td>
                <td>
                    <?= $item['client_zipcode'] ?>
                </td>
                <td>
                    <?= $item['client_state'] ?>
                </td>
                <td>
                    <?= $item['client_country'] ?>
                </td>
                <td>
                    <?= $item['client_active'] == 1? 'Yes' : "No" ?>
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
            <div class="modal-body">
                <div class="form-check checkbox-slider--a checkbox-slider-md">
                    <label>
                        <input type="checkbox" id="check-box" onchange="toggleCat(sessionStorage.id)"><span></span>
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <!--
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="agree">
                    <label class="form-check-label" for="agree">I authorize this.</label>
                </div>
                -->
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                <button onclick="Href('edit')" class="btn btn-outline-success unset-webkit-btn modal-btn">Edit</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        var table = $('#status').DataTable( {
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

        window.location.href = '/admin/client/' + type + '/' + sessionStorage.id;
    }

    function toggleCat(id){
        <?= ajax('POST', 'toggleClient', '{"id": id}') ?>
    }
</script>

<script src="<?= asset('datatables/js/jqDT.js');?>"></script>
<script src="<?= asset('datatables/js/dtBS4.js');?>"></script>
<script src="<?= asset('datatables/js/dtR.js');?>"></script>
<script src="<?= asset('datatables/js/rBS4.js');?>"></script>
<script src="<?= asset('datatables/js/dtS.js');?>"></script>