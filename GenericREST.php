<?php
include_once "GenericDAO.php";

class GenericREST{

	private ?GenericDAO $DAO = null;
	public function __construct(GenericDAO $DAO){
		$this->DAO = $DAO;
	} 
	public function post(object $request): int{
		$result = $this->DAO::create($request);
		return $result;
	}
	public function get(int $request): String{
		if($request != 0){
			$result = $this->DAO::readById($request);
			if($result == null)
				return "";
			return $result->toJson();
		}
		else{
			$result = $this->DAO::readAll();
			$list_json = [];
			foreach ($result as $item) {
				$list_json[] = $item->toJson();
			}
			$list_json = implode(",", $list_json);
			return "[".$list_json."]";
		}
	}
	public function put(object $request): bool{
		$result = $this->DAO::update($request);
		return $result;
	}
	public function delete(object $request): bool{
		$result = $this->DAO::delete($request);
		return $result;
	}
}
?>
