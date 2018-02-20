<div class="ticket-container col-12">
    <div class="tickets-body row justify-content-center">
        <?= $table ?>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                <a href="ticket/" type="button" class="btn btn-outline-success unset-webkit-btn view-ticket">View Ticket</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('table').addClass('table table-hover');
        var table = $('table').DataTable( {
            "columns": [
                { "title": "Ticket" },
                { "title": "Client" },
                { "title": "Category" },
                { "title": "Problem" },
                { "title": "Created" },
                { "title": "Completed" },
                { "title": "Status" },
                { "title": "Handler" }
            ],
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