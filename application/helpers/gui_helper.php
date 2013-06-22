<?php 
function ttoselect($t, $p = null, $text = null, $blank = false){
	$ci=& get_instance();
	if($text == null):	$text = 'label'; endif;

	if(isset($p['order_by'])): $ci->db->order_by($p['order_by']); endif;
	
	$ci->db->select('id,'.$text.' as label');
	$q = $ci->db->get($t);
	
	if($blank = true):
		echo '<option value=""></option>';
	endif;
	
	foreach($q->result() as $r):
		if (lang($r->label) == ''): $lab = $r->label; else: $lab = lang($r->label); endif; 
		
		if(isset($p['selected'])): if($p['select'] == $r->id): $sel = ' selected="selected" '; else: $sel = ''; endif; endif;
		echo '<option '.$sel.' value="'.$r->id.'">'.$lab.'</option>';
	endforeach;
}

function chem($v, $t = null){
	if(isset($v)):
		if($v == ''):
			echo $t;
		else:
			echo $v;
		endif;
	else:
		echo '';
	endif;
}

function currency($v,$c){
	$v = str_replace('.',',',$v);

	echo $v.' '.$c;
		
}

function designWorkflow($wf, $c, $context = null){
	$ci=& get_instance();
	$query = $ci->db->get_where('workflows_steps', array('wf_id'=>$wf));
?>
	 <ul class="breadcrumb" id="workflow-path">
	     <li><b>Workflow</b> <span class="divider">|</span> </li>
<?php

	foreach($query->result() as $r):	?>
    <li>
    <?php if($r->name == $c): ?>
    	<span class="badge badge-info wfactive"><?= $r->name ?></span> <span class="divider"><i class="icon-chevron-right"></i></span>
    <?php else: ?>
    	<?php if(isset($context)){ ?>
    		<a id="wf-<?= $r->name ?>" href="#" onclick="fastUpdateWf('<?= $r->name ?>','<?= $context['table'] ?>','<?= $context['id'] ?>')"><?= $r->name ?></a>
    	<?php }else{ ?>
    		<span class=""><?= $r->name ?></span>
    	<?php } ?>
    	<span class="divider"><i class="icon-chevron-right"></i></span>
    <?php endif; ?>
    </li>
	<?php	endforeach;

?>
	 </ul>
	 <?php	
	
}

function form_from_table($fields_list,$table,$form_name = null){
	$ci=& get_instance();
	$ci->load->helper('language');

	$fields_list = explode(',',$fields_list);
	$fields = $ci->db->field_data($table);

	foreach ($fields as $field)
	{
		foreach($fields_list as $el){ 
			if(trim($field->name) == trim($el)){
				// element is to show
				switch($field->type){
					case 'varchar':
						echo '
						<label class="control-label" for="'.$form_name.$field->name.'">'.lang($field->name).'</label>
						<input type="text" class="input-large" id="'.$form_name.$field->name.'" name="'.$field->name.'">
						';
						break;
					case 'workflow':
						echo '
						<label class="control-label" for="'.$form_name.$field->name.'">'.lang($field->name).'</label>
						<input type="text" class="input-large" id="'.$form_name.$field->name.'" name="'.$field->name.'">
						';
						break;
				}
				
			} 
		}
	}
}

