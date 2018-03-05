<div>
    <dl class="row">
        <dt class="col-sm-2">Username</dt>
        <dd class="col-sm-10"><?= $user['username'] ?></dd>

        <dt class="col-sm-2">Email</dt>
        <dd class="col-sm-10"><?= $user['email'] ?></dd>

        <dt class="col-sm-2">Right Level</dt>
        <dd class="col-sm-10"><?= $user['role_name'] ?></dd>

        <dt class="col-sm-2">Last IP</dt>
        <dd class="col-sm-10"><?= !empty($user['date'])? $user['last_ip'] : 'None' ?></dd>

        <dt class="col-sm-2">Last Login </dt>
        <dd class="col-sm-10"><?= !empty($user['date'])? date("d F Y H:m", strtotime($user['date'])): 'Never' ?></dd>

        <dt class="col-sm-2">Created</dt>
        <dd class="col-sm-10"><?= date("d F Y H:m", strtotime($user['created'])) ?></dd>

        <?php
        if ($this_user['DX_role_id'] >= 3) {
            ?>
            <dt class="col-sm-2">Hash</dt>
            <dd class="col-sm-10"><?= (!empty($user['hash'])) ? $user['hash'] : 'Not Set' ?></dd>
            <?php
        }
        ?>
    </dl>
</div>