<div id="crm-contacts-form">

<p><button id="new-contact" data-toggle="modal" href="#myModal" class="btn btn-default"><i class="icon-plus"></i> <?= lang('add') ?></button> </p>

<div id="contacts-list">
	<?= $this->load->view('crm/_contacts-list') ?>
</div>
</div>
