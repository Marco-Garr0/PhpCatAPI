<?php
include_once "GenericDAO.php";

class GenericREST{

	public ?GenericDAO $DAO = null;
	public function __construct(GenericDAO $DAO){
		$this->DAO = $DAO;
	}
	public function post(object $request): ?object{
		try{
			$ret = $this->DAO::create($request);
			if($ret == 0)
				return null;
		}catch (PDOException $e){
			return null;
		}
		return $request;
	}
	public function get(int $request): ?array{
		if($request != 0){
			$response = [];
			$result = $this->DAO::readById($request);
			if($result == null)
				return null;
			$response[] = $result;
			return $response;
		}
		else{
			$result = $this->DAO::readAll();
			return $result;
		}
	}
	public function put(object $request): bool{
		$tupleExists = $this->DAO::readById($request->getId());
		if($tupleExists == null)
			return true;
		$result = $this->DAO::update($request);
		return $result;
	}
	public function delete(object $request): bool{
		$result = $this->DAO::delete($request);
		return $result;
	}
}
?>
