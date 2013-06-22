<p class="help_tip alert alert-info"><?= lang('wf_editor_intro') ?></p>

<div id="wf-editor" class="pull-left">

	<div id="wf-steps">
	<?php foreach($steps as $s): ?>
		<ul class="breadcrumb movable">
			<li class=""><span class="badge badge-info"><?= $s->seq ?></span> 
				<span class="wf-stepname"><?= $s->name ?></span>
				<small><?= $s->gname ?></small><br />
				<span class="wf-stepdesc"><?= $s->description ?></span>
			</li>
		</ul>
		<div align="center"><i class="icon-chevron-down"/></div>
	<?php endforeach; ?>
		<p class="well" align="center"><?= lang('wf_eo') ?></p>
	</div>

</div>

<div id="wf-panel" class="pull-right">

<div id="crm-form">

	<h4><?= lang('add_step') ?></h4>

	<?= form_open('administration/workflow_save_step', array('class'=>'well form-horizontal')) ?>

    	<div class="control-group">
	      <label class="control-label"><?= lang('name') ?></label>
	      <div class="controls">
	        <input type="text" class="input-large" id="step-name" name="name" value="">
	      </div>
	    </div>

    	<div class="control-group">
	      <label class="control-label"><?= lang('description') ?></label>
	      <div class="controls">
	        <input type="text" class="input-large" id="step-description" name="description" value="">
	      </div>
	    </div>
	    
    	<div class="control-group">
	      <label class="control-label"><?= lang('gid') ?> <?= lang('or') ?> <?=lang('uid') ?></label>
	      <div class="controls">
	        <select name="gid">
	        	<?= ttoselect('groups',null,'name',true) ?>
	        </select>
	        <select name="uid">
	        	<?= ttoselect('users',null,'username',true) ?>
	        </select>
	      </div>
	    </div>	   
	    
	    <div class="control-group">
	      <label class="control-label"><?= lang('enter_action') ?></label>
	      <div class="controls">
	        <select name="enter_action">
	        	<?= ttoselect('workflows_actions',null,'name',true) ?>
	        </select> <input type="text" class="input-small" id="step-enter_action-param" name="enter_action-param" value="" placeholder="param...">
	      </div>
	    </div>	 

	    <div class="control-group">
	      <label class="control-label"><?= lang('exit_action') ?></label>
	      <div class="controls">
	        <select name="enter_action">
	        	<?= ttoselect('workflows_actions',null,'name',true) ?>
	        </select> <input type="text" class="input-small" id="step-exit_action-param" name="exit_action-param" value="" placeholder="param...">
	      </div>
	    </div>	 


    	<br />
    	<br />
    	<button type="submit" class="btn btn-primary"><i class="icon-plus icon-white"></i> <?= lang('save') ?></button>

	<?= form_close() ?>
</div>


</div>

<script>
$(document).ready(function() {
    var $dragging = null;

    $(document.body).on("mousemove", function(e) {
        if ($dragging) {
            $dragging.offset({
                top: e.pageY,
                left: e.pageX
            });
        }
    });


    $(document.body).on("mousedown", ".movable", function (e) {
        $dragging = $(e.target);
    });

    $(document.body).on("mouseup", function (e) {
        $dragging = null;
    });
});
</script>