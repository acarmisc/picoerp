<div class=" form-search well">
<form class="" style="display:inline" onsubmit="return false;">
  <input type="text" class="input-medium search-query" name="project-q" data-table="projects" data-field="title"  placeholder="title">
  <input type="text" class="input-medium search-query" name="project-q" data-table="projects" data-field="partners.name" placeholder="customer">
<input type="text" class="input-medium search-query" name="project-q" data-table="projects" data-field="ordine_cliente" placeholder="customer order">  
  <!-- <button type="submit" class="btn">Search</button>-->
  
</form>


<div class="pull-right btn-group" data-toggle="buttons-checkbox" id="transactions-
filter">
    <button class="btn active" onclick="liveToggle('row-spare')">spare</button>
    <button class="btn active" onclick="liveToggle('row-project')">project</button>
    <button class="btn active" onclick="liveToggle('row-extra')">extra</button> 
    <button class="btn active" onclick="liveToggle('row-100')">full</button> 
</div>
</div>

<div class="">
	<?= anchor('projects/new_project', '<i class="icon-plus icon-white"></i> '.lang('new_project'), array('class'=>'btn btn-primary btn-small')) ?>
</div>


<div id="projects-browser">
	<?php $this->load->view('projects/browser'); ?>
</div>


<div class="pull-right">
	<?= anchor('projects/new_project', '<i class="icon-plus icon-white"></i> '.lang('new_project'), array('class'=>'btn btn-primary btn-small')) ?>
</div>
