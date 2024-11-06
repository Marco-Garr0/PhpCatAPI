<?php
include_once "GenericDAO.php";
include_once "Cat.php";

class CatDAO extends GenericDAO{
	
	public static function create(object $object): int{
    		try{
			GenericDAO::connect();
      			$sql = "INSERT INTO cats VALUES(NULL, :name, :age);";
      			$statement = GenericDAO::$connection->prepare($sql);
      			$statement->execute([
        			"name" => $object->getName(), 
        			"age" => $object->getAge()
      			]);
      			return GenericDAO::$connection->lastInsertId();

		}catch(PDOException $exception){
      			$exception->getMessage();
      			return -1;
    		}

    		return 1;
	}


	public static function readById(int $id): ?object{
    		try{
			GenericDAO::connect();
		      	$sql = "SELECT * FROM cats WHERE id = ".$id.";";
		        $result = GenericDAO::$connection->query($sql);
		        $row = $result->fetch();
		        if($row == false)
			      return null;
			return new Cat($row['id'], $row['name'], $row['age']);

		}catch(PDOException $exception){
		      $exception->getMessage();
		      return null;
		}
	}


	public static function readAll(): ?array{
		try{
			GenericDAO::connect();
			$sql = "SELECT * FROM cats;";
			$resultSet = GenericDAO::$connection->query($sql);
			$results = $resultSet->fetchAll();
			if($results == false)
				return null;

			$cats = [];
			foreach($results as $result){
				$cats[] = new Cat($result["id"], $result["name"], $result["age"]);
			}
		}catch(PDOException $e){
			echo $e->getMessage();
			return null;
		}
		return $cats;
	}
	public static function readAllByAge(int $minAge, int $maxAge): ?array{
		try{
			GenericDAO::connect();
			$sql = "SELECT * FROM cats WHERE age>".$minAge." AND age<".$maxAge.";";
			$resultSet = GenericDAO::$connection->query($sql);
			$results = $resultSet->fetchAll();
			if($results == false)
				return null;

			$cats = [];
			foreach($results as $result){
				$cats[] = new Cat($result["id"], $result["name"], $result["age"]);
			}
		}catch(PDOException $e){
			echo $e->getMessage();
			return null;
		}
		return $cats;
	}


	public static function update(object $object): bool{
		try{
      			GenericDAO::connect();
      			$sql = "UPDATE cats SET name = :name, age = :age WHERE id = :id;";
      			$statement = GenericDAO::$connection->prepare($sql);
			var_dump($object->getId());
      			return !$statement->execute([
				"name" => $object->getName(), 
				"age" => $object->getAge(),
				"id" => $object->getId()
			]);
    		}catch(PDOException $exception){
      			$exception->getMessage();
      			return true;
    		}
	}


	public static function delete(object $object): bool{
		
		try{
			GenericDAO::connect();
			$sql = "DELETE FROM cats WHERE id=".$object->getId().";";
			$result = GenericDAO::$connection->exec($sql);
			return $result == 0;
		}catch(PDOException $e){
			echo $e->getMessage();
			return true;
		}
	}

}
?>
