<?php foreach($partners as $p): ?>

<div class="well">
<p class="pull-right">
<label><?= lang('creation_date') ?></label> <span class="badge"><?= date('d-m-Y',$p->creation_date) ?></span>
</p>
<h3 style="display:inline" id="myname"><?= $p->name ?></h3><a style="display:inline" href="#" class="partner-name-edit" id="partner-<?= $p->id ?>"><i class="icon-pencil"></i></a>
<p><small style="color: #666"><?= lang('vat') ?> <i><?= $p->vat ?></i></small></p>
 <p><small style="color: #666">Codice fiscale <i><?= $p->cf?></i></small></p>
<p><?= $p->website ?></p>
</p>

<div class="white-box">
<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#informations" data-toggle="tab"><?= lang('informations') ?></a></li>
    <li><a href="#contacts" data-toggle="tab"><?= lang('contacts') ?></a></li>
    <li><a href="#banks" data-toggle="tab"><?= lang('banks') ?></a></li>
    <li><a href="#history" data-toggle="tab"><?= lang('history') ?></a></li>
  </ul>
  <div class="tab-content" >
    <div class="tab-pane active" id="informations">
    
    	<?= $this->load->view('crm/_address-form') ?>
    
    </div>
    <div class="tab-pane" id="contacts">
	  <?= $this->load->view('crm/_contacts-form') ?>
    </div>    
    <div class="tab-pane" id="banks">
	  Unavailable until sales section completition
    </div>
    <div class="tab-pane" id="history">
	  <?= $this->load->view('crm/_partner-history') ?>
    </div>

  </div>
</div>
</div>

</div>

<?php endforeach; ?>