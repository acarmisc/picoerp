<div class=" form-search well"
<form class="" onsubmit="return false;">
  <!--<input type="text" class="input-medium search-query">
  <button type="submit" class="btn">Search</button> -->
  <label>YEAR</label>
  <select name="year" class="input-small" onchange="window.location.href='?year='+$(this).val()">
  	<option value="null"  <?php if(!$_GET['year']){echo 'selected="selected"';}?>>All</option>
  	<option value="2013" <?php if($_GET['year'] == '2013'){echo 'selected="selected"';}?>>2013</option>
  	<option value="2012" <?php if($_GET['year'] == '2012'){echo 'selected="selected"';}?>>2012</option>
  </select>
</form>
<div class="pull-right">
	<label> </label>
	<div class=" btn-group" data-toggle="buttons-checkbox" id="transactions-
	filter">
	    <button class="btn active" onclick="liveToggle('row-draft')">draft</button>
<!-- 	    <button class="btn active" onclick="liveToggle('row-state-open')">open</button> -->
	    <button class="btn active" onclick="liveToggle('row-sent')">sent</button>  
	    <button class="btn active" onclick="liveToggle('row-closed')">closed</button>    
	    <button class="btn active" onclick="liveToggle('row-payment')">payment</button>    
	</div>
	<label> </label>
	<div class=" btn-group" data-toggle="buttons-checkbox" id="transactions-
	filter"> 
	    <button class="btn active" onclick="liveToggle('row-1')">inv in</button>
	    <button class="btn active" onclick="liveToggle('row-2')">inv out</button>
		<button class="btn active" onclick="liveToggle('row-3')">CN in</button>
	    <button class="btn active" onclick="liveToggle('row-4')">CN out</button>	    
	</div>
	<label> </label>
		<select onchange="liveFilter($(this).val())">
					<option value="">...</option>		
	<?php 
		$this->db->group_by('project_id');
		$this->db->select('projects.name');
		$this->db->join('projects', 'projects.id = invoices.project_id');
		$query = $this->db->get('invoices');
		foreach($query->result() as $r){
	?>
		<option value="<?= $r->name ?>"><?= $r->title ?> <?= $r->name ?></option>		
	<?php
		}
	?>
		</select>
</div>


<script >
function liveFilter(a){
	if(a == ''){
		$('td').parent().fadeToggle();	
	}else{
		$('td:contains("'+a+'")').parent().fadeToggle();
		$('td:not(contains("'+a+'"))').parent().fadeToggle();
	}
}

</script>
</div>


<div class="pull-right">
	<?= anchor('account/invoice_new', '<i class="icon-plus icon-white"></i> '.lang('new'), array('class'=>'btn btn-primary btn-small')) ?>
</div>

<div id="invoices-browser">

<table class="table table-striped table-bordered table-condensed">
			<thead>
				<tr>
					<th width="30px">
						
					</th>
					<th>number</th>
					
					<th>partner</th>
					<th>workflow</th>
					<th>amount</th>
					<th>date</th>
					<th>date due</th>
					<th></th>
				</tr>
	</thead>
<?php 
if($_GET['year']){ if($_GET['year'] == 'null'){ $_GET['year'] = ''; }}
$rows = $this->account_model->getInvoices(null, $_GET['year']);
$params = array('actions' => array('1' => array('icon' => 'icon-trash',
																	'label' => 'delete invoice',
																	'target' => '/account/invoice_delete/'),
													   '2' => array('icon' => 'icon-eye-open',
																	'label' => 'show invoce',
																	'target' => '/account/invoice_show/'),
														)); ?>	
	<tbody>
	<?php foreach($rows as $r): ?>
		<tr class="row-<?= $r->wf_step ?> row-<?= $r->direction ?>">
					<td width="">
						<?php echo anchor('#',
										lang('i_'.str_replace(' ','',$r->direction_name)),
										array('rel' => 'tooltip', 'title' => $r->direction_name)) ?>
					</td>
					<td><?= $r->number ?></td>
					
					<td><?= $r->partner ?></td>
					<td><?= lang('l_'.$r->wf_step) ?></td>
					<!-- <td><?= $r->amount_untaxed - $r->transfer ?></td>-->
					<td><?= money_format('%.2n',$r->amount_untaxed- $r->transfer + round(($r->amount_untaxed - $r->transfer)/100*$r->taxes,2)) ?></td>
					<td><?= $r->invoice_date ?></td>
					<td><?= $r->date_due ?></td>
					<td>
						<?php 
						foreach($params['actions'] as $a){
							if(isset($a['js_class'])){
								echo '<a name="'.$r->id.'" href="#" id="row-'.$r->id.'" class="'.$a['js_class'].'" title="'.$a['label'].'" rel="tooltip">
								<i class="'.$a['icon'].'"></i>
								</a>';
							}else{
								echo anchor($a['target'].$r->id,
										'<i class="'.$a['icon'].'"></i>',
										array('rel' => 'tooltip', 'title' => $a['label'], 'id' => 'row-'.$r->id)
								);
							}
						}
						?>
					</td>
				</tr>
	<?php endforeach; ?>
	</tbody>	
</table>
</div>

<div class="pull-right">
	<?= anchor('account/invoice_new', '<i class="icon-plus icon-white"></i> '.lang('new'), array('class'=>'btn btn-primary btn-small')) ?>
</div>

