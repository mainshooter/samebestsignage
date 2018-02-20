<div class="login align-middle">
    <form id="form-reset" method="post">
        <div class="form-group">
            <label for="password">Password
                <small>
                    ( must contain 8 or more characters that are of at least one number, and one uppercase and lowercase letter )
                </small>
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
            <div class="cnfrm_pw"></div>
        </div>

        <button type="submit" class="btn btn-outline-success">Save Changes</button>

    </form>
</div>
<script>
    var pass = $('#password');
    var cnfrm = $('#confirm_password');
    var cnfrmmsg = $('.cnfrm_pw');

    cnfrm.keyup(function() {
        if($(this).val() != pass.val()){
            if($(this).val().length > pass.val().length){
                cnfrmmsg.html('<?= alert('danger', '', 'The password doesn&apos;t match and is to long'); ?>');
            } else{
                cnfrmmsg.html('<?= alert('warning', '', 'The password doesn&apos;t match'); ?>');
            }
        } else {
            cnfrmmsg.html('<?= alert('success', '', 'The password does match'); ?>');
        }
    });

    if(cnfrm.val() != pass.val()){
        if(cnfrm.val().length > pass.val().length){
            cnfrmmsg.html('<?= alert('danger', '', 'The password doesn&apos;t match and is to long'); ?>');
        } else{
            cnfrmmsg.html('<?= alert('warning', '', 'The password doesn&apos;t match'); ?>');
        }
    } else {
        $('#form-reset').submit(function(event) {
            event.preventDefault();
            <?= resetPass($user['id'], '$(this).serialize()') ?>
        });
    }

</script>
