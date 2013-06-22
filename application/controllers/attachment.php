<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attachment extends CI_Controller {
	
 	public function __construct()
    {
        parent::__construct();
        $this->load->model('attachment_model');  
    }
		
	public function save_attachment()
	{
		$config['upload_path'] = './upload/';
		$config['allowed_types'] = '*'; //'gif|jpg|png|txt|pdf|doc|docx|xlsx|xls|dwg|dxf';
		$config['max_size']	= '10000';

		if($_POST['version'] != 1){$_POST['version'] = $_POST['version']+1; }

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			print_r($error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			
			$return_to = $_POST['return_to'];
			echo $return_to;
			unset($_POST['return_to']);
			
			$_POST = array_merge($_POST, array('userfile' => $data['upload_data']['file_name'],
												'creation_date' => time(),
												'creation_uid' => $this->session->userdata('id'),
												'update_date' => time()));
			if(isset($_POST['version'])){
				logger(array('description'=>'user update attachment '.$data['upload_data']['file_name'], 'event'=>'Attachment uploaded'));			
			}else{
				logger(array('description'=>'user save an attachment', 'event'=>'Attachment uploaded'));	
			}
			
			
			$this->db->insert('attachments', $_POST);
			
			redirect($return_to);
		}
	}
	
	public function download(){
		$this->load->helper('download');
		
		$query = $this->db->get_where('attachments', array('id' => $this->uri->segment(3)));
		foreach($query->result() as $row){
			$data = file_get_contents('./upload/'.$row->userfile);
			
			logger(array('description'=>'user download attachment no. '.$this->uri->segment(3).' name: '.$row->userfile, 'event'=>'attachment download'));
			
			//force_download($row->userfile,$data);
			redirect('./upload/'.$row->userfile);
		}
	}
	
	public function update(){
		$query = $this->db->get_where('attachments', array('id' => $this->uri->segment(3)));
		
		$ref = $this->input->server('HTTP_REFERER', TRUE);		
		
		foreach($query->result() as $row){
			$this->load->view('tmpl/top');
			$this->load->view('tmpl/nav');
			$this->load->view('attachments/uploader.php', array('data' => $row, 'return_to' => $ref));
			$this->load->view('tmpl/closing');		
			$this->load->view('tmpl/bottom');
			
		}
	}
	
	public function history(){
		$query = $this->db->get_where('attachments', array('id' => $this->uri->segment(3)));
		
		$ref = $this->input->server('HTTP_REFERER', TRUE);		
		
		foreach($query->result() as $row){
			$this->load->view('tmpl/top');
			$this->load->view('tmpl/nav');
			$this->load->view('attachments/history.php', array('data' => $row, 'return_to' => $ref));
			$this->load->view('tmpl/closing');		
			$this->load->view('tmpl/bottom');
			
		}
	}	
	
	public function send_file_mail()
	{
		$query = $this->db->get_where('attachments', array('id' => $this->uri->segment(3)));

		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('attachments/send_file_mail', array('attachment' => $query->result()));
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');		
	}	
	
	public function delete(){
		$this->session->set_userdata('step_back',$this->input->server('HTTP_REFERER', TRUE));
		
		$this->load->view('tmpl/top');
		$this->load->view('attachments/confirm_delete');
		$this->load->view('tmpl/closing');
		$this->load->view('tmpl/bottom');
		
	}
	
	public function delete_attachment()
	{
		$this->db->limit(1);
		$this->db->delete('attachments', array('id' => $this->uri->segment(3)));
		
		redirect($this->session->userdata('step_back'), 'location');
	}
	

}
