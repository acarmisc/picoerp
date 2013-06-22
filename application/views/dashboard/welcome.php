  <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    

<h1><?= lang('dashboard') ?></h1>



<div class="span14" class="margin: 0 auto;">
<div class="span7" >
  <h3>NEWS</h3>
  <div class="well newsfeed">
  	 <?php 
	  	$this->db->order_by('id DESC');
	  	$this->db->select('news.*, users.username');
	  	$this->db->join('users', 'users.id = news.author_id');
		$query = $this->db->get_where('news');
		foreach($query->result() as $r){ ?>

		<div class="news-el">
			<p class="pull-right">
				<?= lang('l_'.$r->type) ?>
			</p>
			<h4><?= $r->title ?></h4>
			<p><?= $r->body ?></p>
			<p><small><?= $r->username ?> on <?= date('d-m-Y H:i:s', $r->creation_date) ?></small>
				<?= anchor('dashboard/delete_news/'.$r->id,'delete')?>
			</p>
		</div>

		<?php }
	?>	  
  </div>

</div>

<div class="span5 pull-right">
  <h4>Create new post</h4>
  <?= form_open('dashboard/add_news', array('class' => 'form-horizontal well')) ?>
  	<input type="hidden" name="creation_date" value="<?= time() ?>" />
  	<input type="hidden" name="author_id" value="<?= $this->session->userdata('u_logged_in') ?>" />
  	
  	<div class="control-group">
	    <label class="control-label" for=""><?= lang('title') ?></label>
	    <div class="controls">
	      <input type="text" name="title" class="input-large" placeholder="<?= lang('title') ?>">
	    </div>
    </div>

  	<div class="control-group">
	    <label class="control-label" for=""><?= lang('type') ?></label>
	    <div class="controls">
		    <select name="type">
			    <option value="todo">todo</option>
			    <option value="news">news</option>
			</select>
	    </div>
    </div>

  	<div class="control-group">
	    <label class="control-label" for=""><?= lang('body') ?></label>
	    <div class="controls">
		    <textarea name="body" class="input-xlarge"></textarea>
	    </div>
    </div>
  	
  	<input type="submit" value="<?= lang('add') ?>" class="btn btn-primary" />
  <?= form_close() ?>
</div>

<div class="span12">
	  <h3>ROC</h3>
	  <?php 
		$params = array(array('key'=>'wf_step !=', 'val' => 'binded'));
		liveTable($this->sales_model->modelData('quotationreq'), 
							array('values' => $this->sales_model->getQuoteRequests($params),
									'show' => 'subject,partner_id,wf_step,creation_date',
									'actions' => array(0 => array('icon' => 'icon-download',
																	'label' => 'download file',
																	'target' => '/sales/quotationreq_show_file/'),
														)
								)
						);
		
	?>
	<?= anchor('sales/quote_requests', lang('view_all')) ?>
</div>


<div class="span12">
	  <h3><?= lang('quotes') ?></h3>
	  
<ul class="nav nav-tabs">
  <li class="active"><a href="#quo_data" data-toggle="tab">Data</a></li>
  <li><a href="#quo_charts" data-toggle="tab">Charts</a></li>
  
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="quo_data">	  
		 <table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th><?= lang('name')?></th>
				<th><?= lang('creation_date')?></th>
				<th><?= lang('partner')?></th>	
				<th><?= lang('workflow')?></th>
				<th></th>
			</tr>
		</thead>
		<tbody> 
	  <?php 
		$this->db->limit(5);
		$this->db->order_by('id DESC');
		$this->db->select('quotations.*, partners.name as partner_name');
		$this->db->join('partners', 'partners.id = quotations.partner_id');
		$query = $this->db->get_where('quotations');
		foreach($query->result() as $r){ ?>
			<tr>
				<td><?= $r->title ?></td>
				<td><?= date('d-m-Y', $r->creation_date) ?></td>
				<td><?= $r->partner_name ?></td>
				<td><?= lang('l_'.$r->wf_step) ?></td>
				<td>
					<?= anchor('sales/show_quotation/'.$r->id, '<i class="icon-eye-open"></i>') ?>
				</td>
			</tr>
		<?php }

	?>
	</tbody>
	  </table>
	   </div>
  <div class="tab-pane" id="quo_charts">
  
  <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.arrayToDataTable([
        ['type', 'num'],
        <?php 
        	$query = $this->db->query('SELECT count(*) as n, wf_step from ci_quotations group by wf_step;');
        	foreach($query->result() as $r){
        		echo "['$r->wf_step', $r->n],";
        	}
        ?>
          
        ]);

        // Set chart options
        var options = {'title':'Quotations step distribution',
                       'width':700,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('quo_chart'));
        chart.draw(data, options);
      }
    </script>
    
    
  <div id="quo_chart"></div>
  </div>
  
