<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if (checkRights('account','view','live') != true):	redirect('errors/notallowed');	endif;
        $this->load->model('crm_model');        
        $this->load->model('purchases_model');     
        $this->load->model('attachment_model'); 
        $this->load->model('account_model');  
        $this->load->model('projects_model');        

        $this->load->library('calendar', array('show_next_prev' => true, 'next_prev_url' => base_url().'account/deadlines'));        
        $this->load->helper('account_helper');                                
    }

	public function index()
	{

		logger(array('description'=>'user open Account module', 'event'=>'Account index'));			

		$menu = $this->account_model->loadMenu();
		$conf = $this->account_model->loadConf();
		
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('account/list');
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');
	}
	
	public function overview()
	{
		$this->index();
	}

	public function invoice_show()
	{
		logger(array('description'=>'user open invoice '.$this->uri->segment(3), 'event'=>'invoice show'));			

		$this->session->set_userdata('current_invoice',$this->uri->segment(3));

		$menu = $this->account_model->loadMenu();
		$conf = $this->account_model->loadConf();
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('account/show');
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');

	}
	
	public function invoice_new()
	{
		logger(array('description'=>'user try to create a new invoice', 'event'=>'invoice new'));			

		$menu = $this->account_model->loadMenu();
		$conf = $this->account_model->loadConf();
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('account/create');
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');

	}


	public function invoice_save()
	{
		logger(array('description'=>'user save a new invoice', 'event'=>'invoice save'));			

		if($_POST['direction'] == 2){
			$_POST['number'] = nextInvoiceName();
		}
		
		if($_POST['direction'] == 1){
			$q1 = $this->db->get_where('purchases', array('id' => $_POST['purchase_order_id']));
			foreach($q1->result() as $r1){
				$_POST['project_id'] = $r1->project_id;	
			}			
		}
		
		if (isset($_POST['sal_id'])){
			$aid = $_POST['sal_id'];
			$this->db->select('projects.name, projects.id, projects.ordine_cliente');
			$this->db->join('projects', 'related_to_id = projects.id','left');
			$this->db->where('attachments.id', $aid);
			$this->db->where('related_to','projects');
			$query = $this->db->get('attachments');
			$res = $query->result();
			
			foreach($res as $r){
				$_POST['project_id'] = $r->id;
			}
			
			if(sizeof($res) == 0){
				$q1 = $this->db->get_where('attachments', array('id' => $aid));
				foreach($q1->result() as $r1){
					$this->db->select('projects.name, projects.id, projects.ordine_cliente');
					$this->db->join('projects', 'purchases.project_id = projects.id','left');	
					$this->db->where('purchases.id', $r1->related_to_id);
					$query = $this->db->get('purchases');
					$res1 = $query->result();
					foreach($res1 as $r2){
						$_POST['project_id'] = $r2->id;
					}	
				}			
			}
		}
		
		$_POST['wf_flow'] = 5;
		$_POST['wf_step'] = 'draft';		
		$_POST['creation_date'] = time();	
		$_POST['creation_uid'] = $this->session->userdata('u_logged_in');						

		$this->db->insert('invoices', $_POST);
		$invoice = $this->db->insert_id();
		// create to pay rows
		$query = $this->db->get_where('payment_methods', array('id' => $_POST['payment_method_id']));
		foreach($query->result() as $row){ $terms = $row->payments_no; }
		
		while ($terms > 0) {
			$terms--;
			$data = array(
						'invoice_id' => $invoice,
						'amount' => 0.0,
						'creation_date' => time(),
						'update_date' => time(),
						'creation_uid' => $this->session->userdata('u_logged_in')
					);
			$this->db->insert('invoice_terms', $data);
		}
		
		redirect('account/invoice_show/'.$invoice);

	}
	
	public function invoice_update()
	{
		logger(array('description'=>'user update an invoice', 'event'=>'invoice update'));			

		$_POST['update_date'] = time();				
		
		if (isset($_POST['sal_id'])){
			// bind to project
			$query = $this->db->get_where('attachments', array('id' => $_POST['sal_id']));
			foreach($query->result() as $r){
				$_POST['project_id'] = $r->related_to_id;
			}
		}

		$this->db->update('invoices', $_POST, array('id' => $this->uri->segment(3)));
			
		redirect('account/invoice_show/'.$this->uri->segment(3));

	}	
	
	public function payment_new()
	{

		logger(array('description'=>'user try to create a new payment for invoice ID: '.$this->uri->segment(3), 'event'=>'payment new'));			

		$menu = $this->account_model->loadMenu();
		$conf = $this->account_model->loadConf();
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('account/create_payment', array('invoice_id' => $this->uri->segment(3)));
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');
		
	}	
	
	public function payment_save()
	{
		logger(array('description'=>'user try to save a new payment', 'event'=>'payment save'));			

		$errors = 0;

		$_POST['creation_date'] = time();	
		$_POST['creation_uid'] = $this->session->userdata('u_logged_in');						

		$query = $this->db->get_where('invoices', array('id' => $this->uri->segment(3)));
		foreach($query->result() as $r){
			$id = $r->id;
			$residual = $r->residual - $_POST['amount'];
			if($residual < 0){	$errors++; }
		}

		if($errors < 1){
			$this->db->insert('invoice_payments', $_POST);
			
			$this->db->update('invoices', array('residual' => $residual), array('id' => $id));
			
			logger(array('description'=>'user saved a new payment', 'event'=>'payment save'));						
			
			redirect('account/invoice_show/'.$this->uri->segment(3));
			
		}else{
		
			logger(array('description'=>'error saving payment', 'event'=>'payment save'));						
					
			$this->accoun_error();
		}
		
	}	
	
	public function account_error(){
		echo "error!";
	}

	public function deadlines()
	{

		logger(array('description'=>'user open Deadlines ', 'event'=>'Deadlines index'));			

		$menu = $this->account_model->loadMenu();
		$conf = $this->account_model->loadConf();
		
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('account/deadlines');
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');
	}

	public function deadlines_show()
	{

		logger(array('description'=>'user open Deadlines details', 'event'=>'Deadlines details'));			

		$menu = $this->account_model->loadMenu();
		$conf = $this->account_model->loadConf();
		
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('account/deadlines_show');
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');
	}	
	
	public function update_term()
	{
		$this->db->update('invoice_terms', $_POST, array('id'=> $_POST['id']));
		echo '<span class="alert-success">saved.</span>';
	}
	
	public function bind_to_project()
	{
		$aid = $this->uri->segment(3);
		
		$this->db->select('projects.name, projects.ordine_cliente');
		$this->db->join('projects', 'related_to_id = projects.id','left');
		$this->db->where('attachments.id', $aid);
		$this->db->where('related_to','projects');
		$query = $this->db->get('attachments');
		$res = $query->result();
		
		foreach($res as $r){
			echo $r->ordine_cliente;
		}
		
		if(sizeof($res) == 0){
			$q1 = $this->db->get_where('attachments', array('id' => $aid));
			foreach($q1->result() as $r1){
				$this->db->select('projects.name, projects.ordine_cliente');
				$this->db->join('projects', 'purchases.project_id = projects.id','left');	
				$this->db->where('purchases.id', $r1->related_to_id);
				$query = $this->db->get('purchases');
				$res1 = $query->result();
				foreach($res1 as $r2){
					echo $r2->ordine_cliente;
				}	
			}			
		}
		
	}	
	
	public function print_invoice_safe()
	{
	
		logger(array('description'=>'user print invoice '.$this->uri->segment(3), 'event'=>'print invoice'));
			
		$id = $this->uri->segment(3);
		$query = $this->db->get_where('invoices', array('id' => $id));
		foreach($query->result() as $r){ $num = $r->number; }
		$num = str_replace('/','_',$num);
		
		$this->load->helper(array('dompdf', 'file'));
		// page info here, db calls, etc.     
		$html = $this->load->view('account/print/invoice',  array('id' => $id), true);
		pdf_create($html, $num);
		/*
		or
		$data = pdf_create($html, '', false);
		write_file('name', $data);
		*/
		//if you want to write it to disk and/or send it as an attachment    
	}
	
	public function print_invoice()
	{
		logger(array('description'=>'user print invoice '.$this->uri->segment(3), 'event'=>'print invoice'));
		require_once(APPPATH."helpers/dompdf/dompdf_config.inc.php");
		
		$object = $this->account_model->fetch_full($this->uri->segment(3));
		
		
		$html = $this->load->view('account/print/invoice', array('object' => $object), true);
		
		
		// echo $html;
		$dompdf = new DOMPDF();
		$dompdf->load_html(ascii_to_entities($html));
		
		$dompdf->render();
		
		$canvas = $dompdf->get_canvas();
		$dompdf->stream("invoice_".$this->uri->segment(3).".pdf", array("Attachment" => 1));
		
	}
	
	public function print_data()
	{
		$object = $this->account_model->fetch_full($this->uri->segment(3));
		echo '<html><body>';
		echo "<pre>".print_r($object)."</pre>";
		echo '</body></html>';
	}
	
	public function print_invoice_view()
	{
		$id = $this->uri->segment(3);
		$this->load->view('account/print/invoice',  array('id' => $id));
	}
	
	public function send_invoice_mail()
	{
		$query = $this->db->get_where('invoices', array('invoices.id' => $this->uri->segment(3)));
		foreach($query->result() as $r){ $invoice = $r; }
		
		$this->db->select('partners.*, partner_addresses.*');
		$this->db->join('partner_addresses','partner_addresses.partner_id = partners.id');
		$this->db->where('address_kind',5);
		$query1 = $this->db->get_where('partners', array('partners.id' => $invoice->partner_id));
		foreach($query1->result() as $r1){ $partner = $r1; }		

		$this->load->view('account/send_invoice_mail', array('invoice' => $query->result(), 'partner' => $query1->result()));
	}
	
	public function invoice_delete()
	{
		logger(array('description'=>'user try to delete an invoice', 'event'=>'Invoice deletion start'));
		
		$menu = $this->account_model->loadMenu();
		$conf = $this->account_model->loadConf();
		
		$query = $this->db->get_where('invoices', array('id' => $this->uri->segment(3)));
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('account/delete_invoice_confirm');
		$this->load->view('tmpl/closing');
		$this->load->view('tmpl/bottom');		
	}
	
	public function delete_invoices_confirm()
	{
		$id = $this->uri->segment(3);
		// delete invoice
		$this->db->delete('invoices', array('id' => $id));		
		
		// delete payments
		$this->db->delete('invoice_payments', array('invoice_id' => $id));
		
		$this->index();
	}
}