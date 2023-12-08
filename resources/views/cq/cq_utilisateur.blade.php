<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>ProUI - Responsive Bootstrap Admin Template</title>

        <meta name="description" content="ProUI is a Responsive Bootstrap Admin Template created by pixelcave and published on Themeforest.">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="{{ asset('img/favicon') }}">
        <link rel="apple-touch-icon" href="{{ asset('img/icon57.png') }}" sizes="57x57">
        <link rel="apple-touch-icon" href="{{ asset('img/icon72.png') }}" sizes="72x72">
        <link rel="apple-touch-icon" href="{{ asset('img/icon76.png') }}" sizes="76x76">
        <link rel="apple-touch-icon" href="{{ asset('img/icon114.png') }}" sizes="114x114">
        <link rel="apple-touch-icon" href="{{ asset('img/icon120.png') }}" sizes="114x114">
        <link rel="apple-touch-icon" href="{{ asset('img/icon114.png') }}" sizes="120x120">
        <link rel="apple-touch-icon" href="{{ asset('img/icon152.png') }}" sizes="144x144">
        <link rel="apple-touch-icon" href="{{ asset('img/icon180.png') }}" sizes="152x152">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="{{ asset('css/plugins.css') }}">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">

        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="{{ asset('css/themes.css') }}">
        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) -->
        <script src="{{ asset('js/vendor/modernizr.min.js') }}"></script>

    </head>
    <body>

        <div id="page-wrapper">
            <!-- Preloader -->
            <!-- Preloader functionality (initialized in js/app.js) - pageLoading() -->
            <!-- Used only if page preloader is enabled from inc/config (PHP version) or the class 'page-loading' is added in #page-wrapper element (HTML version) -->
            <div class="preloader themed-background">
                <h1 class="push-top-bottom text-light text-center"><strong>Pro</strong>UI</h1>
                <div class="inner">
                    <h3 class="text-light visible-lt-ie10"><strong>Loading..</strong></h3>
                    <div class="preloader-spinner hidden-lt-ie10"></div>
                </div>
            </div>
            <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">
                <!-- Alternative Sidebar -->
                <div id="sidebar-alt">
                    <!-- Wrapper for scrolling functionality -->
                    <div id="sidebar-alt-scroll">
                        <!-- Sidebar Content -->
                        <div class="sidebar-content">
                            <!-- Chat -->
                            <!-- Chat demo functionality initialized in js/app.js -> chatUi() -->
                            <a href="page_ready_chat.html" class="sidebar-title">
                                <i class="gi gi-comments pull-right"></i> <strong>Chat</strong>UI
                            </a>
                            <!-- Chat Users -->
                            <ul class="chat-users clearfix">
                                <li>
                                    <a href="javascript:void(0)" class="chat-user-online">
                                        <span></span>
                                        <img src="{{ asset('img/placeholders/avatars/avatar12.jpg') }}" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="chat-user-online">
                                        <span></span>
                                        <img src="{{ asset('img/placeholders/avatars/avatar15.jpg') }}" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="chat-user-online">
                                        <span></span>
                                        <img src="{{ asset('img/placeholders/avatars/avatar10.jpg') }}" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="chat-user-online">
                                        <span></span>
                                        <img src="{{ asset('img/placeholders/avatars/avatar4.jpg') }}" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="chat-user-away">
                                        <span></span>
                                        <img src="img/placeholders/avatars/avatar7.jpg" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="chat-user-away">
                                        <span></span>
                                        <img src="{{ asset('img/placeholders/avatars/avatar9.jpg') }}" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="chat-user-busy">
                                        <span></span>
                                        <img src="{{ asset('img/placeholders/avatars/avatar16.jpg') }}" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <span></span>
                                        <img src="{{ asset('img/placeholders/avatars/avatar1.jpg') }}" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <span></span>
                                        <img src="{{ asset('img/placeholders/avatars/avatar4.jpg') }}" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <span></span>
                                        <img src="{{ asset('img/placeholders/avatars/avatar3.jpg') }}" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <span></span>
                                        <img src="{{ asset('img/placeholders/avatars/avatar13.jpg') }}" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <span></span>
                                        <img src="{{ asset('img/placeholders/avatars/avatar5.jpg') }}" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                            </ul>
                            <!-- END Chat Users -->

                            <!-- Chat Talk -->
                            <div class="chat-talk display-none">
                                <!-- Chat Info -->
                                <div class="chat-talk-info sidebar-section">
                                    <button id="chat-talk-close-btn" class="btn btn-xs btn-default pull-right">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <img src="{{ asset('img/placeholders/avatars/avatar5.jpg') }}" alt="avatar" class="img-circle pull-left">
                                    <strong>John</strong> Doe
                                </div>
                                <!-- END Chat Info -->

                                <!-- Chat Messages -->
                                <ul class="chat-talk-messages">
                                    <li class="text-center"><small>Yesterday, 18:35</small></li>
                                    <li class="chat-talk-msg animation-slideRight">Hey admin?</li>
                                    <li class="chat-talk-msg animation-slideRight">How are you?</li>
                                    <li class="text-center"><small>Today, 7:10</small></li>
                                    <li class="chat-talk-msg chat-talk-msg-highlight themed-border animation-slideLeft">I'm fine, thanks!</li>
                                </ul>
                                <!-- END Chat Messages -->

                                <!-- Chat Input -->
                                <form action="index.html" method="post" id="sidebar-chat-form" class="chat-form">
                                    <input type="text" id="sidebar-chat-message" name="sidebar-chat-message" class="form-control form-control-borderless" placeholder="Type a message..">
                                </form>
                                <!-- END Chat Input -->
                            </div>
                            <!--  END Chat Talk -->
                            <!-- END Chat -->

                            <!-- Activity -->
                            <a href="javascript:void(0)" class="sidebar-title">
                                <i class="fa fa-globe pull-right"></i> <strong>Activity</strong>UI
                            </a>
                            <div class="sidebar-section">
                                <div class="alert alert-danger alert-alt">
                                    <small>just now</small><br>
                                    <i class="fa fa-thumbs-up fa-fw"></i> Upgraded to Pro plan
                                </div>
                                <div class="alert alert-info alert-alt">
                                    <small>2 hours ago</small><br>
                                    <i class="gi gi-coins fa-fw"></i> You had a new sale!
                                </div>
                                <div class="alert alert-success alert-alt">
                                    <small>3 hours ago</small><br>
                                    <i class="fa fa-plus fa-fw"></i> <a href="page_ready_user_profile.html"><strong>{{\Illuminate\Support\Facades\Auth::User()->name}}</strong></a> would like to become friends!<br>
                                    <a href="javascript:void(0)" class="btn btn-xs btn-primary"><i class="fa fa-check"></i> Accept</a>
                                    <a href="javascript:void(0)" class="btn btn-xs btn-default"><i class="fa fa-times"></i> Ignore</a>
                                </div>
                                <div class="alert alert-warning alert-alt">
                                    <small>2 days ago</small><br>
                                    Running low on space<br><strong>18GB in use</strong> 2GB left<br>
                                    <a href="page_ready_pricing_tables.html" class="btn btn-xs btn-primary"><i class="fa fa-arrow-up"></i> Upgrade Plan</a>
                                </div>
                            </div>
                            <!-- END Activity -->

                            <!-- Messages -->
                            <a href="page_ready_inbox.html" class="sidebar-title">
                                <i class="fa fa-envelope pull-right"></i> <strong>Messages</strong>UI (5)
                            </a>
                            <div class="sidebar-section">
                                <div class="alert alert-alt">
                                    Debra Stanley<small class="pull-right">just now</small><br>
                                    <a href="page_ready_inbox_message.html"><strong>New Follower</strong></a>
                                </div>
                                <div class="alert alert-alt">
                                    Sarah Cole<small class="pull-right">2 min ago</small><br>
                                    <a href="page_ready_inbox_message.html"><strong>Your subscription was updated</strong></a>
                                </div>
                                <div class="alert alert-alt">
                                    Bryan Porter<small class="pull-right">10 min ago</small><br>
                                    <a href="page_ready_inbox_message.html"><strong>A great opportunity</strong></a>
                                </div>
                                <div class="alert alert-alt">
                                    Jose Duncan<small class="pull-right">30 min ago</small><br>
                                    <a href="page_ready_inbox_message.html"><strong>Account Activation</strong></a>
                                </div>
                                <div class="alert alert-alt">
                                    Henry Ellis<small class="pull-right">40 min ago</small><br>
                                    <a href="page_ready_inbox_message.html"><strong>You reached 10.000 Followers!</strong></a>
                                </div>
                            </div>
                            <!-- END Messages -->
                        </div>
                        <!-- END Sidebar Content -->
                    </div>
                    <!-- END Wrapper for scrolling functionality -->
                </div>
                <!-- END Alternative Sidebar -->

                <!-- Main Sidebar -->
                <div id="sidebar">
                    <!-- Wrapper for scrolling functionality -->
                    <div id="sidebar-scroll">
                        <!-- Sidebar Content -->
                        <div class="sidebar-content">
                            <!-- Brand -->
                            <a href="index.html" class="sidebar-brand">
                                <i class="gi gi-flash"></i><span class="sidebar-nav-mini-hide"><strong>CRM</strong>UCC</span>
                            </a>
                            <!-- END Brand -->

                            <!-- User Info -->
                            <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                                <div class="sidebar-user-avatar">
                                    <a href="page_ready_user_profile.html">
                                        <img src="{{ asset('img/placeholders/avatars/avatar2.jpg') }}" alt="avatar">
                                    </a>
                                </div>
                                <div class="sidebar-user-name">{{\Illuminate\Support\Facades\Auth::User()->name}}</div>
                                <div class="sidebar-user-links">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-toggle="tooltip" data-placement="bottom" title="Logout"><i class="gi gi-exit"></i></a>
                                </div>
                            </div>
                            <ul class="sidebar-section sidebar-themes clearfix sidebar-nav-mini-hide">

                                <li>
                                    <a href="javascript:void(0)" class="themed-background-dark-night themed-border-night" data-theme="css/themes/night.css" data-toggle="tooltip" title="Night"></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-dark-amethyst themed-border-amethyst" data-theme="css/themes/amethyst.css" data-toggle="tooltip" title="Amethyst"></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-dark-modern themed-border-modern" data-theme="css/themes/modern.css" data-toggle="tooltip" title="Modern"></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-dark-autumn themed-border-autumn" data-theme="css/themes/autumn.css" data-toggle="tooltip" title="Autumn"></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-dark-flatie themed-border-flatie" data-theme="css/themes/flatie.css" data-toggle="tooltip" title="Flatie"></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-dark-spring themed-border-spring" data-theme="css/themes/spring.css" data-toggle="tooltip" title="Spring"></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-dark-fancy themed-border-fancy" data-theme="css/themes/fancy.css" data-toggle="tooltip" title="Fancy"></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-dark-fire themed-border-fire" data-theme="css/themes/fire.css" data-toggle="tooltip" title="Fire"></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-dark-coral themed-border-coral" data-theme="css/themes/coral.css" data-toggle="tooltip" title="Coral"></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-dark-lake themed-border-lake" data-theme="css/themes/lake.css" data-toggle="tooltip" title="Lake"></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-dark-forest themed-border-forest" data-theme="css/themes/forest.css" data-toggle="tooltip" title="Forest"></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-dark-waterlily themed-border-waterlily" data-theme="css/themes/waterlily.css" data-toggle="tooltip" title="Waterlily"></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-dark-emerald themed-border-emerald" data-theme="css/themes/emerald.css" data-toggle="tooltip" title="Emerald"></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-dark-blackberry themed-border-blackberry" data-theme="css/themes/blackberry.css" data-toggle="tooltip" title="Blackberry"></a>
                                </li>
                            </ul>
                            <!-- END Theme Colors -->

                            <!-- Sidebar Navigation -->
                            <ul class="sidebar-nav">
                                <li>
                                    <a href="{{ route('cq.dashboard') }}" class=""><i class="gi gi-stopwatch sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Dashboard</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('cq.contrat') }}" class=""><i class="gi gi-notes_2 sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Prospect</span></a>

                                </li>
                                <li>
                                    <a href="/all-leads" class=""><i class="gi gi-table sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Liste Prospects</span></a>
                                </li>
                                <li>
                                    <a href="/lists-devis-all" class=""><i class="gi gi-table sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Devis</span></a>
                                </li>
                                <li>
                                    <a href="/utilisateur-crm" class=" active"><i class="gi gi-user sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Utilisateur CRM</span></a>

                                </li>
                            </ul>

                        </div>
                        <!-- END Sidebar Content -->
                    </div>
                    <!-- END Wrapper for scrolling functionality -->
                </div>
                <!-- END Main Sidebar -->

                <!-- Main Container -->
                <div id="main-container">

                    <header class="navbar navbar-default">
                        <!-- Left Header Navigation -->
                        <ul class="nav navbar-nav-custom">
                            <!-- Main Sidebar Toggle Button -->
                            <li>
                                <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                                    <i class="fa fa-bars fa-fw"></i>
                                </a>
                            </li>

                        </ul>

                        <ul class="nav navbar-nav-custom pull-right">

                            <li class="dropdown">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="{{ asset('img/placeholders/avatars/avatar2.jpg') }}" alt="avatar"> <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                    <li class="dropdown-header text-center">Account</li>

                                    <li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                        </form>
                                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa fa-ban fa-fw pull-right"></i> Logout
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <!-- END User Dropdown -->
                        </ul>
                        <!-- END Right Header Navigation -->
                    </header>
                    <!-- END Header -->

                    <!-- Page content -->
                    <div id="page-content">
                        <!-- Datatables Header -->
                        <div class="content-header">
                            <div class="header-section">
                                <h1>
                                    <i class="fa fa-table"></i>Datatables<br><small>HTML tables can become fully dynamic with cool features!</small>
                                </h1>
                            </div>
                        </div>
                        <ul class="breadcrumb breadcrumb-top">
                            <li>Tables</li>
                            <li><a href="">Datatables</a></li>
                        </ul>
                        <!-- END Datatables Header -->

                        <!-- Datatables Content -->
                        @if(session('success_delete'))
                            <div class="alert alert-success">
                                {{ session('success_delete') }}
                            </div>
                        @endif
                        @if(session('success_update'))
                            <div class="alert alert-success">
                                {{ session('success_update') }}
                            </div>
                        @endif
                        @if(session('error_type'))
                            <div class="alert alert-danger">
                                {{ session('error_type') }}
                            </div>
                        @endif
                        @if(session('falaid_upate'))
                            <div class="alert alert-danger">
                                {{ session('falaid_upate') }}
                            </div>
                        @endif
                        @if(session('success_team'))
                            <div class="alert alert-success">
                                {{ session('success_team') }}
                            </div>
                        @endif
                        @if(session('success_type'))
                            <div class="alert alert-success">
                                {{ session('success_type') }}
                            </div>
                        @endif

                        <div class="d-flex" style="margin-bottom:75px;">
                            <div class="btn-group btn-group-sm pull-left">
                                <a href="javascript:void(0)" onclick="$('#modal-user-add').modal('show');" class="btn btn-primary active" id="style-striped" data-toggle="tooltip" title="" data-original-title=".table-striped">Enregistré un Utilisateur</a>
                            </div>

                            <div class="btn-group btn-group-sm pull-right">
                                <a href="javascript:void(0)" onclick="$('#modal-team-add').modal('show');"class="btn btn-primary active" id="style-striped" data-toggle="tooltip" title="" data-original-title=".table-striped">Enregistré un Team</a>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div id="modal-team-add" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <h2 class="modal-title">
                                            <i class="fa fa-pencil">
                                                Enregistré un Team
                                            </i>
                                        </h2>
                                    </div>
                                    <div class="modal-body" style="margin-bottom: 80px;">
                                        <form action="/traitement-creation-team" method="POST" id="create_team">
                                            @csrf
                                            <fieldset>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label" for="user-settings-email">Nom de la team</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="user-settings-pemail" name="team" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="form-group form-actions">
                                                <div class="col-xs-12 text-center mt-5" style="margin-top: 15px;">
                                                    <button type="submit" class="btn btn-sm btn-primary">Créer</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="modal-user-add" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Button trigger modal -->
                                    <div class="modal-header text-center">
                                        <h2 class="modal-title"><i class="fa fa-pencil"></i> Enregistré un Utilisateur</h2>
                                    </div>
                                    <!-- END Modal Header -->
                                    <!-- Modal Body -->
                                    <div class="modal-body" >
                                        <form action="/traitement-enregistrement" method="post" id="registration" enctype="multipart/form-data" class="form-horizontal form-bordered">
                                            @csrf
                                            <fieldset>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label" for="user-settings-email">Email</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="user-settings-pemail" name="email" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label" for="user-settings-name">Nom d'utilisateur</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="user-settings-name" name="name" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label" for="user-settings-password">Mot de passe</label>
                                                    <div class="col-md-8">
                                                        <input type="password" id="password" name="password" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label" for="register-password-verify">Vérifier le mot de passe</label>
                                                    <div class="col-md-8">
                                                        <input type="password" id="register_confirmation" name="register_confirmation" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label" for="example-select2">Selectionner le type</label>
                                                    <div class="col-md-6">
                                                        <select id="type" name="type" class="select-select2 select2-hidden-accessible" style="width: 100%;" data-placeholder="Choose one.." tabindex="-1" aria-hidden="true">
                                                            <option></option>
                                                            <option value="Agent">Agent</option>
                                                            <option value="CQ">CQ</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label" for="team">Selectionner le team</label>
                                                    <div class="col-md-6">
                                                        <select id="select-team" name="team" class="select-select2 select2-hidden-accessible" style="width: 100%;" data-placeholder="Choose one.." tabindex="-1" aria-hidden="true">
                                                            <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                            @foreach ($teams as $team)
                                                                <option value="{{ $team->id }}">{{ $team->team }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="form-group form-actions">
                                                <div class="col-xs-12 text-center">
                                                    <button type="submit" class="btn btn-sm btn-primary">Créer</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                    <!-- END Modal Body -->
                                </div>
                            </div>
                        </div>

                        <div class="block full">
                            <div class="block-title">
                                <h2><strong>Datatables</strong> integration</h2>
                            </div>


                               <!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->

                                <!-- END User Settings -->


                            <div class="table-responsive">
                                <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nom</th>
                                            <th class="text-center">Fonction</th>
                                            <th class="text-center">Team</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center">{{ $user->name }}</td>
                                            <td class="text-center"><a href="javascript:void(0)">{{ $user->type }}</a></td>
                                            <td class="text-center">{{ $user->team }}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="javascript:void(0)" onclick="$('#modal-user-edit-{{ $user->id }}').modal('show');" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                                    <a href="/delete-user/{{ $user->id }}" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- User Settings, modal which opens from Edit link -->
                                        <div id="modal-user-edit-{{ $user->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header text-center">
                                                        <h2 class="modal-title"><i class="fa fa-pencil"></i> Modifier un Utilisateur</h2>
                                                    </div>
                                                    <!-- END Modal Header -->

                                                    <!-- Modal Body -->
                                                    <div class="modal-body">
                                                        <!-- Model content here -->
                                                        <form action="/update-traitement-enregistrement" method="post" id="registration_form" enctype="multipart/form-data" class="form-horizontal form-bordered">
                                                            @csrf
                                                            <!-- Form fields for user editing here -->
                                                            <fieldset>
                                                                <div class="form-group hidden">
                                                                    <label class="col-md-4 control-label" for="user-settings-email">id</label>
                                                                    <div class="col-md-8">
                                                                        <input type="text" id="user-settings-pemail" name="id" class="form-control" value="{{ $user->id }}" placeholder="{{ $user->id }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-4 control-label" for="user-settings-email">Email</label>
                                                                    <div class="col-md-8">
                                                                        <input type="text" id="user-settings-pemail" name="email" class="form-control" value="{{ $user->email }}" placeholder="{{ $user->email }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-4 control-label" for="user-settings-name">Nom d'utilisateur</label>
                                                                    <div class="col-md-8">
                                                                        <input type="text" id="user-settings-name" name="name" class="form-control" value="{{ $user->name }}" placeholder="{{ $user->name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-4 control-label" for="user-settings-password">Mot de passe</label>
                                                                    <div class="col-md-8">
                                                                        <input type="password" id="password" name="password" class="form-control" placeholder="">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-4 control-label" for="register-password-verify">Vérifier le mot de passe</label>
                                                                    <div class="col-md-8">
                                                                        <input type="password" id="register_confirmation" name="register_confirmation" class="form-control" placeholder="">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-4 control-label" for="example-select2">Selectionner le type</label>
                                                                    <div class="col-md-6">
                                                                        <select id="type" name="type" class="select-select2 select2-hidden-accessible" style="width: 100%;" data-placeholder="Choose one.." tabindex="-1" aria-hidden="true">
                                                                            <option value="{{ $user->type }}">{{ $user->type }}</option>
                                                                            <option value="Agent">Agent</option>
                                                                            <option value="CQ">CQ</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-4 control-label" for="team">Selectionner le team</label>
                                                                    <div class="col-md-6">
                                                                        <select id="select-team" name="team" class="select-select2 select2-hidden-accessible" style="width: 100%;" data-placeholder="Choose one.." tabindex="-1" aria-hidden="true">
                                                                            <option value="{{ $user->id_team }}">{{ $user->team }}</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                                            @foreach ($teams as $team)
                                                                                <option value="{{ $team->id }}">{{ $team->team }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            <div class="form-group form-actions">
                                                                <div class="col-xs-12 text-center">
                                                                    <button type="submit" class="btn btn-sm btn-primary">Créer</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- END Modal Body -->
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END Datatables Content -->
                    </div>
                    <!-- END Page Content -->

                    <!-- Footer -->
                    <footer class="clearfix">
                        <div class="pull-right">
                            Crafted with <i class="fa fa-heart text-danger"></i> by <a href="#" target="_blank">United Call Center</a>
                        </div>
                        <div class="pull-left">
                            <span id="year-copy"></span> &copy; <a href="https://1.envato.market/x4R" target="_blank"></a>
                        </div>
                    </footer>
                    <!-- END Footer -->
                </div>
                <!-- END Main Container -->
            </div>
            <!-- END Page Container -->
        </div>
        <!-- END Page Wrapper -->

        <!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
        <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

        <!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
        <div id="modal-user-settings" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header text-center">
                        <h2 class="modal-title"><i class="fa fa-pencil"></i> Settings</h2>
                    </div>
                    <!-- END Modal Header -->
                </div>
            </div>
        </div>
        <!-- END User Settings -->

        <!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
        <script src="{{ asset('js/vendor/jquery.min.js') }}"></script>
        <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/plugins.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/pages/tablesDatatables.js') }}"></script>
        <script src="{{ asset('js/validation_form_signup.js') }}"></script>
        <script src="{{ asset('js/validation_from_team.js') }}"></script>
        <script src="{{ asset('js/validation_update_signup.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

        <script>$(function(){ TablesDatatables.init(); });</script>
    </body>
</html>
