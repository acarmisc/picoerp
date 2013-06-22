<?php foreach($users as $u): ?>

<h3><?= $u->first_name ?> <?= $u->second_name ?></h3>

<p><label>e-mail</label> <?= $u->email ?></p>
<?php endforeach; ?>

<h4>Groups</h4>
<?php
	$query = $this->db->get('groups'); 
	foreach($query->result() as $row):
		$query1 = $this->db->get_where('users_groups', array('uid' => $u->id, 'gid' => $row->id));
		$res = $query1->result();

		if(sizeof($res)){ $s = ' checked="checked" '; } else { $s = ''; }
?>

	<p style="display: inline-block; width: 200px;padding:5px; margin:5px; border: 1px solid #ccc;">
		<input <?= $s ?> type="checkbox" title="<?= $u->id ?>" id="group-<?= $row->id ?>" class="group-toggler" name="<?= $row->id ?>" /> <?= $row->name ?></p>

<?php endforeach; ?>
