<?php foreach($sales as $r):	?>

<?= form_open('projects/save_project/', array('class'=>'well form-horizontal', 'id'=>'project-details')) ?>

	<input type="hidden" name="partner_id" value="<?= $r->partner_id ?>" />
	<input type="hidden" name="quotation_id" value="<?= $r->id ?>" />	
			
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('title') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge fillhead" id="project-title" name="title" placeholder="<?= lang('title') ?>" value="<?= $r->title ?>"> 	
      </div>
    </div>

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('name') ?></label>
      <div class="controls">
        <input type="text" class="input-large" id="project-name" name="name" value="<?= nextProjectName() ?>"> 	
        <span class="label label-info"><?= lang('project_name_tip') ?></span>
      </div>
    </div>
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('customer') ?></label>
      <div class="controls">
        <select name="partner_id">
        		<option value="0">scegli...</option>
        	<?php $query = $this->db->get_where('partners',  array('status' => 1));
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
      <label class="control-label" for="input01"><?= lang('estimated_close_date') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="project-estimated_close_date" name="estimated_close_date" > 	
      </div>
    </div>    
    
    
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('project_manager') ?></label>
      <div class="controls">
        <select name="projectmanager_id">
        		<option value="0">scegli...</option>
        	<?php $query = $this->db->get('users');
        		foreach($query->result() as $r1):
        		if ($r->partner_id == $r1->id): $s = '  selected="selected" '; else: $s = ''; endif; ?>
        		<option <?= $s ?> value="<?= $r1->id ?>"><?= $r1->first_name ?> <?= $r1->second_name ?></option>
        	<?php endforeach; ?>
        </select>
      </div>
    </div>      
    
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('ordine_cliente') ?></label>
      <div class="controls">
       <input type="text" class="input-xlarge" id="" name="ordine_cliente" /> 	
      </div>
    </div>     

    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('order_amount') ?></label>
      <div class="controls">
       <input type="text" class="input-xlarge" id="" name="order_amount" /> 	
      </div>
    </div>     
    
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('type') ?></label>
      <div class="controls">
        <select name="type" id="select_type">
        		<option value="0">select...</option>
        		<option value="spare">spare</option>
        		<option value="project">project</option>    
        		<option value="extra">extra</option>      		
        </select>
      </div>
    </div>       

    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('extra_of') ?></label>
      <div class="controls">
        <select name="parent_id">
        		<option value="0">scegli...</option>
        	<?php $query = $this->db->get_where('projects', array('type' => 'project'));
        		foreach($query->result() as $r1):
        		if ($r->parent_id == $r1->id): $s = '  selected="selected" '; else: $s = ''; endif; ?>
        		<option <?= $s ?> value="<?= $r1->id ?>"><?= $r1->name ?> <?= $r1->title ?></option>
        	<?php endforeach; ?>
        </select>
      </div>
    </div>  
    
    <button type="submit" class="btn btn-primary"><?= lang('create') ?></button>

<?= form_close() ?>
<script>

</script>

<?php endforeach;	?>    