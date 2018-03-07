<div>
    <form method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text"
                   name="username"
                   id="username"
                   class="form-control"
                   placeholder="Username"
                   autocomplete="username"
                   <?= (!empty($user))? 'value="' . $user['username'] . '"' : '' ?>
                   required>
        </div>
        <div class="form-group">
            <label for="password">Password
                <small>
                    ( must contain 8 or more characters that are of at least one number, and one uppercase and lowercase letter )
                </small>
                <?= (!empty($user))? alert('warning', '', 'Leave empty if you don\'t want to change the password!') : '' ?>
            </label>
            <input type="password"
                   name="password"
                   id="password"
                   class="form-control"
                   placeholder="Password"
                   min="8"
                   max="16"
                   autocomplete="new-password"
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                   <?= (empty($user))? 'required' : '' ?>>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password"
                   name="confirm_password"
                   id="confirm_password"
                   class="form-control"
                   placeholder="Confirm Password"
                   min="8"
                   max="16"
                   autocomplete="confirm-password"
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                   <?= (empty($user))? 'required' : '' ?>>
            <div class="cnfrm_pw"></div>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email"
                   name="email"
                   id="email"
                   class="form-control"
                   placeholder="Email"
                   autocomplete="email"
                   <?= (!empty($user))? 'value="' . $user['email'] . '"' : '' ?>
                   required>
        </div>

        <?php
        if (!empty($roles)) {
            ?>
            <div class="form-group">
                <label for="exampleSelect1">Right Level</label>
                <select class="form-control" id="exampleSelect1" name="role" required>
                    <?php
                    foreach ($roles as $role) {
                        ?>
                        <option value="<?= $role['id'] ?>" <?= (!empty($user) && ($user['role_id'] == $role['id'])) ? 'selected' : '' ?>><?= $role['name'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <?php
        }
        ?>
        <button type="submit" class="btn btn-outline-success">Submit</button>
    </form>
</div>
<script>
    $('#confirm_password').keyup(function() {
        if($(this).val() != $('#password').val()){
            if($(this).val().length > $('#password').val().length){
                $('.cnfrm_pw').html('<?= alert('danger', '', 'The password doesn&apos;t match and is to long'); ?>');
            } else{
                $('.cnfrm_pw').html('<?= alert('warning', '', 'The password doesn&apos;t match'); ?>');
            }
        } else {
            $('.cnfrm_pw').html('<?= alert('success', '', 'The password does match'); ?>');
        }
    });

    // Set up an event listener for the contact form.
    $('form').submit(function(event) {
        event.preventDefault();

        <?= (!empty($user))? "
        if ($('#password').val().length < 1){
            $('#password').prop('name', '').val('nochange');
            $('#confirm_password').prop('name', '').val('nochange');
        }
        ": '' ?>

        if(<?= (!empty($user))? "$('#password').val() != 'nochange' && ": '' ?>($('#confirm_password').val() != $('#password').val())){
            if($('#confirm_password').val().length > $('#password').val().length){
                $('.cnfrm_pw').html('<?= alert('danger', '', 'The password doesn&apos;t match and is to long'); ?>');
            } else{
                $('.cnfrm_pw').html('<?= alert('warning', '', 'The password doesn&apos;t match'); ?>');
            }
        } else {
            <?= ajax('POST', 'editUserFront', '$(this).serialize()', $user['id']) ?>
        }
    });
</script>