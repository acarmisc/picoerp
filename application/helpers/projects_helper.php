<?php 
function nextProjectName(){
	$ci=& get_instance();
	
	$query = $ci->db->get('projects');
	
	$ci->db->limit(1);
	$ci->db->order_by('id DESC');
	$query = $ci->db->get('projects');
	$latest = $query->result();
	
	if(sizeof($latest)>0):
	
		$latest = substr($latest[0]->name, 9, strlen($latest[0]->name));
		$latest = intval($latest);
		$latest++;

	else:
		
		$latest = 1;
	
	endif;
	
	if($latest < 100){
		$latest = "0".$latest;
	}
	
	$res = $ci->session->userdata('settings')->project_code.'/'.date('Y',time()).'/'.$latest;
	
	return $res;
	
}

function project_progress_lit($id){
	$ci=& get_instance();

	$query_p = $ci->db->get_where('projects', array('id' => $id));
	foreach($query_p->result() as $rp){
		$order_amount = $rp->order_amount;
	}

	$invoiced = 0;

	$ci->db->where('related_to','projects');
	$query_a = $ci->db->get_where('attachments', array('attachments.related_to_id' => $id));
	foreach($query_a->result() as $a){

		$query_i = $ci->db->get_where('invoices',array('sal_id' => $a->id));
		foreach($query_i->result() as $i){
				
			$invoiced += $i->amount_untaxed;

		}
	}



	$res = $invoiced * 100 / $order_amount;

	echo $invoiced;
	/*
	 echo $order_amount;
	echo "-";
	echo $invoiced;
	*/
	// echo round($res,2);
}

function project_progress($id){
	$ci=& get_instance();

	$query_p = $ci->db->get_where('projects', array('id' => $id));
	foreach($query_p->result() as $rp){
		$order_amount = $rp->order_amount;
	}
	
	$invoiced = 0;

	$ci->db->where('related_to','projects');
	$query_a = $ci->db->get_where('attachments', array('attachments.related_to_id' => $id));
	foreach($query_a->result() as $a){

		$query_i = $ci->db->get_where('invoices',array('sal_id' => $a->id));
		foreach($query_i->result() as $i){
							
			$invoiced += $i->amount_untaxed; 

		}
	}
	

	
	$res = $invoiced * 100 / $order_amount;
	
/*
	echo $order_amount;
	echo "-";
	echo $invoiced;
*/
	echo round($res,2);
}

function testSumInvoice($prj){
	$ci=& get_instance();
	$tot = 0;
	
	$ci->db->where('direction', 2);	
	$query1 = $ci->db->get_where('invoices', array('project_id'=>$prj));
	foreach($query1->result() as $r1){
		$tot += $r1->amount_untaxed - $r1->transfer;
	}
	
	return $tot;
}


function projectCalcSum($prj){
	$ci=& get_instance();
	
	$price_budget = 0.0;
	$price_closed = 0.0;
	$price_sold = 0.0;
	$real_margin = 0;
	$base_sum = 0;
	
	$query1 = $ci->db->get_where('projects', array('id'=>$prj));
	foreach($query1->result() as $r1){
		$order_amount = $r->order_amount;
	}
	
	$query = $ci->db->get_where('project_items', array('project_id' => $prj));
	foreach($query->result() as $p){
		if(isset($p->price_budget)){ $price_budget += $p->price_budget; }

		if($p->price>0){ 
			$price_closed += $p->price; 
		}else{
			$price_closed += $p->price_budget;
		}
		if(isset($p->price_sold)){ $price_sold += $p->price_sold; }

		if(!isset($p->price)){
			$base_sum += $p->price;
		}else{
			$base_sum += $p->price_budget;
		}
	}
	$order_amount = 0;
//	$real_margin = round(($order_amount-$price_closed)/$order_amount*100,2);
	
	$price_closed = testSumInvoice($prj);
	
	$res = array('price_budget' => $price_budget,
				 'price_closed' => $price_closed,
				 'price_sold' => $price_sold,
				 'real_margin' => $real_margin,
				 'order_amount' => $order_amount);
	
	return $res;
	
}


function projectCalcSumExtra($prj){
	$ci=& get_instance();
	
	$price_budget = 0.0;
	$price_closed = 0.0;
	$price_sold = 0.0;
	$real_margin = 0;
	$order_amount = 0;
	
	$query_p = $ci->db->get_where('projects', array('parent_id' => $prj));

	foreach($query_p->result() as $sp){
	
		$order_amount += $sp->order_amount;
	
		$query = $ci->db->get_where('project_items', array('project_id' => $sp->id));

		foreach($query->result() as $p){
			if(isset($p->price_budget)){ $price_budget += $p->price_budget; }
			//if(isset($p->price)){ $price_closed += $p->price; }
			$price_closed += testSumInvoice($sp->id);
			if(isset($p->price_sold)){ $price_sold += $p->price_sold; }
			}
	}
	
	
	$real_margin = round($price_closed*100/$price_sold,2);
	
	$res = array('price_budget' => $price_budget,
				 'price_closed' => $price_closed,
				 'price_sold' => $price_sold,
				 'real_margin' => $real_margin,
				 'order_amounts' => $order_amount);
	
	return $res;
	
}

function extraCalc($prj,$kind){
	$ci=& get_instance();
	$res = 0.0;
	$query = $ci->db->get_where('projects', array('type'=>'extra', 'parent_id' => $prj));
	$childs = $query->result();
	if($kind == 'cost'):
		
		// TODO: manca controllo sullo stato dell'item
		foreach($childs as $r){
			$query1 = $ci->db->get_where('project_items', array('project_id' => $r->id));
			foreach($query1->result() as $r1){
				$res += $r1->price_budget;
			}
		}
	elseif($kind == 'order'):
		foreach($childs as $r){
			$res += $r->order_amount;
		}
	else:
		$res = 0.0;
	endif;
	
	return $res;
}

?>