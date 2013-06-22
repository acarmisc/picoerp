  <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

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
          	$query = $this->db->query('SELECT count(*) as n, wf_step from ci_project_items WHERE project_id = '.$project[0]->id.' group by wf_step;');
          	foreach($query->result() as $r){
          		echo "['$r->wf_step', $r->n],";
          	}
          ?>
            
          ]);

          // Set chart options
          var options = {'title':'Items workflow step distribution',
                         'width':700,
                         'height':300};

          // Instantiate and draw our chart, passing in some options.
          var chart = new google.visualization.BarChart(document.getElementById('loc_chart'));
        chart.draw(data, options);
      }
    </script>

<div class="pull-right">
<?= anchor('projects/show_stats/'.$this->uri->segment(3), '<i class="icon-signal"></i> '.lang('show_stats')) ?> 

<?= anchor("#myModal", '<i class="icon-shopping-cart"></i> '.lang('new_purchase_order'), array('data-toggle'=>'modal', 'id'=>'new_purchase_btn')) ?>


</div>
<p><?= anchor('projects/', lang('back_to_projects')) ?></p>

<div class="well">

	<div class="white-box">
	<div class="tabbable"> <!-- Only required for left/right tabs -->
	  <ul class="nav nav-tabs">
	    <li class="active"><a href="#details" data-toggle="tab"><?= lang('details') ?></a></li>
	    <li><a href="#purchases" data-toggle="tab"><?= lang('purchases') ?></a></li>
	    <li><a href="#invoices" data-toggle="tab"><?= lang('invoices') ?></a></li>
	    <li><a href="#extra" data-toggle="tab"><?= lang('extra') ?></a></li>	    
	    <li><a href="#project_files" data-toggle="tab"><?= lang('project_files') ?></a></li>	    
	    <li><a href="#engineering" data-toggle="tab"><?= lang('engineering') ?></a></li>
	    <li><a href="#drawing" data-toggle="tab"><?= lang('drawing_transmittal') ?></a></li>	    
	    <li><a href="#drawing_hh" data-toggle="tab"><?= lang('drawing_hh') ?></a></li>
	    <li><a href="#drawing_sy" data-toggle="tab"><?= lang('drawing_sy') ?></a></li>
	    <li><a href="#coordination_drawings" data-toggle="tab"><?= lang('coordination_drawings') ?></a></li>
	    <li><a href="#technical_specification" data-toggle="tab"><?= lang('technical_specification') ?></a></li>
	    <li><a href="#supplier_quotations" data-toggle="tab"><?= lang('supplier_quotations') ?></a></li>	    	    
	    <li><a href="#order" data-toggle="tab">Customer orders</a></li>	    	    	    
	    <li><a href="#sal" data-toggle="tab"><?= lang('sal') ?></a></li>	    	    
	    <li><a href="#customer_comunications" data-toggle="tab"><?= lang('customer_comunications') ?></a></li>	    	    
	    <li><a href="#more" data-toggle="tab"><?= lang('more') ?></a></li>
	    <li><a href="#charts" data-toggle="tab">Charts</a></li>	    	    	    	    
	  </ul>
	  <div class="tab-content" >
	    <div class="tab-pane active" id="details">
	    
	    	<?= $this->load->view('projects/details', array('project'=>$project)) ?>
	    
	    </div>
	    <div class="tab-pane" id="purchases">
	    
	    	<?= $this->load->view('purchases/browse', array('project'=>$project)) ?>
	    

	    </div>    
	    <div class="tab-pane" id="invoices">
		  <?= $this->load->view('account/browse',array('project_id' => $this->session->userdata('current_project'))) ?>
	    </div>
	    
	    <div class="tab-pane" id="extra">
		  <?= $this->load->view('projects/extra', array('project'=>$project)) ?>
	    </div>	    
	    
	    <div class="tab-pane" id="project_files">
		  <?= $this->load->view('attachments/quicklist', array('scope'=> 2,
														'related_to' => 'projects',
														'related_to_id' => $this->uri->segment(3))); ?>
	    </div>
	    
	    <div class="tab-pane" id="engineering">
		  <?= $this->load->view('attachments/quicklist', array('scope'=> 3,
														'related_to' => 'projects',
														'related_to_id' => $this->uri->segment(3))); ?>
	    </div>

	    <div class="tab-pane" id="drawing">
		  <?= $this->load->view('attachments/quicklist', array('scope'=> 7,
														'related_to' => 'projects',
														'related_to_id' => $this->uri->segment(3))); ?>
	    </div>

	    <div class="tab-pane" id="drawing_hh">
		  <?= $this->load->view('attachments/quicklist', array('scope'=> 8,
														'related_to' => 'projects',
														'related_to_id' => $this->uri->segment(3))); ?>
	    </div>	    	    

	    <div class="tab-pane" id="drawing_sy">
		  <?= $this->load->view('attachments/quicklist', array('scope'=> 12,
														'related_to' => 'projects',
														'related_to_id' => $this->uri->segment(3))); ?>
	    </div>	
	    
	    <div class="tab-pane" id="coordination_drawings">
		  <?= $this->load->view('attachments/quicklist', array('scope'=> 14,
														'related_to' => 'projects',
														'related_to_id' => $this->uri->segment(3))); ?>
	    </div>	

	    <div class="tab-pane" id="technical_specification">
		  <?= $this->load->view('attachments/quicklist', array('scope'=> 1,
														'related_to' => 'projects',
														'related_to_id' => $this->uri->segment(3))); ?>
	    </div>	    
	    
	    <div class="tab-pane" id="supplier_quotations">
		  <?= $this->load->view('attachments/quicklist', array('scope'=> 11,
														'related_to' => 'projects',
														'related_to_id' => $this->uri->segment(3))); ?>
	    </div>	
	    
	    <div class="tab-pane" id="sal">
		<h3>DDT</h3>
		  <?= $this->load->view('attachments/quicklist', array('scope'=> 5,
														'related_to' => 'projects',
														'related_to_id' => $this->uri->segment(3))); ?>
		<h3>SAL</h3>
		  <?= $this->load->view('attachments/quicklist', array('scope'=> 6,
														'related_to' => 'projects',
														'related_to_id' => $this->uri->segment(3))); ?>
	    </div>	    

	    <div class="tab-pane" id="order">
		  <?= $this->load->view('attachments/quicklist', array('scope'=> 16,
														'related_to' => 'projects',
														'related_to_id' => $this->uri->segment(3))); ?>
	    </div>

	    <div class="tab-pane" id="customer_comunications">
		  <?= $this->load->view('attachments/quicklist', array('scope'=> 15,
														'related_to' => 'projects',
														'related_to_id' => $this->uri->segment(3))); ?>
	    </div>	   	    
	    
	    <div class="tab-pane" id="more">
		  <?= $this->load->view('projects/more_details', array('id'=> $this->uri->segment(3))); ?>
	    </div>	   
	    
	    <div class="tab-pane" id="charts">
		  <div id="loc_chart"></div>
	    </div> 
	    
	  </div>
	</div>
	</div>
	

</div>   

<p align="right">
<a rel="tooltip" title="Add item" data-toggle="modal" href="#myModal" class="project_add_item" name="<?= $this->uri->segment(3) ?>"><i class="icon-plus"></i> <?= lang('add') ?></a>
<?= anchor('projects/show_project/'.$this->session->userdata('current_project'), '<i class="icon-refresh"></i> '.lang('reload_project')) ?></p>

<?= $this->load->view('projects/items', array('items' => $items,'project'=>$project)) ?>

<p align="right">
<a rel="tooltip" title="Add item" data-toggle="modal" href="#myModal" class="project_add_item" name="<?= $this->uri->segment(3) ?>"><i class="icon-plus"></i> <?= lang('add') ?></a>
<?= anchor('projects/show_project/'.$this->session->userdata('current_project'), '<i class="icon-refresh"></i> '.lang('reload_project')) ?></p>



<!-- workflow -->

<?= designWorkflow(2, $project[0]->wf_step, array('table' => 'projects', 'id' => $this->uri->segment(3))) ?>
