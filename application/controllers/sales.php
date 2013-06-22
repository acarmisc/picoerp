<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales extends CI_Controller {
	
 	public function __construct()
    {
        parent::__construct();
        if (checkRights('sales','view','live') != true):	redirect('errors/notallowed');	endif;
        $this->load->model('crm_model');        
        $this->load->model('sales_model');     
        $this->load->model('attachment_model');                
    }
		
	public function overview(){
		$this->index();	
	}
	
	public function index()
	{

		logger(array('description'=>'user open Sales module', 'event'=>'Sales index'));			

		$menu = $this->sales_model->loadMenu();
		$conf = $this->sales_model->loadConf();
		
		$quotations = $this->sales_model->getQuotations();
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('sales/index', array('quotations' => $quotations));
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');
	}
	
	public function show_quotation($id = null){
		if($id){
			$this->new_quote($id);
		}else{
			$this->new_quote($this->uri->segment(3));
		}
	}
	
	public function new_quote($id = null)
	{
		$menu = $this->sales_model->loadMenu();
		$conf = $this->sales_model->loadConf();		
		if(isset($id) and ($id > 0)):
			$params = array(0 => array('key'=>'quotation_id', 'val'=>$id));
			$quotation_rows	= $this->sales_model->getQuotationRows($params);
		else:
			$id = 0;
			$params = array(0 => array('key'=>'quotation_id', 'val'=>$id));
			$quotation_rows	= $this->sales_model->getQuotationRows($params);
		endif;
		$this->session->set_userdata('current_quotation',$id);

		logger(array('description'=>'user open quotation '.$id.'', 'event'=>'new_quote'));		
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('sales/new_quote', array('id'=>$id, 'quotation_rows'=>$quotation_rows));
		$this->load->view('tmpl/closing');				
		$this->load->view('tmpl/bottom');

	}
	
	public function products()
	{

		$menu = $this->sales_model->loadMenu();
		$conf = $this->sales_model->loadConf();		
		$products = $this->sales_model->getProducts();
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('sales/products', array('products'=>$products));
		$this->load->view('tmpl/closing');				
		$this->load->view('tmpl/bottom');

	}	
	
	public function save_quote()
	{
		if(!isset($_POST['id'])):
			$quote_id = $this->sales_model->createQuotation($_POST);
			logger(array('description'=>'quotation created ('.$_POST['title'].')', 'event'=>'save_quote'));
			$res = $quote_id;
		else:
			$partner_id = $this->sales_model->updateQuotation($_POST);
			logger(array('description'=>'quotation updated ('.$_POST['title'].' Ref: '.$_POST['id'].')', 'event'=>'save_quote'));			
			$res = $_POST['id'];
		endif;
		
		$this->session->set_userdata('current_quote', $res);
		
		echo $res;
	}

	public function add_quotation_row()
	{
		if($this->uri->segment(3)):
			$id = $this->uri->segment(3);
		else: 
			$id = 0;
	    endif;
	    
		$products = $this->sales_model->getProducts();
		$this->load->view('sales/products', array('products'=>$products, 'append_to' => $id));
		
	}
	
	public function add_product_to_quotation()
	{
		$qid = $this->session->userdata('current_quotation');
		$p = $this->sales_model->getProducts(array(0 => array('key'=>'id', 'val'=>$this->uri->segment(3))));
		//print_r($p);
		
		$data = array(
			'product_id' => $p[0]->id,
			'description' => $p[0]->description,
			'quotation_id' => $qid,
			'unit' => $p[0]->unit,
			'creation_date' => time(),
			'update_date' => time(),
			'creation_uid' => $this->session->userdata('id'),
			'currency' => 'euro'
		);
		$this->db->insert('quotation_rows', $data);
		logger(array('description'=>'quotation '.$qid.' updated: '.$p[0]->name.' added', 'event'=>'add_product_to_quotation'));			
		$params = array(0 => array('key'=>'quotation_id', 'val'=>$qid));
		$quotation_rows	= $this->sales_model->getQuotationRows($params);
		$this->load->view('sales/new_quote', array('id'=>$qid, 'quotation_rows'=>$quotation_rows));
	}
	
	public function quotation_row_edit()
	{
		$qr = $this->sales_model->getQuotationRows(array(0 => array('key'=>'quotation_rows.id', 
													'val'=>$this->uri->segment(3))));
													
		foreach($qr as $r):
			$this->load->view('sales/_quotation_row-edit', $r);
		endforeach;
		
	}
	
	public function quotation_row_save()
	{
		$qid = $this->session->userdata('current_quotation');
		
		$this->db->update('quotation_rows', $_POST, array('id'=>$this->uri->segment(3)));

		logger(array('description'=>'quotation '.$qid.' rows updated', 'event'=>'quotation_row_save'));			
				
		$qr = $this->sales_model->getQuotationRows(array(0 => array('key'=>'quotation_rows.id', 
													'val'=>$this->uri->segment(3))));
																
		foreach($qr as $r):
			$this->load->view('sales/_quotation_row', $r);
		endforeach;
	}
	
	public function quotation_recalculate()
	{
		$qr = $this->sales_model->getQuotations(array(0 => array('key'=>'quotations.id', 
													'val'=>$this->session->userdata('current_quotation'))));

        $qrs = $this->sales_model->getQuotationRows(array(0 => array('key'=>'quotation_id', 
													'val'=>$this->session->userdata('current_quotation'))));
													
		foreach($qr as $r):
			$currency =  $r->currency;
		endforeach;
		
		$this->load->view('sales/quote_footer', array('currency'=>$currency, 
													'id'=>$this->session->userdata('current_quotation'),
													'quotation_rows'=>sizeof($qrs)));
	}
	
	public function approve_quotation()
	{
		$qid = $this->session->userdata('current_quotation');
		$this->db->update('quotations', array('wf_step'=>'approved'), array('id'=> $qid));
		
		echo '
		   
    <li><b>Workflow</b> <span class="divider">|</span> </li>
    <li>
    draft <span class="divider"><i class="icon-chevron-right"></i></span>
    </li>
    <li>
	<span class="badge badge-info">approved</span> <span class="divider"><i class="icon-chevron-right"></i></span>
    </li>
    ';
    
    logger(array('description'=>'quotation '.$qid.' approved', 'event'=>'approve_quotation'));
    
	}
	
	public function revoke_quotation()
	{
		$qid = $this->session->userdata('current_quotation');
		$this->db->update('quotations', array('wf_step'=>'draft'), array('id'=> $qid));
		
		echo '
		   
    <li><b>Workflow</b> <span class="divider">|</span> </li>
    <li>
    <span class="badge badge-info">draft</span> <span class="divider"><i class="icon-chevron-right"></i></span>
    
    </li>
    <li>
	approved
    </li>
    ';
    
    logger(array('description'=>'quotation '.$qid.' revoked', 'event'=>'revoke_quotation'));
    
        
	}		
	
	public function importer()
	{
		$menu = $this->sales_model->loadMenu();
		$conf = $this->sales_model->loadConf();	
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('importer/importer');
		$this->load->view('tmpl/closing');				
		$this->load->view('tmpl/bottom');
	}	
	
	public function settings()
	{
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('errors/notyet');
		$this->load->view('tmpl/closing');				
		$this->load->view('tmpl/bottom');
	}
	
	public function quote_requests($flash_messages = null)
	{
		logger(array('description'=>'user open quote requests list', 'event'=>'Quote requests'));			

		$menu = $this->sales_model->loadMenu();
		$conf = $this->sales_model->loadConf();
		
		$requests = $this->sales_model->getQuoteRequests();
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('sales/quote_requests', array('requests' => $requests, 'flash_messages' => $flash_messages));
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');		
	}
	
	public function quotationreq_new($error = null)
	{
		$menu = $this->sales_model->loadMenu();
		$conf = $this->sales_model->loadConf();

		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('sales/quotationreq_new');
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');
	}

	public function quotationreq_show($error = null)
	{
		$this->load->view('sales/quotationreq_show');
	}
	
	public function quotationreq_save()
	{
		$flash_messages = array();
		$config['upload_path'] = './upload/';
		$config['allowed_types'] = 'gif|jpg|png|txt|pdf|doc|docx|xlsx';
		$config['max_size']	= '10000';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->quotationreq_new($error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$flash_messages = array_merge($flash_messages, 
											array(0 => array(
														'type' => 'success',
														'msg' => lang('data_saved')
														))
										);
			$_POST = array_merge($_POST, array('userfile' => $data['upload_data']['file_name'], 
									'userfile_type' => $data['upload_data']['file_type'],
									'userfile_size' => $data['upload_data']['file_size']));
									
			$this->sales_model->saveQuotationRequests($_POST);
			
			logger(array('description'=>'user save new quotation request', 'event'=>'Quotation Request Save'));
			
			$this->quote_requests($flash_messages);
		}
	}
	
	public function quotationreq_show_file(){
		$this->load->helper('download');
		
		$query = $this->db->get_where('quotationreq', array('id' => $this->uri->segment(3)));
		foreach($query->result() as $row){
			$data = file_get_contents('./upload/'.$row->userfile);
			
			logger(array('description'=>'user download a quotation request file', 'event'=>'quotationreq show file'));
			
			force_download($row->userfile,$data);
		}
	}
	
	public function bind_req_to_quote(){
		$quote = $this->session->userdata('current_quotation');
		$req = $this->uri->segment(3);
		
		$this->sales_model->bindReqToQuote($quote, $req);

	}
	
	public function new_product(){
		
		$this->load->view('sales/new_product');
		
	}
	
	public function edit_product(){
		$query = $this->db->get_where('products', array('id' => $this->uri->segment(3)));
		
		$this->load->view('sales/edit_product', array('product' => $query->result()));
	}
	
	public function save_product(){
		if($this->uri->segment(3)){
			$this->db->update('products', $_POST, array('id' => $this->uri->segment(3)));	
			$this->products();
		}else{
			$this->db->insert('products', $_POST);
			$flash_messages = array();
			$flash_messages = array_merge($flash_messages, 
												array(1 => array(
															'type' => 'success',
															'msg' => lang('data_saved')
															))
											);
			
			$this->load->view('sales/new_product', array('flash_messages' => $flash_messages));
		}
	}
	
	public function delete_quotation()
	{
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('sales/delete_quotation_confirm');
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');
	}

	public function delete_quotation_confirm()
	{	
		logger(array('description'=>'user delete a quotation ('.$this->uri->segment(3).')', 'event'=>'Sales delete_quotation'));	
		
		$this->db->delete('quotations', array('id' => $this->uri->segment(3)));
		$this->index();
	}		

	public function delete_product()
	{
		$this->db->update('products', array('status'=>'deleted'), array('id' => $this->uri->segment(3)));
				
	}
	
	public function ddt()
	{
		logger(array('description'=>'user open DDT page', 'event'=>'DDT index'));			

		$menu = $this->sales_model->loadMenu();
		$conf = $this->sales_model->loadConf();
		
		$ddts = $this->sales_model->getDdts();
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('sales/ddt', array('ddts' => $ddts));
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');		
	}
	
	public function new_ddt()
	{
		logger(array('description'=>'user open new DDT', 'event'=>'DDT new'));			

		$menu = $this->sales_model->loadMenu();
		$conf = $this->sales_model->loadConf();
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('sales/new_ddt');
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');				
	}

	public function print_quotation_view()
	{
		$id = $this->uri->segment(3);
		$this->load->view('sales/print/quotation',  array('id' => $id));
	}
	
	public function sal()
	{
		logger(array('description'=>'user open SAL page', 'event'=>'SAL index'));			

		$menu = $this->sales_model->loadMenu();
		$conf = $this->sales_model->loadConf();
		
		$sals = $this->sales_model->getSals();
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('sales/sal', array('sals' => $sals));
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');		
	}	
	
	public function delete_item()
	{
		$query = $this->db->get_where('quotation_rows', array('id' => $this->uri->segment(3)));
		
		$this->load->view('sales/delete_item_confirm', array('data'=>$query->result()));
	}
	
	public function delete_item_confirm()
	{
		logger(array('description'=>'user delete an item ('.$this->uri->segment(3).') from quotation', 'event'=>'Quotation delete_item'));
		$this->db->delete('quotation_rows', array('id' => $this->uri->segment(3)));
		$this->show_quotation($this->session->userdata('current_quotation'));
	}	

	public function fast_query(){
		$field = $this->uri->segment(3);
		$vals = $this->uri->segment(4);
		
		$params = array(0=>array('key'=>$field,'val'=>$vals));
		$quotations = $this->sales_model->searchQuotation($params);
		$this->load->view('sales/browser',array('quotations' => $quotations));
		
	}

	public function print_quotation_test(){
		
		require_once(APPPATH."helpers/dompdf/dompdf_config.inc.php");
		$html ='<html>
        <body>
        <p>Hello Hello</p><p style="page-break-after:always;page-break-before:always">Hello Hello 2</p><p>Hello Hello 3</p>
        </body>
        </html>';
		
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		
		$dompdf->render();
		
		$canvas = $dompdf->get_canvas();
		$font = Font_Metrics::get_font("helvetica", "bold");
		$head = $this->load->view('tmpl/printable/head','',true);
		$foot = $this->load->view('tmpl/printable/foot','',true);
		$canvas->page_text(0, 18, htmlentities($head), $font, 6, array(0,0,0));
		$canvas->page_text(0, 700, $foot, $font, 6, array(0,0,0));
		
		$dompdf->stream("my_pdf.pdf", array("Attachment" => 1));
		
	}
	
	public function print_quotation(){
		logger(array('description'=>'user try to print quotation  '.$this->uri->segment(3), 'event'=>'print_quotation'));
		
		require_once(APPPATH."helpers/dompdf/dompdf_config.inc.php");
		
		$object = $this->sales_model->fetch_full($this->uri->segment(3));
		
		$html = $this->load->view('sales/print/quotation', array('object' => $object), true);
		$dompdf = new DOMPDF();
		$dompdf->load_html(ascii_to_entities($html));
		
		$dompdf->render();
		
		$canvas = $dompdf->get_canvas();
		$dompdf->stream("my_pdf.pdf", array("Attachment" => 1));
		/*
		require_once(APPPATH."helpers/dompdf/dompdf_config.inc.php");
		
		echo header('Content-type: application/pdf');
		echo header('Content-Disposition: inline; filename=purchase_request_'.$this->uri->segment(3).'.pdf');
		echo pdf_create($html, '', false);
		*/
	}
	
	public function print_preview_quotation(){
		logger(array('description'=>'user try to print quotation  '.$this->uri->segment(3), 'event'=>'print_quotation_preview'));
		
		$object = $this->sales_model->fetch_full($this->uri->segment(3));
		
		$html = $this->load->view('sales/print/quotation', array('object' => $object), true);
		
		echo $html;
	}

	public function quote_rows_requests(){
		
		$menu = $this->sales_model->loadMenu();
		$conf = $this->sales_model->loadConf();
		
		logger(array('description'=>'user view all quotation rows'.$this->uri->segment(3), 'event'=>'quote_rows_requests'));
		$this->db->select('partners.name as customer_name, quotations.partner_id, quotation_rows.*, products.name as pname, products.description as pdescription, products.brand as pbrand, quotations.title as qtitle');
		$this->db->join('products', 'products.id = product_id','left outer');
		$this->db->join('quotations', 'quotations.id = quotation_id','left');
		$this->db->join('partners', 'partners.name = quotations.partner_id','left');
		$this->db->group_by('quotation_rows.id');
		$query = $this->db->get('quotation_rows');
		
		
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('sales/quotation_rows', array('rows' => $query->result()));
		$this->load->view('tmpl/closing');
		$this->load->view('tmpl/bottom');
	}
		
}