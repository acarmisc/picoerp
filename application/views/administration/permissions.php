<div class="container-fluid">
  <div class="row-fluid">
    <div class="span2 well">
    <ul class="nav nav-list">
	  <li class="nav-header">
	    <?= lang('menu') ?>
	  </li>
	 <?php createMenu($menu); ?>
	</ul>
	    
    </div>
    <div class="span10">
    	
    	<div class="well">
    		<?= form_open('administration/save_rule') ?>
    			<p>Create new rule</p>
    			<div class="inline-form-el">
    				<select name="module">
    					<option value="">select module...</option>
    				<?php $query = $this->db->get('modules');
    					foreach($query->result() as $row): ?>
    						<option value="<?= $row->name ?>"><?= $row->name ?></option>
    				<?php endforeach; ?>
    				</select>
    			</div>
    			
    			<div class="inline-form-el">
    				<input type="text" class="input-small" name="action" placeholder="action..." />
    			</div>
    			
    			<div class="inline-form-el">
    				<select name="rule">
    					<option value="">select rule...</option>    				
    					<option value="allow">allow</option>
    					<option value="deny">deny</option>    					
    				</select>
    			</div>    
    			
    			<div class="inline-form-el">
    				<select name="gid">
    					<option value="">select group...</option>
    				<?php $query = $this->db->get('groups');
    					foreach($query->result() as $row): ?>
    						<option value="<?= $row->id ?>"><?= $row->name ?></option>
    				<?php endforeach; ?>
    				</select>
    			</div>    
    			
    			<div class="inline-form-el">
	    			<input type="submit" value="+" class="btn btn-primary btn-small" />
    			</div>						
    			
    		</form>
    	</div>
    	<p><?= lang('permissions_intro') ?></p>
    
		<div class="tabbable tabs-left">
		  <ul class="nav nav-tabs">
		   <?php foreach($permissions as $p): ?>
		    	<li><a href="#<?= $p->module ?>" data-toggle="tab"><?= lang($p->module) ?></a></li>
		    <?php endforeach; ?>		    
		  </ul>
		  <div class="tab-content">
	      	<?php foreach($permissions as $p): ?>
		      <div class="tab-pane" id="<?= $p->module ?>">
		      <table class="table table-striped table-bordered table-condensed">
					  <thead>
					    <tr>
					      <th><?= lang('module') ?></th>
					      <th><?= lang('action') ?></th>
					      <th><?= lang('rule') ?></th>		      
					      <th><?= lang('group') ?></th>
					      <th></th>
					    </tr>
					  </thead>
					  <tbody>
		      	<?php 
		      		$ps = $this->administration_model->getPermissionsDetails($p->module);
					  	foreach($ps as $u): 
					  	if ($u->rule == 'allow'): $rule_label = 'success'; else: $rule_label = 'warning'; endif; ?>
					    <tr>
					      <td><?= $u->module ?></td>
					      <td><?= $u->action ?></td>
					      <td><span class="label label-<?= $rule_label ?>"><?= lang($u->rule) ?></span></td>		      
					      <td><?= $u->name ?></td>		      
					      <td><a href="#" class="falseButton" class="permission-delete" name="<?= $u->id ?>"><i class="icon-trash"></i></a></td>
					    </tr>
					    <?php endforeach; ?>
					  </tbody>
					</table>
		      		
		      </div>
		    <?php endforeach; ?>
		    
		  </div>
		</div>
    </div>
  </div>
</div>