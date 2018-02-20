<div class="login align-middle">
    <form id="form-login" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email"
                   id="email"
                   class="form-control"
                   name="email"
                   placeholder="Email"
                   autocomplete="email"
                   required>
        </div>

        <button type="submit" class="btn btn-outline-success">Send Email</button>

    </form>
</div>
<script>
    // Set up an event listener for the contact form.
    $('form').submit(function(event) {
        event.preventDefault();
        <?= forgot('$(this).serialize()') ?>
    });
</script>
