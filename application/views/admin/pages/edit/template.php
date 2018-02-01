<link href="<?= asset("codemirror/lib/codemirror.css") ?>" rel="stylesheet">
<script src="<?= asset("codemirror/lib/codemirror.js") ?>"></script>
<script src="<?= asset("codemirror/mode/javascript/javascript.js") ?>"></script>

<div class="">
    <form method="post">
        <?php
        foreach ($array as $key => $item) {
            if ($key != 'id') {
                if ($key == 'subject'){
                    ?>
                    <div class="form-group">
                        <label for="<?= $key ?>"><?= ucfirst($key) ?></label>
                        <input type="text" class="form-control" id="<?= $key ?>" name="<?= $key ?>" value="<?= $item ?>">
                    </div>
                    <?php
                } elseif ($key == 'content'){
                    ?>
                    <div class="form-group">
                        <label for="<?= $key ?>"><?= ucfirst($key) ?></label>
                        <textarea  type="text" class="form-control" id="<?= $key ?>" name="<?= $key ?>" rows="25"><?= $item ?></textarea>
                    </div>
                    <?php
                }
            }
        }
        ?>
        <button type="submit" class="btn btn-outline-success">Save</button>
    </form>
</div>

<script>
    var editor = CodeMirror.fromTextArea(content, {
        lineNumbers: true,
        mode:  "htmlmixed",
        smartIndent: true,

    });
</script>

<script type="text/javascript">
    // Set up an event listener for the contact form.
    $('form').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>" + "ajax/updatemailtemp/<?= $array['id'] ?>",
            data: formData,
            success: function(data)
            {
                //console.log(data);
                var msg = $('#msg');
                msg.html(data);
            }
        })
    });
</script>