function liveForm($struct, $params = null){
	$ci=& get_instance();
	foreach($struct['fields'] as $f):
	
		if($f['viewable'] == true):
			if(isset($params['values'])){
				if(!isset($params['values']->$f['label'])){ $params['values'] = $params['values'][0]; }
			}
			
			if ($f['editable'] == false){ $disableme = ' disabled="disabled" '; }else{ $disableme = ""; }
//			if (isset($f['lenght']) and $f['lenght'] > 120){ $widget_size = 'xlarge'; }else{ $widget_size = 'large'; }
			$widget_size = 'large';			
			if (isset($params['values'])){ $label = $params['values']->$f['label']; }else{ $label = ''; }
			
			switch($f['widget']){
				case 'text':
					echo '
					<div class="control-group" style="display:inline-table; width: 440px">
				      <label class="control-label">'.lang($f['label']).'</label>
				      <div class="controls">
				        <input type="text" '.$disableme.' 
				        	class="input-'.$widget_size.'" 
				        	id="'.$f['label'].'" 
				        	name="'.$f['label'].'" 
				        	value="'.$label.'">
				      </div>
				    </div>
				    ';
					break;

				case 'money':
					echo '
					<div class="control-group" style="display:inline-table; width: 440px">
				      <label class="control-label">'.lang($f['label']).'</label>
				      <div class="controls">
				        	<div class="input-append">
				        	<input type="text" '.$disableme.' class="input-'.$widget_size.' money_field" 
				        	id="'.$f['label'].'" name="'.$f['label'].'" value="'.$label.'">
				        	<span class="add-on">'.live_currency().'</span>
				        	</div>
				      </div>
				    </div>
				    ';
					break;
				case 'percent':
					echo '
					<div class="control-group" style="display:inline-table; width: 440px">
				      <label class="control-label">'.lang($f['label']).'</label>
				      <div class="controls">
				        	<div class="input-append">
				        	<input type="text" '.$disableme.' class="input-small percent_field" 
				        	id="'.$f['label'].'" name="'.$f['label'].'" value="'.$label.'">
				        	<span class="add-on">%</span>
				        	</div>
				      </div>
				    </div>
				    ';
					break;
						
				case 'file':
					echo '
					<div class="control-group" style="display:inline-table; width: 440px">
				      <label class="control-label">'.lang($f['label']).'</label>
				      <div class="controls">
				        <input type="file" '.$disableme.' 
				        	class="input-'.$widget_size.'" 
				        	id="'.$f['label'].'" 
				        	name="'.$f['label'].'" 
				        	value=""> ';
				        	if(isset($label)){
					        	echo '<br /><span class="downloadable"><a target="_blank" href="'.base_url().'/upload/'.$label.'">'.$label.'</a> <i class="icon-download"></i></span>';	
				        	}
				        	
				      echo '</div>
				    </div>
				    ';
					break;
					
				case 'date':
					if($label == ''){ $label = date('d-m-Y', time()); }

					echo '
					<div class="control-group" style="display:inline-table; width: 440px">
				      <label class="control-label">'.lang($f['label']).'</label>
				      <div class="controls ">
				        <input type="text" '.$disableme.' 
				        	class="input-small" datefield input-append" 
				        	id="'.$f['label'].'" 
				        	name="'.$f['label'].'" 
				        	value="'.$label.'"><span class="add-on"><i class="icon-th"></i></span>
				      </div>
				    </div>
				    ';
				    				    
					break;

				case 'textarea':
					echo '
					<div class="control-group" style="display:inline-table; width: 440px">
				      <label class="control-label">'.lang($f['label']).'</label>
				      <div class="controls">
				        <textarea '.$disableme.' 
				        	id="'.$f['label'].'" 
				        	name="'.$f['label'].'"
				        	class="input-xlarge">'.$label.'</textarea>
				      </div>
				    </div>
				    ';
					break;
					
				case 'select':		
					if(is_array($f['bind_to'])){
						//TODO create a select from an array of values
					}else{
						if(!isset($f['select_options']['condition_field'])){
							$f['select_options']['condition_field'] = '';
						}
						if($f['select_options']['condition_field'] == ''){ $f['select_options']['condition_field'] = 'id'; }
						
 						$ci->db->select("CONCAT(".$f['select_options']['select'].") AS label, ".$f['select_options']['condition_field']." AS val"); 

 						// TODO: test it
						if(isset($f['select_options']['filter_by'])){
							$ci->db->where($f['select_options']['filter_by'], $f['select_options']['condition_param']);
						}else{
							 if($f['select_options']['condition_param'] != ''){
								 $ci->db->where($f['select_options']['condition_field'], $f['select_options']['condition_param']);
							}
						}


						if(isset($f['select_options']['order_by'])){
							$ci->db->order_by($f['select_options']['order_by']);
						}

						
						$query = $ci->db->get($f['bind_to']);
					}
					if(isset($f['translate'])){	$r->label = lang($r->label); }
					echo '
					<div class="control-group" style="display:inline-table; width: 440px">
				      <label class="control-label">'.lang($f['label']).'</label>
				      <div class="controls">
				      	<select name="'.$f['label'].'" class="input-'.$widget_size.'">
				      		';
				      		if(isset($f['select_options']['blank'])){
					      		echo '<option value="">...</option>';
				      		}
				      		foreach($query->result() as $r):
				      			if($r->val == $params['values']->$f['label']){
					      			$selected = ' selected="selected" ';
				      			}else{
					      			$selected = '';
				      			}
				      			echo '<option value="'.$r->val.'" '.$selected.'>'.$r->label.'</option>';
				      		endforeach;
				      		echo '
				      	</select>
				      	
				      </div>
				    </div>
				    ';
					break;
			}
		elseif($f['viewable'] == false and $f['editable'] == true):
			if(!isset($f['default'])){ $f['default'] = ''; }
			echo ' <input type="hidden" name="'.$f['label'].'" value="'.$f['default'].'" />';
		endif;
	endforeach;
	
/* 	echo "<pre>".print_r($struct['fields'])."</pre>"; */
}

