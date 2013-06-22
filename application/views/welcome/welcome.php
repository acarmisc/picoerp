<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Control Room</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Andrea Carmisciano">

    <!-- Le styles -->
    <link href="<?= base_url() ?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/default.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="<?= base_url() ?>assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="<?= base_url() ?>assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= base_url() ?>assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url() ?>assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url() ?>assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?= base_url() ?>assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">PicoCMS</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li><a href="help">Help</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <h1><?= lang('login') ?></h1>
      
      <div class="row">
	      <div class="span6 pull-right">
		      <form class="well" action="<?= base_url() ?>welcome/login" method="post">
				  <label><?= lang('username') ?></label>
				  <input type="text" name="username" class="span3" placeholder="<?= lang('username_placeholder') ?>"><br />
  				  <label><?= lang('password') ?></label>
				  <input type="password" name="password" class="span3"><br />
				  <button type="submit" class="btn"><?= lang('enter') ?></button>
				  <?php if($this->uri->segment(3) == 'failed'): echo msgs('important',lang('wrong_login')); endif; ?>
				</form>
	      </div>

          <div class="span4 offset0">
	          <img src="assets/img/logo_big.png" />
          </div>
	  </div>

    </div>

    <script src="<?= base_url() ?>assets/js/jquery.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap-transition.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap-alert.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap-modal.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap-dropdown.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap-scrollspy.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap-tab.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap-tooltip.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap-popover.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap-button.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap-collapse.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap-carousel.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>
