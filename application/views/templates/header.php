<html lang="en">
<head>
    <title><?= $title ?> - IdSignage</title>


    <link href="<?= asset('css/main.css') ?>" type="text/css" rel="stylesheet"/>
    <link href="<?= asset('css/ticket.css') ?>" type="text/css" rel="stylesheet"/>
    <link href="<?= asset('css/sticky-footer.css') ?>" type="text/css" rel="stylesheet"/>
    <link href="<?= asset('css/icon.css.php') ?>" type="text/css" rel="stylesheet"/>
    <link href="<?= asset('css/check.css') ?>" type="text/css" rel="stylesheet"/>

    <script src="<?= asset('jquery/jquery.js') ?>"></script>
    <script src="<?= asset('popper/popper.js') ?>" ></script>

    <link href="<?= asset('bootstrap/css/bootstrap.min.css');?>" type="text/css" rel="stylesheet">
    <script src="<?= asset('bootstrap/js/bootstrap.min.js');?>"></script>

    <script src="<?= asset('js/main.js');?>"></script>
    <script src="<?= asset('js/check.js');?>"></script>

    <link href="<?= asset('css/dark-theme.css') ?>" type="text/css" rel="stylesheet"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#343a40">
    <meta name="author" content="Jordi Schaap">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="/home">
        <img src="<?= asset('img/logo-idsignage.png') ?>" alt="IdSignage">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php
            if (!empty($this_user['DX_logged_in']) && $this_user['DX_logged_in'] === true) {
                ?>
                <li class="nav-item active">
                    <a class="nav-link" href="/home">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/mytickets">My tickets</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/completed">Completed tickets</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/overview">All tickets</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        My Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        <h6 class="dropdown-header">My Account</h6>
                        <a class="dropdown-item" href="/user/profile">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/ajaxlogin/logout">Logout</a>
                    </div>
                </li>
                <?php
            } else {
                ?>
                <li class="nav-item"><a class="nav-link active" href="/auth/login">Login</a></li>
                <?php
            }
            ?>
        </ul>
        <div class="menu-icons dropdown">
            <?php
            if (!empty($this_user['DX_logged_in']) && $this_user['DX_logged_in'] === true) {
                ?>
                <a href="#" onclick="$('#add-ticket-modal').modal('toggle')"
                   onmouseenter="$('#add-ticket').toggleClass('btn-outline-success-hover');"
                   onmouseleave="$('#add-ticket').toggleClass('btn-outline-success-hover');">
                    <ul class="navbar-nav add-ticket-row">
                        <li class="nav-right nav-item active">
                            <div class="navbar-text">
                                Add ticket
                            </div>
                        </li>
                        <li class="nav-right nav-item active">
                            <i id="add-ticket" class="btn btn-outline-success rounded-circle material-icons">&#xE145;</i>
                        </li>
                    </ul>
                </a>
                <ul class="navbar-nav">
                    <li class="nav-right nav-item active">
                        <button class="dropdown-toggle icon-dropdown position-relative" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="$('#alerts').toggleClass('show')">
                            <span class="alert-count badge badge-danger"></span>
                            <i id="settings" class="btn btn-outline-warning rounded-circle material-icons">&#xE002;</i>
                        </button>
                    </li>
                </ul>
                <?php
                if ((int)$this_user['DX_role_id'] >= 2) {
                    ?>
                    <a href="/admin/dashboard">
                        <ul class="navbar-nav">
                            <li class="nav-right nav-item active">
                                <i class="btn btn-outline-danger rounded-circle material-icons">&#xE8B8;</i>
                            </li>
                        </ul>
                    </a>
                    <?php
                }
            }
            ?>
            <div id="alerts" class="dropdown-menu dropdown-menu-right alert-dropdown" aria-labelledby="dropdownMenuButton">
                <div class="dropdown-head">

                    <h6 class="dropdown-header">
                        <span>Alerts</span>
                        <span class="float-right">
                                                <a class="set-read" onclick="setReadAll()">
                                                    Mark as read
                                                </a>
                                            </span>
                    </h6>
                    <script>
                        function setReadAll() {
                            <?= ajax('POST', 'markAsReadAll', '[]') ?>
                        }
                        function setRead(alert_id, customHref) {
                            <?= ajax('POST', 'markAsRead', '{id : alert_id}', null, 'customHref') ?>
                        }
                    </script>
                </div>
                <div class="dropdown-divider"></div>
                <div class="dropdown-body">
                    <?php
                    foreach ($alerts as $alert){
                        if ($alert['alert_seen'] == 0) {
                            ?>
                            <a href="#" onclick="setRead(<?= $alert['alert_id'] ?>, '<?= $alert['alert_href'] ?>')" class="alert-item dropdown-item unseen">
                                <div class="alert-icon">
                                    <i class="material-icons"><?= $alert['alert_icon'] ?></i>
                                </div>
                                <div class="alert-content">
                                    <div class="alert-title">
                                        <?= $alert['alert_title'] ?>
                                    </div>

                                    <div class="alert-desc">
                                        <?= $alert['alert_desc'] ?>
                                    </div>
                                </div>
                            </a>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</nav>
<div id="msg"></div>
<div class="container" style="padding-top: 30px">
