<div class="login align-middle">
    <form id="form-login" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text"
                   id="username"
                   class="form-control"
                   name="username"
                   placeholder="Username"
                   autocomplete="username"
                   required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password"
                   id="password"
                   class="form-control"
                   name="password"
                   placeholder="Password"
                   autocomplete="current-password"
                   required>
        </div>

        <div class="form-group">
            <?php echo anchor($this->dx_auth->forgot_password_uri, 'Forgot password');?>
        </div>

        <button type="submit" class="btn btn-outline-success">Login</button>

    </form>
</div>
<script>
    // Set up an event listener for the contact form.
    $('form').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>ajaxlogin/login",
            data: formData,
            success: function(data)
            {
                console.log(data);
                var msg = $('#msg');
                msg.html(data);
            },
            error: function(data)
            {
                var msg = $('#msg');
                msg.html(data);
            }
        })
    });
</script>
