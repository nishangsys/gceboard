<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <title>GCE BOARD CONTROL SYSTEM</title>

    <meta name="description" content="overview &amp; stats"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css"/>

    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link rel="stylesheet" href="../assets/css/fonts.googleapis.com.css"/>

    <!-- ace styles -->
    <link rel="stylesheet" href="../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="../assets/css/ace-part2.min.css" class="ace-main-stylesheet"/>
    <![endif]-->
    <link rel="stylesheet" href="../assets/css/ace-skins.min.css"/>
    <link rel="stylesheet" href="../assets/css/ace-rtl.min.css"/>
    <link rel="stylesheet" href="../assets/css/jquery-ui.min.css"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="../assets/css/ace-ie.min.css"/>
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <style>
        p {
            background: none;
        }

        .blink {
            animation: blink-animation 10s steps(5, start) infinite;
            -webkit-animation: blink-animation 10s steps(5, start) infinite;
            color: #f00;
            font-weight: bold;
            text-align: center;
            font-size:19px;
        }

        @keyframes blink-animation {
            to {
                visibility: hidden;
            }
        }

        @-webkit-keyframes blink-animation {
            to {
                visibility: hidden;
            }
        }
    </style>
    <style>
        .payment_rounded {
            border-radius: .5em;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, .175) !important
        }

        .payment_button {
            border-radius: 1em;
            background: #FFDE03;;
            color: rgb(0, 0, 0) !important;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important
        }

        .payment_button:hover {
            border-radius: 1em !important;
            background: #ffffff !important;
            color: #FFDE03;
        !important;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important
        }

        h1{
	text-align:center;
	text-transform:uppercase;
	font-size:24px;
	padding:5px 10px;
	border:1px solid#000;
}
h2{
	text-align:left;
	text-transform:uppercase;
	font-size:19px;
	padding:5px 10px;
	font-weight:bold;
	
}
    </style>
    <script src="../assets/js/ace-extra.min.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="../assets/js/html5shiv.min.js"></script>
    <script src="../assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="no-skin">
<div id="navbar" class="navbar navbar-default          ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a href="index.php" class="navbar-brand">
                <small>
                    <i class="fa fa-home"></i>
                    GCE BOARD CONTROL SYSTEM
                </small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">

                <li class="light-blue dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo"/>
                        <span class="user-info">
									<small>Welcome,</small>
									
								</span>

                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

                        <li class="divider"></li>

                        <li>
                            <a href="../logout.php">
                                <i class="ace-icon fa fa-power-off"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>