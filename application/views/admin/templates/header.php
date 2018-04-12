<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Jordi Schaap">
        <meta name="theme-color" content="#343a40">

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
              rel="stylesheet">

        <title>Dashboard Template for Bootstrap</title>

        <!-- Bootstrap core CSS -->
        <link href="<?= asset('bootstrap/css/bootstrap.min.css');?>" type="text/css" rel="stylesheet">


        <!-- Custom styles for this template -->
        <link href="<?= asset('css/icon.css.php') ?>" type="text/css" rel="stylesheet"/>
        <link href="<?= asset('css/check.css') ?>" type="text/css" rel="stylesheet"/>
        <link href="<?= asset("admin/css/dashboard.css") ?>" rel="stylesheet">
        <link href="<?= asset("admin/css/main.css") ?>" rel="stylesheet">
        <style type="text/css">/* Chart.js */
            @-webkit-keyframes chartjs-render-animation{
                from{opacity:0.99}
                to{opacity:1}
            }
            @keyframes chartjs-render-animation{
                from{opacity:0.99}
                to{opacity:1}
            }
            .chartjs-render-monitor{
                -webkit-animation:chartjs-render-animation 0.001s;
                animation:chartjs-render-animation 0.001s;
            }
        </style>

        <script src="<?= asset('jquery/jquery.js') ?>"></script>
    </head>
    <body>
    <div id="msg"></div>

    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <div class="nav-top">
            <div class="side-menu-trigger d-md-none d-block" onclick="$('.sidebar').toggle().toggleClass('d-none')">
                <i class="material-icons">menu</i>
            </div>
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/home">
                <?php
                if (empty($company)){
                    ?>
                    <img src="<?= asset('img/logo-idsignage.png') ?>" class="logo" alt="IdSignage">
                    <?php
                } else{
                    ?>
                    <?= $company ?>
                    <?php
                }
                ?>
            </a>
        </div>
        <input class="form-control form-control-dark w-100 d-none" type="text" placeholder="Search" aria-label="Search">
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="/logout">Sign out</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/dashboard">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/category">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                                Category's
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/status">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag" color="#384047"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line></svg>Statuses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/importance">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                                Importance levels
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/users">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users" color="#384047"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/clients">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home" color="#384047"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                Clients
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/rights">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                Rights
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/pages">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                                Pages
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/templates">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail" color="#384047" data-reactid="716"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                Mail Templates
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/mail">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail" color="#384047" data-reactid="716"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                Mail Configuration
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/log">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database" color="#384047"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>
                                Logs
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Quick Links</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="/home">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-down-left" color="#384047"><polyline points="9 10 4 15 9 20"></polyline><path d="M20 4v7a4 4 0 0 1-4 4H4"></path></svg>
                                Front-end
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/profile">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-down-left" color="#384047"><polyline points="9 10 4 15 9 20"></polyline><path d="M20 4v7a4 4 0 0 1-4 4H4"></path></svg>
                                Profile
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
