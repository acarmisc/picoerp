<div id="crm-banks-form">

<h3><?= lang('last_actions') ?></h3>
<dl class="dl-horizontal">

<?php foreach($history as $h): ?>

<dt><?= $h->title ?></dt>
<dd><?= $h->description ?></dd>
<dd><?= date('d-m-Y',$h->creation_date) ?> by <?= $h->creation_uid ?></dd>
<dd><?= anchor('/sales/show_quotation/'.$h->id, lang('show'))?></dd>

<?php endforeach; ?>

<dl class="dl-horizontal">

<?php foreach($invoices as $i): ?>

<dt><?= $i->number ?></dt>
<dd><?= $i->description ?></dd>
<dd><?= date('d-m-Y',$i->creation_date) ?> by <?= $i->creation_uid ?></dd>
<dd><?= anchor('/account/show_invoice/'.$i->id, lang('show'))?></dd>

<?php endforeach; ?>


</table>
</div>
