<link rel="stylesheet" type="text/css" href="<?= asset('datatables/css/dtBS4.css');?>">
<link type="text/css" rel="stylesheet" href="<?= asset('datatables/css/rBS4.css');?>"/>
<link type="text/css" rel="stylesheet" href="<?= asset('datatables/css/sBS4.css');?>"/>

<div class="table-responsive table-trigger">
    <table id="log" class="table table-hover" style="border-collapse: collapse!important;">
        <thead>
            <tr>
                <th>Nr.</th>
                <th>Action</th>
                <th>Description</th>
                <th>User/IP</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach ($array as $key => $item) {
            ?>
            <tr>
                <td>
                    <?= ucfirst($item['log_id']) ?>
                </td>
                <td>
                    <?= ucfirst($item['log_action']) ?>
                </td>
                <td>
                    <?= $item['log_desc'] ?>
                </td>
                <td>
                    <?= (is_numeric($item['log_user']))? "<a href='/admin/user/view/".$item['log_user']."'>User no.".$item['log_user']."</a>" : $item['log_user'] ?>
                </td>
                <td>
                    <?= date('d F Y H:i:s', strtotime($item['log_date'])) ?>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(function() {
        var table = $('#log').DataTable( {
            responsive: true,
            "pageLength": 16,
            "order": [[ 0, "desc" ]]
        });
    });
</script>

<script src="<?= asset('datatables/js/jqDT.js');?>"></script>
<script src="<?= asset('datatables/js/dtBS4.js');?>"></script>
<script src="<?= asset('datatables/js/dtR.js');?>"></script>
<script src="<?= asset('datatables/js/rBS4.js');?>"></script>
<script src="<?= asset('datatables/js/dtS.js');?>"></script>