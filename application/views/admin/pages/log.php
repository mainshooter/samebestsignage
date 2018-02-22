<div class="table-responsive table-trigger">
    <table id="log" class="table table-hover" style="border-collapse: collapse!important;">
        <thead>
            <tr>
                <th>Nr.</th>
                <th>Action</th>
                <th>Description</th>
                <th>User/IP</th>
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
                    <?= $item['log_user'] ?>
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
            "order": [[ 0, "desc" ]]
        });
    });
</script>