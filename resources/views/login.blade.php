<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>CRM - United Call Center</title>

        <meta name="description" content="ProUI is a Responsive Bootstrap Admin Template created by pixelcave and published on Themeforest.">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
        <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.min.css') }}" />
        <script src="{{ asset('bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('jquery/jquery-3.6.1.min.js') }}"></script>

        <link href="{{ asset('fontawesome/css/fontawesome.css')}}" rel="stylesheet">
        <link href="{{ asset('fontawesome/css/brands.css')}}" rel="stylesheet">
        <link href="{{ asset('fontawesome/css/solid.css')}}" rel="stylesheet">
        <link href="{{ asset('fontawesome/css/regular.css')}}" rel="stylesheet">
        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
        <link rel="apple-touch-icon" href="img/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="{{ asset('img/icon57.png') }}" sizes="57x57">
        <link rel="apple-touch-icon" href="{{ asset('img/icon72.png') }}" sizes="57x57">
        <link rel="apple-touch-icon" href="{{ asset('img/icon76.png') }}" sizes="57x57">
        <link rel="apple-touch-icon" href="{{ asset('img/icon114.png') }}" sizes="57x57">
        <link rel="apple-touch-icon" href="{{ asset('img/icon120.png') }}" sizes="57x57">
        <link rel="apple-touch-icon" href="{{ asset('img/icon144.png') }}" sizes="57x57">
        <link rel="apple-touch-icon" href="{{ asset('img/icon152.png') }}" sizes="57x57">
        <link rel="apple-touch-icon" href="{{ asset('img/icon180.png') }}" sizes="57x57">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap-grid.min.css') }}">

        <link rel="stylesheet" href="{{ asset('css/plugins.css') }}">
        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">

        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="{{ asset('css/themes') }}">

        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) -->
        <script src="{{ asset('js/vendor/modernizr.min.js') }}"></script>
        <script src="{{ asset('jquery/validation/login_validation.js') }}"></script>
    </head>
    <body>
        <!-- Login Background -->
        <div id="login-background">
            <!-- For best results use an image with a resolution of 2560x400 pixels (prefer a blurred image for smaller file size) -->
          <!--  <img src="{{ asset('img/placeholders/headers/login_header.jpg') }}" alt="Login Background" class="animation-pulseSlow"> -->

        </div>
        <!-- END Login Background -->

        <!-- Login Container -->
        <div id="login-container" class="animation-fadeIn">
            <!-- Login Title -->
            <div class="login-title text-center">
                <h1><i class="gi gi-flash"></i> <strong>CRM-UCC</strong><br><small>Please <strong>Login</strong> or <strong>Register</strong></small></h1>
            </div>
            <!-- END Login Title -->

            <!-- Login Block -->
            <div class="block push-bit">
                <!-- Login Form -->
                <form action="/login-administration" method="post" id="id_login" class="form-horizontal form-bordered form-control-borderless">
                    @csrf
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                                <input type="text" id="login-email" name="name" class="form-control input-lg" placeholder="name">
                                @error('name')<span class="text-danger"> {{ $message }} </span>@enderror

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                                <input type="password" id="login-password" name="password" class="form-control input-lg" placeholder="Password">
                                @error('password')<span class="text-danger"> {{ $message }} </span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-xs-4">
                          <!--  <label class="switch switch-primary" data-toggle="tooltip" title="Remember Me?">
                                <input type="checkbox" id="login-remember-me" name="login-remember-me" checked>
                                <span></span>
                            </label> -->
                        </div>
                        <div class="col-xs-8 text-right text-center">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Login to Dashboard</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 text-center">
                            <a href="javascript:void(0)" id="link-reminder-login"><small>Forgot password?</small></a> -
                            <a href="javascript:void(0)" id="link-register-login"><small>Create a new account</small></a>
                        </div>
                    </div>
                </form>
                <!-- END Login Form -->

                <!-- Reminder Form -->
                <form action="login.html#reminder" method="post" id="form-reminder" class="form-horizontal form-bordered form-control-borderless display-none">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                                <input type="text" id="reminder-email" name="reminder-email" class="form-control input-lg" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-right">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Reset Password</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 text-center">
                            <small>Did you remember your password?</small> <a href="javascript:void(0)" id="link-reminder"><small>Login</small></a>
                        </div>
                    </div>
                </form>
                <!-- END Reminder Form -->

                <!-- Register Form -->
                <form action="login.html#register" method="post" id="form-register" class="form-horizontal form-bordered form-control-borderless display-none">
                    <div class="form-group">
                        <div class="col-xs-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                <input type="text" id="register-firstname" name="register-firstname" class="form-control input-lg" placeholder="Firstname">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <input type="text" id="register-lastname" name="register-lastname" class="form-control input-lg" placeholder="Lastname">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                                <input type="text" id="register-email" name="register-email" class="form-control input-lg" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                                <input type="password" id="register-password" name="register-password" class="form-control input-lg" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                                <input type="password" id="register-password-verify" name="register-password-verify" class="form-control input-lg" placeholder="Verify Password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-xs-6">
                            <a href="#modal-terms" data-toggle="modal" class="register-terms">Terms</a>
                            <label class="switch switch-primary" data-toggle="tooltip" title="Agree to the terms">
                                <input type="checkbox" id="register-terms" name="register-terms">
                                <span></span>
                            </label>
                        </div>
                        <div class="col-xs-6 text-right">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Register Account</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 text-center">
                            <small>Do you have an account?</small> <a href="javascript:void(0)" id="link-register"><small>Login</small></a>
                        </div>
                    </div>
                </form>
                <!-- END Register Form -->
            </div>
            <!-- END Login Block -->

            <!-- Footer -->
            <footer class="text-muted text-center">
                <small><span id="year-copy">&copy; <?php echo date('Y'); ?></span> <a href="https://1.envato.market/x4R" target="_blank">ProUI 3.8</a></small>
            </footer>

            <!-- END Footer -->
        </div>
        <!-- END Login Container -->

        <!-- Modal Terms -->
        <div id="modal-terms" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Terms &amp; Conditions</h4>
                    </div>
                    <div class="modal-body">
                        <h4>Title</h4>
                        <p>Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p>Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <h4>Title</h4>
                        <p>Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p>Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <h4>Title</h4>
                        <p>Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p>Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Modal Terms -->

        <!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
        <script src="{{ asset('js/vendor/jquery.min.js') }}"></script>
        <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/plugins.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Load and execute javascript code used only in this page -->
        <script src="{{ asset('js/pages/login.js') }}"></script>

        <script>$(function(){ Login.init(); });</script>
    </body>
</html>