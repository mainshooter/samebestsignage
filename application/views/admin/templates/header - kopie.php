<html>
<head>
    <title><?= $title ?> - IdSignage</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">

    <link href="<?= asset('css/main.css') ?>" type="text/css" rel="stylesheet"/>
    <link href="<?= asset('css/ticket.css') ?>" type="text/css" rel="stylesheet"/>
    <link href="<?= asset('css/sticky-footer.css') ?>" type="text/css" rel="stylesheet"/>
    <link href="<?= asset('css/icon.css') ?>" type="text/css" rel="stylesheet"/>
    <link href="<?= asset('css/check.css') ?>" type="text/css" rel="stylesheet"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <link href="<?= asset('bootstrap/css/bootstrap.min.css');?>" type="text/css" rel="stylesheet">
    <script src="<?= asset('bootstrap/js/bootstrap.min.js');?>"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">

    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css"/>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js"></script>

    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/select/1.2.4/css/select.bootstrap4.min.css"/>
    <script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.dotdotdot/3.2.1/jquery.dotdotdot.js"></script>

    <link rel="stylesheet" type="text/css" href=//cdn.datatables.net/select/1.2.4/css/select.bootstrap4.min.css">

    <script src="<?= asset('js/main.js');?>"></script>
    <script src="<?= asset('js/check.js');?>"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/home">
        <img src="<?= asset('img/logo-idsignage.png') ?>">
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
                    <a class="nav-link" href="/overview">Overview</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/completed">Completed</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Admin
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Settings
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <h6 class="dropdown-header">Settings</h6>
                                    <a class="dropdown-item" href="/settings/category">Category</a>
                                    <a class="dropdown-item" href="/settings/status">Status</a>
                                    <a class="dropdown-item" href="/settings/importance">Importance</a>
                                    <a class="dropdown-item" href="/settings/users">Users</a>
                                </div>
                            </li>
                            <?php
                            if ((int)$this_user['DX_role_id'] >= 2) {
                                ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Configuration
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <h6 class="dropdown-header">Configuration</h6>
                                        <a class="dropdown-item" href="/configuration/rights">Rights</a>
                                        <a class="dropdown-item" href="/configuration/">Mail</a>
                                        <a class="dropdown-item" href="/configuration/">Backup</a>
                                        <a class="dropdown-item" href="/configuration/">Other</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        My Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        <h6 class="dropdown-header">My Account</h6>
                        <a class="dropdown-item" href="/user/profile">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/auth/logout">Logout</a>
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
        <?php
        if (!empty($this_user['DX_logged_in']) && $this_user['DX_logged_in'] === true) {
            ?>
            <a href="/add/ticket"
               onmouseenter="$('#add-ticket').toggleClass('btn-outline-success-hover');"
               onmouseleave="$('#add-ticket').toggleClass('btn-outline-success-hover');">
                <ul class="navbar-nav">
                    <li class="nav-right nav-item active">
                        <div class="navbar-text">
                            Add ticket
                        </div>
                    </li>
                    <li class="nav-right nav-item active">
                        <i id="add-ticket" class="btn btn-outline-success rounded-circle material-icons">add</i>
                    </li>
                </ul>
            </a>
            <a href="/admin/dashboard">
                <ul class="navbar-nav">
                    <li class="nav-right nav-item active">
                        <i id="settings" class="btn btn-outline-danger rounded-circle material-icons">settings</i>
                    </li>
                </ul>
            </a>
            <?php
        }
        ?>

    </div>
</nav>
<div id="msg"></div>
<div class="container">
    <div class="page-title-head">
        <div class="page-title-title">
            <p class="lead" style="font-size: 2.5rem;"><?= $page_title ?>
                <br />
                <small class="lead">
                    <?= $page_title_desc ?>
                </small>
            </p>
        </div>
    </div>