<?php 

class Autocomplete extends MY_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('mongo_manage','',true);
    }

	public function authors(){
		$CI =& get_instance();

		$term = trim(strip_tags($_GET['term']));

		$values = $this->mongo_manage->searchAuthors($term);

		foreach($values as $value) {
			$row['value']=$value->name;
			$row['id']=''.$value->_id;
			$row_set[]=$row;
		}
		
		echo json_encode($row_set);
		
	}

	public function publishers(){
		$CI =& get_instance();

		$term = trim(strip_tags($_GET['term']));

		$values = $this->mongo_manage->searchPublishers($term);

		foreach($values as $value) {
			$row['value']=$value->name;
			$row['id']=''.$value->_id;
			$row_set[]=$row;
		}
		
		echo json_encode($row_set);
		
	}

	public function genres(){
		$CI =& get_instance();

		$term = trim(strip_tags($_GET['term']));

		$values = $this->mongo_manage->searchGenres($term);

		foreach($values as $value) {
			$row['value']=$value->name;
			$row['id']=''.$value->_id;
			$row_set[]=$row;
		}
		
		echo json_encode($row_set);
		
	}

}

?>