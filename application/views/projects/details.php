<?php foreach($project as $r):	?>
<?= form_open('projects/save_project/'.$r->id, array('class'=>'form-horizontal', 'id'=>'project-details')) ?>
<table width="100%" border="0">
<tr>
	<td>

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('number') ?></label>
      <div class="controls">
        <input type="text" disabled="disabled" class="" id="project-name" name="name" value="<?= $r->name ?>">
      </div>
    </div>


	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('title') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge fillhead" id="project-title" name="title" placeholder="<?= lang('title') ?>" value="<?= $r->title ?>"> 	 
      </div>
    </div>
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('customer') ?></label>
      <div class="controls">
        <select name="partner_id" disabled="disabled">
        		<option value="0">scegli...</option>
        	<?php $query = $this->db->get('partners');
        		foreach($query->result() as $r1):
        		if ($r->partner_id == $r1->id): $s = '  selected="selected" '; else: $s = ''; endif; ?>
        		<option <?= $s ?> value="<?= $r1->id ?>"><?= $r1->name ?></option>
        	<?php endforeach; ?>
        </select>
      </div>
    </div>    

    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('description') ?></label>
      <div class="controls">
        <textarea name="description" style="width:400px"><?= $r->description ?></textarea>
      </div>
    </div> 
    
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('type') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="project-type" name="type" value="<?= $r->type ?>" disabled="disabled">
      </div>
    </div>     
    
	</td>
	<td>
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('estimated_close_date') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="project-estimated_close_date" name="estimated_close_date" value="<?= $r->estimated_close_date ?>"> 	
      </div>
    </div>    
    
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('real_close_date') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="project-real_close_date" name="real_close_date"  value="<?= $r->real_close_date ?>"> 	
      </div>
    </div>
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('ordine_cliente') ?></label>
      <div class="controls">
        <input type="text" class="input-large" id="project-eordine_cliente" name="ordine_cliente" value="<?= $r->ordine_cliente ?>"> 	
      </div>
    </div>     
    
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('project_manager') ?></label>
      <div class="controls">
        <select name="projectmanager_id">
        		<option value="0">scegli...</option>
        	<?php $query = $this->db->get('users');
        		foreach($query->result() as $r1):
        		if ($r->projectmanager_id == $r1->id): $s = '  selected="selected" '; else: $s = ''; endif; ?>
        		<option <?= $s ?> value="<?= $r1->id ?>"><?= $r1->first_name ?> <?= $r1->second_name ?></option>
        	<?php endforeach; ?>
        </select>
      </div>
    </div>   
    
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('last_update_date') ?></label>
      <div class="controls">
        <input type="text" class="input-large" value="<?= date('d-m-Y H:i:s',$r->update_date) ?>" disabled="disabled" /> 	      
      </div>
    </div>       

    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('order_amount') ?></label>
      <div class="controls">
        <input type="text" class="input-large" name="order_amount" value="<?= $r->order_amount ?>" /> &euro;	      
      </div>
    </div>  

    <?php 
      $this->session->set_userdata('inv_order_amount', $r->order_amount);
    ?>

    <div class="control-group">
      <label class="control-label" for="input01">Quotation</label>
      <div class="controls">
      	<?php
      		$q_q = $this->db->get_where('quotations', array('id' => $r->quotation_id));
      		foreach($q_q->result() as $r_q):
      			$quotation_name = $r_q->title;
      		endforeach;
      	?>
      	<?php if ($quotation_name): ?>
      	<?= anchor('/sales/show_quotation/'.$r->quotation_id,$quotation_name) ?>
      	<?php endif; ?>
<!--         <input type="text" class="input-large" name="quotation" value="<?= $quotation_name ?>" /> -->
      </div>
    </div> 

    <p align="right"><button type="submit" class="btn btn-primary"><?= lang('update') ?></button></p>

	</td>
</tr>
</table>
<?= form_close() ?>
<?php endforeach;	?> 