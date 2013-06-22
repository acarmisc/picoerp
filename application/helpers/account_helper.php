<?php

function nextInvoiceName(){
	$ci=& get_instance();
	
	$query = $ci->db->get('invoices');
	
	$ci->db->limit(1);
	$ci->db->order_by('id DESC');
	$query = $ci->db->get('invoices');
	$latest = $query->result();
	
	if(sizeof($latest)>0):
	
		$latest = substr($latest[0]->number, 9, strlen($latest[0]->number));
		$latest = intval($latest);
		$latest++;

	else:
		
		$latest = 1;
	
	endif;
	if(strlen($latest) == 1){ $latest = '00'.$latest; }
	if(strlen($latest) == 2){
		$latest = '0'.$latest;
	}
	$res = $ci->session->userdata('settings')->invoice_code.'/'.date('Y',time()).'/'.$latest;
	
	return $res;
	
}

?>