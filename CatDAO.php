<?php
include_once "GenericDAO.php";
include_once "Cat.php";

class CatDAO extends GenericDAO{
	public static function create(object $object): int{
    		try{
      			$sql = "INSERT INTO cats VALUES(NULL,
                        :name, :age, :image,
                        :whereWasFound, :whereWasSeen,
                        :sex, :price, :color,
                        :weight, :breed);";
      			$statement = GenericDAO::$connection->prepare($sql);
      			$statement->execute([
        			"name" => $object->getName(), 
        			"age" => $object->getAge(),
					"image" => $object->getImage(),
					"whereWasFound" => $object->getWhereWasFound(),
					"whereWasSeen" => $object->getWhereWasSeen(),
					"sex" => $object->getSex(),
					"price" => $object->getPrice(),
					"color" => $object->getColor(),
					"weight" => $object->getWeight(),
					"breed" => $object->getBreed()
      			]);
			$object->setId(GenericDAO::$connection->lastInsertId());
      			return GenericDAO::$connection->lastInsertId();

		}
		catch(PDOException $exception){
      		$exception->getMessage();
      		return -1;
		}
	}


	public static function readById(int $id): ?object{
    		try{
			  	$sql = "SELECT * FROM cats WHERE id = ".$id.";";
		        $result = GenericDAO::$connection->query($sql);
		        $row = $result->fetch();
		        if($row == false)
			      return null;

				$sex = False;
				if ($row["sex"] == 1) {
					$sex = True;
				}
				return new Cat($row['id'], $row['name'], $row['age'],
					null, $row['whereWasFound'], $row['whereWasSeen'],
					$sex, $row['price'], $row['color'], $row['weight'], $row['breed']);

			}catch(PDOException $exception){
				$exception->getMessage();
			    return null;
		}
	}


	public static function readAll(): ?array{
		try{
			$sql = "SELECT * FROM cats;";
			$resultSet = GenericDAO::$connection->query($sql);
			$results = $resultSet->fetchAll();
			if($results == false)
				return null;

			$cats = [];
			foreach($results as $result){
				$sex = False;
				if ($result["sex"] == 1) {
					$sex = True;
				}
				$cats[] = new Cat($result['id'], $result['name'], $result['age'],
					null, $result['whereWasFound'], $result['whereWasSeen'],
					$sex, $result['price'], $result['color'], $result['weight'], $result['breed']);
			}
		}catch(PDOException $e){
			echo $e->getMessage();
			return null;
		}
		return $cats;
	}
	public static function readAllByAge(int $minAge, int $maxAge): ?array{
		try{
			$sql = "SELECT * FROM cats WHERE age>".$minAge." AND age<".$maxAge.";";
			$resultSet = GenericDAO::$connection->query($sql);
			$results = $resultSet->fetchAll();
			if($results == false)
				return null;

			$cats = [];
			foreach($results as $result)
				$sex = False;
				if ($result["sex"] == 1) {
					$sex = True;
				}
				$cats[] = new Cat($result['id'], $result['name'], $result['age'],
				null, $result['whereWasFound'], $result['whereWasSeen'],
				$sex, $result['price'], $result['color'], $result['weight'], $result['breed']);
			
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
