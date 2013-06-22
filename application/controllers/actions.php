<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actions extends CI_Controller {
	
 	public function __construct()
    {
        parent::__construct();
		$this->load->library('email');
    }
		
	public function send_mail_to_group()
	{
		$query = $this->db->get_where('workflows_actions', array('action'=>'send_mail_to_group'));
		$res = $query->result();
		
		// fetching users in group
		$this->db->select('email');
		$this->db->join('users', 'users_groups.uid = users.id');
		$query = $this->db->get_where('users_groups', array('gid'=>$res[0]->params));
		$addrs = $query->result();
	
		$this->send_mail_to(array('to'=>$addrs));		
	}

	public function send_mail_to_user()
	{
		$query = $this->db->get_where('workflows_actions', array('action'=>'send_mail_to_user'));
		$res = $query->result();
		
		$this->db->select('email');
		$query = $this->db->get_where('users', array('id'=>$res[0]->params));
		$addrs = $query->result();
	
		$this->send_mail_to(array('to'=>$addrs));
	}


	public function send_mail_to($params = null)
	{
		
		foreach($params['addrs'] as $a):
			$this->email->from('noreply@system.local', 'Your management system');
			$this->email->to($a); 
			
			$this->email->subject('[QuickERP] Notification from Workflow engine');
			$this->email->message('Not a real message...');	
			
			$res = $this->email->send();
		endforeach;
		
		return $res;
	}
	
	public function fastUpdateWf()
	{
		$table = $this->uri->segment(3);
		$new = 	$this->uri->segment(4);
		$id = $this->uri->segment(5);
		
		$this->db->update($table, array('wf_step' => $new), array('id'=>$id));
		if($table == 'purchases' and $new == 'sent'):
			// update single items
			$query = $this->db->get_where('purchase_rows', array('purchase_id'=>$id));
			foreach($query->result() as $r){
				$this->db->update('project_items', array('wf_step' => 'ordered'), array('id'=>$r->project_item_id));
				echo $this->db->last_query();
			}
		endif;

		if($table == 'purchases' and $new == 'approved'):
			$this->db->limit(1);
			$this->db->update($table, array('approved_by' => $this->session->userdata('id')), array('id'=>$id));
		endif;
		
		// echo $this->db->last_query();
		//echo '<span class="label label-info">done.</span>';
	}
	
	public function send_invoice()
	{
		logger(array('description'=>'user sent invoice by mail to  '.$_POST['to'], 'event'=>'sent invoice'));
				
		$id = $this->uri->segment(3);
		$this->email->from('noreply@none.com', 'Your management system');
		$this->email->to($_POST['to']); 
			
		$this->email->subject($_POST['subject']);
		$this->email->message($_POST['msg']);	
			
		$this->email->send();
		echo $this->email->print_debugger();
/*
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('errors/mailsent',array('id'=>$id));
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');
*/

		
	}
	
	public function send_file()
	{
		logger(array('description'=>'user sent file by mail to  '.$_POST['to'], 'event'=>'sent invoice'));
				
		$id = $this->uri->segment(3);
		$this->email->from('noreply@none.com', 'Your management system');
		$this->email->to($_POST['to']); 
			
		$this->email->subject($_POST['subject']);
		$this->email->message($_POST['msg']);	
			
		$this->email->send();
		echo $this->email->print_debugger();
/*
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('errors/mailsent',array('id'=>$id));
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');
*/

		
	}	
	
	public function get_invoice()
	{
		$invoice = $this->uri->segment(3);
		$query = $this->db->get_where('invoices', array('md5(id)' => $invoice));
		foreach($query->result() as $r){
			redirect('account/print_invoice/'.$r->id);
		}
	}
	
	public function get_file()
	{
		// 		http://www.graphite.eu/heh/actions/get_file/c20ad4d76fe97759aa27a0c99bff6710
		
		$this->load->helper('download');
		
		$query = $this->db->get_where('attachments', array('md5(id)' => $this->uri->segment(3)));
		foreach($query->result() as $row){
			$data = file_get_contents('./upload/'.$row->userfile);
			
			logger(array('description'=>'external user download attachment no. '.$this->uri->segment(3).' name: '.$row->userfile, 'event'=>'attachment download'));
			
			force_download($row->userfile,$data);
		}		
		
	}
	
	public function fast_update()
	{
		$this->db->update($this->uri->segment(3), $_POST, array('id' => $thi->uri->segment(4)));	
	}

}
