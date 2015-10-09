<?php
class ajax extends Xhr{
	
	public function __construct(){
		parent::__construct();
		try {
			$this->load->model('page_m');
			$this->template_data['page_m']=$this->page_m;			
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function order_ajax ()
	{
		try {
			if (isset($_POST['sortable'])) {
				$response=$this->page_m->save_order($_POST['sortable']);
                if(!$response['success']) throw new Exception($response['data'], 1);
                $data['success']=$response['data'];
			}
			$data['rows']=$this->page_m->read_pages_for_ordering();
			$this->load->view('page/ajax/order', $data);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}	