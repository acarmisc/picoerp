<?php if($this->uri->segment(2) != 'show_purchases'){ ?>

<div class="alert alert-info">Please complete the informations required to create a purchase order for your current project.</div>

<?php } ?>

<?php
	$total = 0;
	$this->db->select('purchase_rows.id, project_items.item, project_items.price_budget, purchase_rows.qty, purchase_rows.description');
	$this->db->join('project_items', 'project_items.id = purchase_rows.project_item_id', 'left');	
	$query = $this->db->get_where('purchase_rows', array('purchase_id' => $this->uri->segment(3)));
	$lines = $query->result();
	
	foreach($lines as $l){ 
		$total += $l->price_budget;
	}
?>

<div class="pull-right">
	    <div class="btn-group">
		    <button class="btn btn-inverse"><i class="icon-share-alt icon-white"></i> Share</button>
		    <button class="btn dropdown-toggle btn-inverse" data-toggle="dropdown">
		    	<span class="caret"></span>
		    </button>
		    <ul class="dropdown-menu">
		    	<li><?= anchor('purchases/print_purchases/'.$this->uri->segment(3), 
	    		'<i class="icon-print"></i> '.lang('print'),
	    		array('target'=>'_blank', 'class'=>'')) ?></li>
	    		<li><?= anchor('purchases/print_preview_purchases/'.$this->uri->segment(3), 
	    		'<i class="icon-print"></i> '.lang('print').' preview',
	    		array('target'=>'_blank', 'class'=>'')) ?></li>
	    		<li><?= anchor('purchases/print_data/'.$this->uri->segment(3), 
	    		'<i class="icon-print"></i> '.lang('print').' data',
	    		array('target'=>'_blank', 'class'=>'')) ?></li>
	    	</ul>
	    </div>
	    </div>
<?= form_open('purchases/update_purchase/'.$data->id, array('onsubmit'=>'', 'class'=>'well form-horizontal', 'id'=>'purchase-details-update')) ?>

	<input type="hidden" name="project_id" value="<?= $data->project_id ?>" />
	<input type="hidden" name="update_date" value="<?= time() ?>" />
	
	<div class="righter">
		Total budget: <br /><br />
		<?= money_format('%.2n',$total) ?>
	</div>
			
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('number') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="purchase-number" name="number" value="<?= $data->number ?>"> 	
      </div>
    </div>  
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('project') ?></label>
      <div class="controls">
        	<?php $query = $this->db->get_where('projects', array('id'=>$data->project_id));
        		foreach($query->result() as $r1): ?>
        		<b> <?= $r1->name ?></b>
        	<?php endforeach; ?>
      </div>
    </div>    

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('supplier') ?></label>
      <div class="controls">
        	<?php $query = $this->db->get_where('partners', array('id'=>$data->partner_id));
        		foreach($query->result() as $r1): ?>
        		<b> <?= $r1->name ?></b>
        	<?php endforeach; ?>
      </div>
    </div>

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('subject') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="purchase-currency" name="subject" value="<?= $data->subject ?>"> 	
      </div>
    </div>      
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('arrival_date') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="purchase-arrival_date" name="arrival_date" value="<?= $data->arrival_date ?>"> 	
      </div>
    </div>     
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('attention_of') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="purchase-attention_of" name="attention_of" value="<?= $data->attention_of ?>"> 	
      </div>
    </div>     

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('delivery_terms') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="purchase-delivery_terms" name="delivery_terms" value="<?= $data->delivery_terms ?>"> 	
      </div>
    </div>         

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('delivery_time') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="purchase-delivery_time" name="delivery_time" value="<?= $data->delivery_time ?>"> 	
      </div>
    </div>             

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('delivery_address') ?></label>
      <div class="controls">
        <textarea name="delivery_address" style="width:400px"><?= $data->delivery_address ?></textarea>
      </div>
    </div>        

    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('description') ?></label>
      <div class="controls">
        <textarea name="description" style="width:400px"><?= $data->description ?></textarea>
      </div>
    </div> 

    <div class="control-group">
      <label class="control-label" for="input01">Warranty terms</label>
      <div class="controls">
        <textarea name="warranty_terms" style="width:400px"><?= $data->warranty_terms ?></textarea>
      </div>
    </div> 

    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('notes') ?></label>
      <div class="controls">
        <textarea name="notes" style="width:400px"><?= $data->notes ?></textarea>
      </div>
    </div>     
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('price') ?></label>
      <div class="controls">
        <input type="text" class="input-large" id="purchase-price_final" name="price_final" value="<?= $data->price_final ?>"> 	
      </div>
    </div>      

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('order_date') ?></label>
      <div class="controls">
        <input type="text" class="input-small datefield" data-date="<?= date('dd-mm-yyyy',time()) ?>" id="purchase-order_date" name="order_date" value="<?= $data->order_date ?>"> 	
      </div>
    </div>  
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('ref') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="purchase-ref" name="ref" value="<?= $data->ref ?>"> 	
      </div>
    </div> 
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('payment') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="purchase-payment" name="payment" value="<?= $data->payment ?>"> 	
      </div>
    </div>          

    <button type="submit" class="btn btn-primary"><?= lang('update') ?></button>

		

<?= form_close() ?>

<?= designWorkflow(3, $data->wf_step, array('table' => 'purchases', 'id' => $data->id)) ?>
<script type="text/javascript">

<?php if ($data->wf_step == 'sent'): ?>

	$('#purchase-details-update :input').attr('disabled','disabled');

<?php endif; ?>
        		
</script>



<h4>Items</h4>

<div id="my_temp_target" style="padding: 20px;">
	
	
</div>

<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th width="30px"></th>
			<th><?= lang('name')?></th>		
			<th><?= lang('description')?></th>						
			<th><?= lang('qty')?></th>	
			<th></th>
		</tr>
	</thead>
	<tbody id="agile-table">
<?php
	$this->db->select('purchase_rows.id, project_items.item, purchase_rows.qty, purchase_rows.description');
	$this->db->join('project_items', 'project_items.id = purchase_rows.project_item_id');
	$query = $this->db->get_where('purchase_rows', array('purchase_id' => $this->uri->segment(3)));
	foreach($query->result() as $r){
	?>
		<tr>
			<td></td>
			<td><?= $r->item ?></td>
			<td><?= $r->description ?></td>
			<td><?= $r->qty ?></td>
			<td>
        <a rel="tooltip" title="split item" data-toggle="modal" href="#myModal" id="purchase_item_split" name="<?= $r->id ?>"><i class="icon-random"></i></a>
				<a rel="tooltip" title="show details" data-toggle="modal" href="#myModal" id="purchase_item_show" name="<?= $r->id ?>"><i class="icon-pencil"></i></a>
			</td>															
		</tr>
	<?php
	}
?>	
	</tbody>	
</table>

<p id="adder-el" style="" class="pull-right"><button id="purchase-<?= $this->session->userdata('current_project') ?>" class="btn btn-default add-purchase-row"><i class="icon-plus"></i> <?= lang('add_element') ?></button> </p>
