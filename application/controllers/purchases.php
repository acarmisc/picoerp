<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchases extends CI_Controller {

/*
	public function index()
	{
		redirect('errors/notallowed');
	}
*/

	public function __construct()
    {
        parent::__construct();
        if (checkRights('purchases','view','live') != true):	redirect('errors/notallowed');	endif;
        $this->load->model('crm_model');        
        $this->load->model('purchases_model');     
        $this->load->model('attachment_model');                
    }
	
	public function overview(){
		$this->index();	
	}
	
	public function index($purchases = null)
	{

		logger(array('description'=>'user open Purchases module', 'event'=>'Purchases index'));			

		$menu = $this->purchases_model->loadMenu();
		$conf = $this->purchases_model->loadConf();
		
		$purchases = $this->purchases_model->getPurchases();
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('purchases/index', array('purchases' => $purchases));
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');
	}	
	
	public function purchase_requests()
	{

		logger(array('description'=>'user open Purchase request module', 'event'=>'Purchases index'));			

		$menu = $this->purchases_model->loadMenu();
		$conf = $this->purchases_model->loadConf();
		
		$purchases = $this->purchases_model->getPurchasesRequests();
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('purchases/purchase_request', array('purchases' => $purchases));
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');
	}		
	
	public function simple_list($params = null){
		echo 'ciao';
	}
	
	public function new_purchase(){
		$this->load->view('purchases/new');
	}
	
	public function new_purchase_request(){
		$this->load->view('purchases/new_request');
	}	
	
	public function add_purchase_row(){
		
		echo '<span class="alert alert-error">Function not yet available</span>';
		
	}
	
	public function show_purchases($id = null){
		if(isset($id)){
			$current = $id;
		}else{
			$current = $this->uri->segment(3);
		}		
		
		logger(array('description'=>'user open purchase '.$current, 'event'=>'Purchase element'));			
			
		$this->session->set_userdata('current_quotation', $current);
		
		$menu = $this->purchases_model->loadMenu();
		$conf = $this->purchases_model->loadConf();
		
		$purchases = $this->purchases_model->getPurchases(array(0=>array('key'=>'purchases.id','val'=>$current)));
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('purchases/bigedit', array('data' => $purchases[0]));
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');		
	}
	
	public function show_purchases_request($id = null){
		if(isset($id)){
			$current = $id;
		}else{
			$current = $this->uri->segment(3);
		}		
		
		logger(array('description'=>'user open purchase request'.$current, 'event'=>'Purchase element'));			
			
		$this->session->set_userdata('current_purchase_request', $current);
		
		$menu = $this->purchases_model->loadMenu();
		$conf = $this->purchases_model->loadConf();
		
		$purchases = $this->purchases_model->getPurchasesRequests(array(0=>array('key'=>'purchase_request.id','val'=>$current)));
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('purchases/bigedit_request', array('data' => $purchases[0]));
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');		
	}	
	
	public function save_purchase(){
		
		$this->db->insert('purchases', $_POST);			

		$last = $this->db->insert_id();
		$this->session->set_userdata('current_purchase', $last);
		$query = $this->db->get_where('purchases', array('id'=>$last));
		
		$res = $query->result();
		
		$this->load->view('purchases/edit', array('data' => $res[0]));
		
	}
	

	public function update_purchase(){
		
		
		$this->db->update('purchases', $_POST, array('id' => $this->uri->segment(3)));
		
		$query = $this->db->get_where('purchases', array('id'=>$this->uri->segment(3)));
		
		$res = $query->result();
		
		redirect('purchases/show_purchases/'.$this->uri->segment(3));
		
	}
		
	
	
	public function save_purchase_request(){
		
		$this->db->insert('purchase_request', $_POST);
		$last = $this->db->insert_id();
		$this->session->set_userdata('current_purchase_request', $last);
		$query = $this->db->get_where('purchase_request', array('id'=>$last));
		
		$res = $query->result();
		
		$this->load->view('purchases/edit_request', array('data' => $res[0]));
		
	}	
	
	public function update_purchase_request(){
		
		
		$this->db->update('purchase_request', $_POST, array('id' => $this->uri->segment(3)));
		
		$this->show_purchases_request();
		
	}	
		
	

	public function review_purchase(){
		
		$query = $this->db->get_where('purchases', array('id'=>$this->uri->segment(3)));
		
		$res = $query->result();
		
		$this->load->view('purchases/edit', array('data' => $res[0]));
		
	}	
	
	public function add_el_to_purchase(){
	
		$query = $this->db->get_where('project_items', array('id' => $this->uri->segment(3)));
		foreach($query->result() as $r){
			$data = array(
				'creation_date' => time(),
				'creation_uid' => $this->session->userdata('u_logged_in'),
				'update_date' => time(),
				'description' => $r->description,
				'qty' => $r->qty,
				'project_item_id' => $this->uri->segment(3),
				'purchase_id' => $this->session->userdata('current_quotation')
			);		
		}
		
		logger(array('description'=>'user add element '.$this->uri->segment(3).' to purchase order'.$this->session->userdata('current_quotation'), 'event'=>'Purchase element'));			
		
		$this->db->insert('purchase_rows', $data);
		
		$this->db->update('project_items', array('wf_step'=>'progress'), array('id' => $this->uri->segment(3)));
		
		echo '
				<tr>
			<td></td>
			<td>'.$r->item.'</td>
			<td>'.$r->description.'</td>
			<td>'.$r->qty.'</td>
			<td>
				';
				echo anchor("/purchases/show_purchases/".$this->session->userdata('current_quotation'), '<i class="icon-repeat">a</i> reload to edit');
		echo'				
			</td>															
		</tr>
		';
		
	}
	
	
	public function add_el_to_purchase_request(){
	
		$query = $this->db->get_where('project_items', array('id' => $this->uri->segment(3)));
		foreach($query->result() as $r){
			$data = array(
				'creation_date' => time(),
				'creation_uid' => $this->session->userdata('u_logged_in'),
				'update_date' => time(),
				'description' => $r->description,
				'qty' => $r->qty,
				'project_item_id' => $this->uri->segment(3),
				'purchase_request_id' => $this->session->userdata('current_purchase_request')
			);		
		}
		
		logger(array('description'=>'user add element '.$this->uri->segment(3).' to purchase request'.$this->session->userdata('current_quotation'), 'event'=>'Purchase element'));			
		
		$this->db->insert('purchase_request_rows', $data);
		
		$this->db->update('project_items', array('wf_step'=>'progress'), array('id' => $this->uri->segment(3)));
		
		echo '
				<tr>
			<td></td>
			<td>'.$r->item.'</td>
			<td>'.$r->description.'</td>
			<td>'.$r->qty.'</td>
			<td>
				';
				echo anchor("/purchases/show_purchases_request/".$this->session->userdata('current_purchase_request'), '<i class="icon-repeat">a</i> reload to edit');
		echo'				
			</td>															
		</tr>
		';
		
	}
	
	public function edit_row(){
		
		$query = $this->db->get_where('purchase_rows', array('id'=>$this->uri->segment(3)));
		$this->load->view('purchases/edit_row', array('row' => $query->result()));
				
	}
	
	public function save_row(){
		$this->db->update('purchase_rows', $_POST, array('id' => $this->uri->segment(3)));

		$query = $this->db->get_where('purchase_rows', array('id' => $this->uri->segment(3)));
		foreach($query->result() as $r){ $to = $r->purchase_id; }

		redirect('purchases/show_purchases/'.$to);
	}
	
	public function convert_to_order(){
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('purchases/convert_to_order', array('id' => $this->uri->segment(3)));
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');		
	}
	
	public function convert_purchase(){
		$this->db->insert('purchases', $_POST);
		
		$latest = $this->db->insert_id();
		
		$query = $this->db->get_where('purchase_request_rows', array('purchase_request_id' => $this->uri->segment(3)));
		foreach($query->result() as $r){
			$data = array(
				'purchase_id' => $latest,
				'project_item_id' => $r->project_item_id,
				'description' => $r->description,
				'creation_date' => time(),
				'creation_uid' => $this->session->userdata('u_logged_in'),
				'qty' => $r->qty
			);
			$this->db->insert('purchase_rows', $data);
		}
		
		$this->db->update('purchase_request', array('wf_step' => 'closed'), array('id' => $this->uri->segment(3)));
		
		redirect('purchases/show_purchases/'.$latest);
	}
	
	public function edit_purchase_request(){	
		$this->db->select('purchase_request_rows.*, project_items.item');
		$this->db->join('project_items', 'project_items.id = purchase_request_rows.project_item_id');
		$this->db->where('purchase_request_rows.id', $this->uri->segment(3));
		$query = $this->db->get('purchase_request_rows');
		
		$this->load->view('purchases/edit_purchase_request', array('row' => $query->result()));
	}
	
	public function edit_purchase_request_save(){
		$this->db->update('purchase_request_rows', $_POST, array('id' => $this->uri->segment(3)));
		
		echo '<div class="alert-success">saved.</div>';
		echo '<p>'.anchor('purchases/show_purchases_request/'.$_POST['purchase_request_id'],'reload').'</p>';
	}
	
	public function delete_purchase_request(){
		logger(array('description'=>'user delete purchase request '.$this->uri->segment(3), 'event'=>'delete_purchase_request'));
		
		$this->db->delete('purchase_request', array('id' => $this->uri->segment(3)));
		
		$this->purchase_requests();
		
	}
	
	public function delete_purchase(){
		logger(array('description'=>'user delete purchase request '.$this->uri->segment(3), 'event'=>'delete_purchase_request'));
		
		$this->db->delete('purchases', array('id' => $this->uri->segment(3)));
		
		$this->index();
		
	}	
	
	public function delete_purchase_request_row(){
		logger(array('description'=>'user delete purchase request row '.$this->uri->segment(3), 'event'=>'delete_purchase_request_row'));
		
		$this->db->limit(1);
		$this->db->delete('purchases_request_rows', array('id' => $this->uri->segment(3)));
		
		$this->show_purchases_request($this->uri->segment(4));
	}
	
	public function print_purchases_request(){
		logger(array('description'=>'user try to print purchase request '.$this->uri->segment(3), 'event'=>'print_purchases_request'));
		
		$object = $this->purchases_model->fetch_full_request($this->uri->segment(3));
		
		$html = $this->load->view('purchases/print_purchase_request', array('object' => $object), true);
		
		// echo $html;
		
		echo header('Content-type: application/pdf');
		echo header('Content-Disposition: inline; filename=purchase_request_'.$this->uri->segment(3).'.pdf');
		echo pdf_create($html, '', false);
		
	}
	
	public function print_preview_purchases_request(){
		logger(array('description'=>'user try to print purchase request '.$this->uri->segment(3), 'event'=>'print_purchases_request'));
		
		$object = $this->purchases_model->fetch_full_request($this->uri->segment(3));
		
		$html = $this->load->view('purchases/print_purchase_request', array('object' => $object), true);
		
		echo $html;
	}
	
	
	public function print_purchases(){
		logger(array('description'=>'user try to print purchase  '.$this->uri->segment(3), 'event'=>'print_purchases_request'));
		require_once(APPPATH."helpers/dompdf/dompdf_config.inc.php");
		
		$object = $this->purchases_model->fetch_full($this->uri->segment(3));

		
		$html = $this->load->view('purchases/purchase_page', array('object' => $object), true);
		
		
		// echo $html;
		$dompdf = new DOMPDF();
		$dompdf->load_html(ascii_to_entities($html));
		
		$dompdf->render();
		
		$canvas = $dompdf->get_canvas();
		$dompdf->stream("purchase_".$this->uri->segment(3).".pdf", array("Attachment" => 1));
		
		/*
		echo header('Content-type: application/pdf');
		echo header('Content-Disposition: inline; filename=purchase_request_'.$this->uri->segment(3).'.pdf');
		echo pdf_create($html, '', false);
		*/
	}
	
	public function print_purchases_new(){
		logger(array('description'=>'user try to print purchase  '.$this->uri->segment(3), 'event'=>'print_purchases_request'));
	
		require_once(APPPATH."helpers/dompdf/dompdf_config.inc.php");
	
		$object = $this->purchases_model->fetch_full($this->uri->segment(3));
	
		$html = $this->load->view('purchases/purchase_page', array('object' => $object), true);
		$dompdf = new DOMPDF();
		$dompdf->load_html(ascii_to_entities($html));
	
		$dompdf->render();
	
		$canvas = $dompdf->get_canvas();
		$dompdf->stream("purchase_".$this->uri->segment(3).".pdf", array("Attachment" => 1));
		/*
			require_once(APPPATH."helpers/dompdf/dompdf_config.inc.php");
	
		echo header('Content-type: application/pdf');
		echo header('Content-Disposition: inline; filename=purchase_request_'.$this->uri->segment(3).'.pdf');
		echo pdf_create($html, '', false);
		*/
	}
	
	public function print_preview_purchases(){
		logger(array('description'=>'user try to print purchase  '.$this->uri->segment(3), 'event'=>'print_purchases'));
		
		$object = $this->purchases_model->fetch_full($this->uri->segment(3));
		
		$html = $this->load->view('purchases/purchase_page', array('object' => $object), true);
		
		echo $html;
	}	
	
	public function print_data(){
		
		$object = $this->purchases_model->fetch_full($this->uri->segment(3));
		echo '<html><body>';
		echo "<pre>".print_r($object)."</pre>";
		echo '</body></html>';
	}

	public function fast_query(){
		$field = $this->uri->segment(3);
		$vals = $this->uri->segment(4);
		
		$params = array(0=>array('key'=>$field,'val'=>$vals));
		$purchases = $this->purchases_model->searchPurchases($params);
		$this->load->view('purchases/browse',array('purchases' => $purchases));

	}	

	public function purchase_item_split(){
		$query = $this->db->get_where('purchase_rows', array('id' => $this->uri->segment(3)));
		foreach($query->result() as $r){ 
			echo '<p>Splitting item <i>'.$r->description.'</i></p>';
			echo '<p>In how many items do you want to split this one?</p>';
			echo form_open('/purchases/do_purchase_item_split/'.$this->uri->segment(3));
			echo '
				<input type="text" class="input-small" size="10" name="num" id="split-item"/>
				<input type="submit" class="btn-default" value="Split" />
			';
			echo form_close();
		}
	}

	public function do_purchase_item_split(){
		//print_r($_POST);
		$query = $this->db->get_where('purchase_rows', array('id' => $this->uri->segment(3)));
		foreach($query->result() as $r){ 
			$data = array('project_item_id' => $r->project_item_id,
							'description' => $r->description,
							'purchase_id' => $r->purchase_id,
							'creation_date' => time(),
							'creation_uid' => 1);

			for ($i = 1; $i <= $_POST['num']; $i++) {
 		   		$this->db->insert('purchase_rows', $data);
			}
		}

		$this->show_purchases($this->uri->segment(4));
	}
	
}