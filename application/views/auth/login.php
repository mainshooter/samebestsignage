<div class="login align-middle">
    <form id="form-reset" method="post">
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
            <a href="/forgotpassword/sent">Forgot password?</a>
        </div>

        <button type="submit" class="btn btn-outline-success">Login</button>

    </form>
</div>
<script>
    // Set up an event listener for the contact form.
    $('#form-reset').submit(function(event) {
        event.preventDefault();
        <?= noRightsAjax('POST', 'login','$(this).serialize()') ?>
    });
</script>
