	<div class="tabbable"> <!-- Only required for left/right tabs -->
	  <ul class="nav nav-tabs">
	    <li class="active"><a href="#item_details" data-toggle="tab"><?= lang('details') ?></a></li>
	    <li><a href="#new_product" data-toggle="tab"><?= lang('new_product') ?></a></li>
	  </ul>
	  <div class="tab-content" >
	    <div class="tab-pane active" id="item_details">

<form class="form-search well" onsubmit="return false">
  <input type="text" class="input-medium search-query" 
  	name="products-q" data-table="products" 
  	data-field="name" 
  	placeholder="name" 
  	/>
  	
</div>
</form>

<p><?= anchor('sales/products', lang('reload_list')) ?></p>
<div id="products-browser">
<?php $this->load->view('products/browser') ?>
</div>
</div>
	    <div class="tab-pane" id="new_product">
	        <div class="form-in-form">
    	<?= $this->load->view('sales/agile_new_product') ?>
    </div>

	    </div>
	  </div>
<?php if(!isset($append_to)): ?>
	<p><button id="new-product" data-toggle="modal" href="#myModal" class="btn btn-default"><i class="icon-plus"></i> <?= lang('add') ?></button> </p>
<?php endif; ?>


