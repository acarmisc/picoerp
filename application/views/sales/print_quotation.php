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
	<header>
		<p><label>Oggetto</label>
			<span class="value"><?= $object['head']->title?></span></p>
			
		<p><label>Creato il</label>
			<span class="value"><?= date('d-m-Y',$object['head']->creation_date)?></span> 
		<label>Modificato il</label>
			<span class="value"><?= date('d-m-Y',$object['head']->update_date)?></span></p>
						
		<p><label>Cliente</label>
			<span class="value"><?= $object['head']->name ?></span> 
		
		<p><label>Descrizione</label>
			<span class="value"><?= $object['head']->description ?></span></p>
		
	</header>
	<article>
		<h3>Elementi</h3>
		<table style="font-size:9pt">
			<tr>
				<th>Item</th>
				<th>Descrizione</th>
				<th width="150px">Prezzo</th>
			</tr>
			<?php $tot = 0; ?>
		<?php foreach($object['childs'] as $c): ?>
			<tr>
				<td><?= $c->product_name ?></td>
				<td><?= $c->description ?></td>
				<td><?= $c->price_external ?> &euro;</td>
			</tr>
			<?php $tot += $c->price_external; ?>
		<?php endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td><b><?= $tot ?> &euro;</b></td>
			</tr>
		</table>
	</article>
	<!--
	<pre>
		<?php print_r($object); ?>
	</pre>
	-->
	</body>
</html>

