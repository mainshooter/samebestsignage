<link href="<?= asset("codemirror/lib/codemirror.css") ?>" rel="stylesheet">
<script src="<?= asset("codemirror/lib/codemirror.js") ?>"></script>
<script src="<?= asset("codemirror/mode/javascript/javascript.js") ?>"></script>

<div class="">
    <form method="post">
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject">
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea  type="text" class="form-control" id="content" name="content" rows="25"></textarea>
        </div>

        <button type="submit" class="btn btn-outline-success">Save</button>
    </form>
</div>

<script>
    var editor = CodeMirror.fromTextArea(content, {
        lineNumbers: true,
        mode:  "htmlmixed",
        smartIndent: true,

    });

    // Set up an event listener for the contact form.
    $('form').submit(function(event) {
        event.preventDefault();
        <?= ajax('POST', 'addmailtemp', '$(this).serialize()') ?>
    });
</script>