</div>

	<?= anchor('sales/overview', lang('view_all')) ?>
  </div>

<div class="span12">

<h3>Projects/order</h3>	

<script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.arrayToDataTable([
        ['type', 'num'],
        <?php 
        	$query = $this->db->query('SELECT count(*) as n, type from ci_projects group by type;');
        	foreach($query->result() as $r){
        		echo "['$r->type', $r->n],";
        	}
        ?>
          
        ]);

        // Set chart options
        var options = {'title':'Project types distribution',
                       'width':700,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('prj_chart'));
        chart.draw(data, options);
      }
    </script>

<ul class="nav nav-tabs">
  <li class="active"><a href="#prj_data" data-toggle="tab">Data</a></li>
  <li><a href="#prj_charts" data-toggle="tab">Charts</a></li>
  
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="prj_data">
  <table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th><?= lang('name')?></th>
				<th><?= lang('creation_date')?></th>
				<th><?= lang('estimated_close_date')?></th>	
				<th><?= lang('workflow')?></th>
				<th></th>
			</tr>
		</thead>
		<tbody> 
	  <?php 
		$this->db->limit(5);
		$this->db->order_by('id DESC');
		$query = $this->db->get_where('projects');

		foreach($query->result() as $r){ ?>
			<tr>
				<td><?= $r->name ?> <?= $r->title ?></td>
				<td><?= date('d-m-Y', $r->creation_date) ?></td>
				<td><?= $r->estimated_close_date ?></td>
				<td><?= lang('l_'.$r->wf_step) ?></td>
				<td>
					<?= anchor('projects/show_project/'.$r->id, '<i class="icon-eye-open"></i>') ?>
				</td>
			</tr>
		<?php }
	?>	  
		</tbody>
	  </table>
  </div>
  <div class="tab-pane" id="prj_charts">
  <div id="prj_chart"></div>
  </div>
  
</div>

	  	<?= anchor('projects/', lang('view_all')) ?>
</div>

<!--
<div class="span12">
	  <h3>RDA</h3>	 
	  <table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th><?= lang('subject')?></th>
				<th><?= lang('creation_date')?></th>
				<th><?= lang('project')?></th>	
				<th><?= lang('workflow')?></th>
				<th></th>
			</tr>
		</thead>
		<tbody> 
	  <?php 
		$this->db->limit(5);
		$this->db->select('purchase_request.*, projects.name as project_name, projects.title as project_title');
		$this->db->join('projects', 'projects.id = purchase_request.project_id');
		$this->db->order_by('purchase_request.id DESC');
		$query = $this->db->get_where('purchase_request', array('purchase_request.wf_step' => 'new'));
		foreach($query->result() as $r){ ?>
			<tr>
				<td><?= $r->subject ?></td>
				<td><?= date('d-m-Y', $r->creation_date) ?></td>
				<td><?= $r->project_title ?></td>
				<td><?= lang('l_'.$r->wf_step) ?></td>
				<td>
					<?= anchor('purchases/show_purchases_request/'.$r->id, '<i class="icon-eye-open"></i>') ?>
				</td>
			</tr>
		<?php }
	?>	  
		</tbody>
	  </table>
	  
	  	<?= anchor('purchases/purchase_requests', lang('view_all')) ?>
</div>
-->

<div class="span12">
	  <h3>Purchases</h3>	
	  
	  <table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th><?= lang('name')?></th>
				<th><?= lang('creation_date')?></th>
				<th><?= lang('project')?></th>	
				<th><?= lang('workflow')?></th>
				<th></th>
			</tr>
		</thead>
		<tbody> 
	  <?php 
		$this->db->limit(5);
		$this->db->select('purchases.*, projects.name as project_name, projects.title as project_title');
		$this->db->join('projects', 'projects.id = purchases.project_id');
		$this->db->order_by('purchases.id DESC');
		$query = $this->db->get_where('purchases');
		foreach($query->result() as $r){ ?>
			<tr>
				<td><?= $r->subject ?></td>
				<td><?= date('d-m-Y', $r->creation_date) ?></td>
				<td><?= $r->project_name.' '.$r->project_title ?></td>
				<td><?= lang('l_'.$r->wf_step) ?></td>
				<td>
					<?= anchor('purchases/show_purchases/'.$r->id, '<i class="icon-eye-open"></i>') ?>
				</td>
			</tr>
		<?php }
	?>	  
		</tbody>
	  </table>
	  
	  
	  <?= anchor('purchases/', lang('view_all')) ?>
  </div>





