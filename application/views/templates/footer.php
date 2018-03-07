</div>
<loader style="display: none">
    <div id="demo">
        <div class="check demo " onclick="LazyMode()">
            <div class="check-child check-success rounded-circle loader"></div>
        </div>
        <div class="check-content loader-child demo" onclick="LazyMode()">
            <i class="material-icons">
                cached
            </i>
        </div>
    </div>
</loader>
<footer class="footer">
    <div class="container">
        <span class="text-muted">&copy;IdSignage <?= date('Y') ?></span>
        <span class="text-muted float-right font-italic d-none d-md-block" style="cursor: pointer;" onclick="LazyMode()"><u>Lazy Mode</u></span>
    </div>
</footer>
<?php if (!empty($this_user['DX_logged_in']) && $this_user['DX_logged_in'] === true){ ?>
<!-- Modal -->
<div class="modal fade" id="add-ticket-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="add-ticket-form" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Ticket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="client">Client</label>
                        <select class="form-control" id="client" name="client" required>
                            <option selected disabled>Choose a client</option>
                            <?php
                            foreach ($clients as $item){
                                ?>
                                <option value="<?= $item['client_id'] ?>"><?= ucfirst($item['client_name']) ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="handler">Handler</label>
                        <select class="form-control" id="handler" name="user" required>
                            <option selected disabled>Choose a user</option>
                            <?php
                            foreach ($users as $item){
                                ?>
                                <option value="<?= $item['id'] ?>"><?= ucfirst($item['username']). ': ' .$item['email'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option selected disabled>Choose a category</option>
                            <?php
                            foreach ($categorys as $item){
                                ?>
                                <option value="<?= $item['cat_id'] ?>"><?= $item['cat_name'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="ticket-status" required>
                            <?php
                            foreach ($statuses as $item){
                                ?>
                                <option value="<?= $item['status_id'] ?>" <?= ($item['status_name'] == 'Pending')? 'selected' : '' ?>><?= $item['status_name'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="importance">Importance</label>
                        <select class="form-control" id="importance" name="importance" required>
                            <option selected disabled>Choose a level</option>
                            <?php
                            foreach ($importances as $item){
                                ?>
                                <option value="<?= $item['importance_id'] ?>"><?= $item['importance_name'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image">Images</label>
                        <input type="file" accept="image/*" class="form-control" id="image" name="images" multiple>
                    </div>

                    <div class="form-group">
                        <label for="problem">Problem</label>
                        <textarea class="form-control" id="problem" rows="3" name="problem" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success">Save</button>
                </div>
            </form>
            <script>
                // Set up an event listener for the contact form.
                $('#add-ticket-form').submit(function(event) {
                    event.preventDefault();

                    var data = new FormData();
                    data.append('client', $('[name="client"]').val());
                    data.append('user', $('[name="user"]').val());
                    data.append('category', $('[name="category"]').val());
                    data.append('status', $('[name="ticket-status"]').val());
                    data.append('importance', $('[name="importance"]').val());
                    data.append('problem', $('[name="problem"]').val());

                    var ins = document.getElementById('image').files.length;
                    for (var x = 0; x < ins; x++) {
                        data.append("image[]", document.getElementById('image').files[x]);
                    }

                    <?= ajax('POST', 'addTicket', 'data', null, null, 'enctype: "multipart/form-data", processData: false, contentType: false,') ?>
                });
            </script>
        </div>
    </div>
</div>
<?php } ?>
</body>
</html>