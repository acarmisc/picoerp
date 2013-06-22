<?php 
	liveForm($this->sales_model->modelData('quotationreq'), 
							array('layout' => 'horiz', 
								   'values' => $this->sales_model->getQuoteRequests(array(0 => 
																	array('key' => 'quotationreq.id', 
																			'val' => $this->uri->segment(3))))
								   )
						);
?>