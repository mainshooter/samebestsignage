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
                    <?= date('d F Y H:m:s', strtotime($item['log_date'])) ?>
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