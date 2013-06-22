<?= $this->load->view('attachments/quicklist', array('scope'=> 5,
											'related_to' => 'projects',
											'related_to_id' => $this->uri->segment(3))); ?>a