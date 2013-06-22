<div id="loading">
	<div class="ball"></div>
	<div class="ball1"></div>
</div>
<?php if (ENVIRONMENT == 'development'): ?>
<button class="btn btn-mini" onclick="$('#console').toggle()">Console</button>

<span class="label label-important"><i class="icon-warning-sign icon-white"></i> Important: Debug mode enabled. Deletion and other functions may be disabled. Console enabled.</span>

<div id="console" style="display:none">
<pre><?php print_r($this->session->userdata);  ?></pre>
</div>
<?php endif; ?>
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
    <script src="<?= base_url() ?>assets/js/bootstrap-datepicker.js"></script>    
    <script src="<?= base_url() ?>assets/js/my.js"></script>    

    <script>
    	jQuery.data(document.body, 'base_url', '<?= base_url() ?>');
    </script>

<div class="modal hide" id="myModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3 id="modal-header-title">...</h3>
  </div>
  <div class="modal-body">
    <p>...</p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
  </div>
</div>


  </body>
</html>