function liveTable($struct, $params = null){
	$ci=& get_instance();
	$params['show'] = explode(',',$params['show']);


	echo '<table class="table table-striped table-bordered table-condensed">
			<thead>
				<tr>
					<th width="30px">
						<input type="checkbox" id="check_all" />
					</th>';
			
	foreach($struct['fields'] as $f):
		if(isset($params['show'])){
			if(in_array(trim($f['label']), $params['show'])){
				echo '<th>'.lang($f['label']).'</th>';				
			}
		}else{
			echo '<th>'.lang($f['label']).'</th>';
		}
	endforeach;

	echo '<th></th>';
			
	echo '</tr>
	</thead>
	<tbody>';
	
	foreach($params['values'] as $v){
		if(!isset($v->wf_step)){ $v->wf_step = ''; }
		
		echo '<tr class="row-state-'.$v->wf_step.'">';
		echo '<td><input type="checkbox" id="el-'.$v->id.'" class="row-checker" /></td>';
			foreach($struct['fields'] as $f):
				if(isset($params['show'])){
					if(in_array(trim($f['label']), $params['show'])){
						if($f['widget'] == 'date'){
							
/* 							if(sizeof($v->$f['label']) > 10){ */
								$v->$f['label'] = date('d-m-Y',$v->$f['label']);
/* 							}else{ */
								$v->$f['label'];	
/* 							} */
							
						}elseif($f['widget'] == 'textarea'){
						
							$v->$f['label'] = mb_strimwidth($v->$f['label'], 0, 40, '...');	
							
						}elseif($f['widget'] == 'money'){
						
							if(!strrpos($v->$f['label'],',')){
								$v->$f['label'] = $v->$f['label'].',00';	
							}
							
							
						}elseif($f['widget'] == 'select'){
							
							$ci->db->select("CONCAT(".$f['select_options']['select'].") AS label, ".$f['select_options']['condition_field']." AS val");
							$q = $ci->db->get_where($f['bind_to'], 
											array($f['select_options']['condition_field'] => $v->$f['label']));
						
							foreach($q->result() as $r){
								$v->$f['label'] = $r->label;
							}
						}elseif($f['widget'] == 'worflow'){
							if($v->$f['label'] == 'draft'){ $l = ''; }
							elseif($v->$f['label'] == 'new'){ $l = 'info'; }
							elseif($v->$f['label'] == 'deleted'){ $l = 'important'; }
							elseif($v->$f['label'] == 'approved'){ $l = 'success'; }
							elseif($v->$f['label'] == 'closed'){ $l = 'success'; }
							elseif($v->$f['label'] == 'binded'){ $l = 'success'; }							
							else{ $l = 'info'; }
							
							$v->$f['label'] = '<span class="label label-'.$l.'">'.$v->$f['label'].'</span>';
						}
						echo '<td>'.$v->$f['label'].'</td>';
					}
					
				}else{
					echo '<td>'.$v->$f['label'].'</td>';
				}
			endforeach;	
			
		echo '<td>';
		foreach($params['actions'] as $a){
				if(isset($a['js_class'])){
					echo '<a name="'.$v->id.'" href="#" id="row-'.$v->id.'" class="'.$a['js_class'].'" title="'.$a['label'].'" rel="tooltip">
							<i class="'.$a['icon'].'"></i>
							</a>';
				}else{
					echo anchor($a['target'].$v->id, 
							'<i class="'.$a['icon'].'"></i>', 
							array('rel' => 'tooltip', 'title' => $a['label'], 'id' => 'row-'.$v->id)
						);
				}
		}
		echo '</td>';		
	echo '</tr>';
	}
	
	echo '</tbody>
	</table>';
	
		
}


function showFlashes($msg){
	if(isset($msg)){
		foreach($msg as $m){
			echo '<div class="alert alert-'.$m['type'].'">'.$m['msg'].'</div>';
		}
	}
}

function live_currency(){
	return '&egrave;';
}

function whoami($uid, $field = null){
	$ci=& get_instance();
	
	$query = $ci->db->get_where('users', array('id' => $uid));
	foreach($query->result() as $r){
		if(!$field){
			return $r->first_name.' '.$r->second_name;
		}else{
			return $r->$field;
		}
	}
}


function get_addr($pid,$kind){
	$ci=& get_instance();
	$query = $ci->db->get_where('partner_addresses', array('partner_id'=>$pid, 'address_kind' => $kind));
	foreach($query->result() as $r){
		
	}
	
	return $r;

}
?>