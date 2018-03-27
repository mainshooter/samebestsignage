<div class="card flex-row row">
    <div class="card-left col-sm-12 col-md-6 col-lg-4">
        <div class="card-body">
            <div class="row w-100">
                <h3 class="card-title"><?= $user['username'] ?></h3>
            </div>

            <h6 class="card-subtitle mb-2 text-muted">
                <?= $user['role_name'] ?>
            </h6>

        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">No. <?= $user['id'] ?></li>
            <li class="list-group-item">Email: <?= $user['email'] ?></li>
            <li class="list-group-item">Last IP: <?= !empty($user['date'])? $user['last_ip'] : 'none' ?></li>
            <li class="list-group-item">Last Login: <?= !empty($user['date'])? date("d F Y H:i", strtotime($user['date'])) : 'never' ?></li>
            <li class="list-group-item"> Created: <?= date("d F Y H:i", strtotime($user['created'])) ?></li>
            <li class="list-group-item">
                <?= ($user['modified'] != null)? 'Last edited: ' . date("d F Y H:i", strtotime($user['modified'])) : 'Not edited' ?>
            </li>
        </ul>
    </div>
    <div class="card-right col-sm-12 col-md-6 col-lg-8 position-relative">
        <div class="card-body">
            <div class="body-img"></div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header-img">
                            <h5 class="modal-title-img" style="text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;">Modal title</h5>
                            <button type="button" class="close-img" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-img">
                            <img class="modal-item-img d-block" src="" alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(function () {
                    $('.carousel-item:first-of-type').addClass('active');
                });
            </script>

            <div class="body-text">
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
                            <?= (!empty($user))? alert('info', '', 'Leave empty if you don\'t want to change the password!') : '' ?>
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
            </div>
        </div>
    </div>
</div>