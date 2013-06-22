<html>
	<head>
		<title>Printable</title>
		<style type="text/css">
			body {
				margin: 0.5cm;
				background-image: url('http://www.heh-it.com/assets/img/bg-print.jpg');
				background-repeat: repeat-y;
				margin-top: 6.5cm;
				font-family: Verdana, Arial, sans-serif;
				font-size: 15px;
			}
			
			header {
				padding: 0.3cm;
			}
			
			label {
				min-width: 3cm;
				display: inline-block;
				color: #666;
			}
			
			.value {
				padding: 0.2mm;
			}
			
			table {
				width: 18cm;
				border: 1px solid #333;
			}
			
			table th {
				border: 1px solid #666;
			}
			
			table td {
				border: 1px solid #666;
			}
		</style>
	</head>
	<body>
		<h2 style="margin-left:5cm">
	<header>
		<p><label>Oggetto</label>
			<span class="value"><?= $object['head']->subject?></span></p>
			
		<p><label>Creato il</label>
			<span class="value"><?= date('d-m-Y',$object['head']->creation_date)?></span> 
		<label>Modificato il</label>
			<span class="value"><?= date('d-m-Y',$object['head']->update_date)?></span></p>
			
		<p><label>Progetto</label>
			<span class="value"><?= $object['head']->project_name. ' '.$object['head']->project_title ?></span></p>
			
		<p><label>Fornitore</label>
			<span class="value"><?= $object['head']->name ?></span> <label>Rif. preventivo</label>
			<span class="value"><?= $object['head']->quotation_ref ?></span></p>			
		
		<p><label>Note</label>
			<span class="value"><?= $object['head']->notes ?></span></p>
		
	</header>
	<article>
		<h3>Elementi</h3>
		<table>
			<tr>
				<th>Item</th>
				<th>Descrizione</th>
				<th>Quantit&agrave;</th>
			</tr>
		<?php foreach($object['childs'] as $c): ?>
			<tr>
				<td><?= $c->item ?></td>
				<td><?= $c->description ?></td>
				<td><?= $c->qty ?></td>
			</tr>
		<?php endforeach; ?>
		</table>
	</article>
	<!-- 
	<pre>
		<?php print_r($object); ?>
	</pre>
 	-->	
	</body>
</html>

