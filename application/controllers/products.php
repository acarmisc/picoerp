<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {
	
 	public function __construct()
    {
        parent::__construct();
        if (checkRights('sales','view','live') != true):	redirect('errors/notallowed');	endif;
        $this->load->model('crm_model');        
        $this->load->model('sales_model');     
        $this->load->model('attachment_model');                
    }
		
    public function fast_query(){
    	$field = $this->uri->segment(3);
    	$vals = $this->uri->segment(4);
    
    	$params = array(0=>array('key'=>$field,'val'=>$vals));
    	$products = $this->sales_model->searchProducts($params);
    	$this->load->view('products/browser',array('products' => $products));
    
    }
    
}

?>