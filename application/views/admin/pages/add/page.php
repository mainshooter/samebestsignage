<div class="page-container">
    <div class="page-content">
        <form id="form" method="post">
            <div class="form-group">
                <label for="exampleSelect1">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Type the name here" required>
            </div>

            <div class="form-group">
                <label for="exampleTextarea">Link</label>
                <textarea class="form-control" id="exampleTextarea" rows="3" name="link" required></textarea>
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <select id="type" class="form-control" name="type" required>
                    <?php
                    foreach ($types as $type){
                        ?>
                        <option value="<?= $type ?>"><?= ucfirst($type) ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Rights</label>
                <div class="checkboxes" style="padding: 0px 25px;">
                    <?php
                    foreach ($roles as $role){
                        ?>
                        <div class="row">
                            <label for="<?= $role['role_name'] ?>">
                                <span><?= $role['role_name'] ?></span>
                                <input type="checkbox" id="check" value="<?= $role['role_id'] ?>"
                                       onchange="
                                       if($(this).is(':checked')) {
                                            addValue('<?= $role["role_id"] ?>');
                                       } else {
                                            removeValue('<?= $role["role_id"] ?>')
                                       }
                                       " checked="true">
                            </label>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <input type="hidden" name="rights" id="rights" value='[<?php
                $end = key( array_slice( $roles, -1, 1, TRUE ) );
                foreach ($roles as $key => $role){
                    echo '"'.$role['role_id'].'"';
                    if ($end != $key){
                        echo ', ';
                    }
                }?>]'>
            </div>

            <button type="submit" class="btn btn-outline-success">Submit</button>
        </form>
    </div>
</div>
<script>
    $(function () {
        sessionStorage.array = $('#rights').val();
        $('#check').prop('checked', true);
    });

    Array.prototype.remove = function() {
        var what, a = arguments, L = a.length, ax;
        while (L && this.length) {
            what = a[--L];
            while ((ax = this.indexOf(what)) !== -1) {
                this.splice(ax, 1);
            }
        }
        return this;
    };

    function addValue(val){
        var array = JSON.parse(sessionStorage.array);
        array.push(val);
        sessionStorage.array = JSON.stringify(array);

        $('#rights').val(sessionStorage.array);
    }

    function removeValue(val){
        var array = JSON.parse(sessionStorage.array);
        array.remove(val);
        sessionStorage.array = JSON.stringify(array);

        $('#rights').val(sessionStorage.array);
    }

    // Set up an event listener for the contact form.
    $('form').submit(function(event) {
        event.preventDefault();
        <?= ajax('POST', 'addPage', '$(this).serialize()') ?>
    });
</script>