<div class="span12">
	  <h3>SAL/DDT</h3>
	  
	   <table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th><?= lang('name')?></th>
				<th><?= lang('creation_date')?></th>
				<th><?= lang('project')?></th>	
				<th></th>
			</tr>
		</thead>
		<tbody> 
	  <?php 
		$this->db->limit(5);
		$this->db->order_by('id DESC');
		$this->db->select('attachments.*, projects.name as project_name');
		$this->db->join('projects', 'projects.id = attachments.related_to_id');
		$query = $this->db->get_where('attachments', array('scope_id' => 6, 'related_to' => 'projects'));
		foreach($query->result() as $r){ 
			$query1 = $this->db->get_where('invoices', array('sal_id' => $r->id));
			$r1 = $query1->result();
			if(sizeof($r1) == 0){
			?>
			<tr>
				<td><?= $r->title ?></td>
				<td><?= date('d-m-Y', $r->creation_date) ?></td>
				<td><?= $r->project_name ?></td>
				<td>
					<?= anchor('projects/show_project/'.$r->related_to_id, '<i class="icon-eye-open"></i>') ?>
				</td>
			</tr>
		<?php }
		}

	?>
	</tbody>
	  </table>
	<?= anchor('sales/sal', lang('view_all')." SAL") ?> | <?= anchor('sales/ddt', lang('view_all')." DDT") ?>
</div>

  <div class="span12">
	  <h3>Invoices</h3>
	  
	  <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.arrayToDataTable([
        ['invoice_date', 'tot'],
        <?php 
        	$query = $this->db->query('SELECT SUM(amount_untaxed) as tot, invoice_date from ci_invoices WHERE direction = 2 group by invoice_date ORDER BY id DESC LIMIT 15 ;');
        	foreach($query->result() as $r){
        		echo "['".substr($r->invoice_date,0,6)."', $r->tot],";
        	}
        ?>
          
        ]);

        // Set chart options
        var options = {'title':'Invoice emission by date',
                       'width':1100,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.AreaChart(document.getElementById('inv_chart'));
        chart.draw(data, options);
      }
    </script>
    
    
    
    <ul class="nav nav-tabs">
  <li class="active"><a href="#inv_data" data-toggle="tab">Data</a></li>
  <li><a href="#inv_charts" data-toggle="tab">Charts</a></li>
  
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="inv_data">
	  <?php 
		
		liveTable($this->account_model->modelData('invoice'), 
							array('values' => $this->account_model->getInvoicesLimited(10),
									'show' => 'number,partner_id,wf_step,creation_date',
									'actions' => array(0 => array('icon' => 'icon-eye-open',
																	'label' => 'show invoice',
																	'target' => '/account/invoice_show'),
														)
								)
						);
		
	?>	
	
	  </div>
  <div class="tab-pane" id="inv_charts">
  <div id="inv_chart"></div>
  </div>
  
</div>
	<?= anchor('account/', lang('view_all')) ?>  
  </div>
  
<div class="row">
  <div class="span12">
	  <h3>Log</h3>	
	  
	  <table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th>when</th>
				<th>who</th>
				<th>what</th>	
				<th>from</th>
			</tr>
		</thead>
		<tbody> 
	  <?php 
		$this->db->limit(20);
		$this->db->order_by('id DESC');
		$this->db->select('log.*, users.username as uname');
		$this->db->join('users', 'log.uid = users.id');
		$query = $this->db->get_where('log');
		foreach($query->result() as $r){ ?>
			<tr>
				<td><?= date('d-m-Y H:i:s', $r->timestamp) ?></td>
				<td><?= $r->uname ?></td>
				<td>(<?= $r->event ?>)<?= $r->description ?></td>
				<td><?= $r->ipaddr ?></td>
			</tr>
		<?php }
	?>	  
		</tbody>
	  </table>
	  
	  
	  <?= anchor('administration/log/', lang('view_all')) ?>
  </div>
 
</div>

</div>