<?php
abstract class GenericDAO{
	protected static ?PDO $connection = null;
	private static string $DB_URL = "sqlite:cat.db";
	public static function connect(){
		if(GenericDAO::$connection == null){
			try {
				GenericDAO::$connection = new PDO(GenericDAO::$DB_URL);
				GenericDAO::$connection->setAttribute(
					PDO::ATTR_ERRMODE,
					PDO::ERRMODE_EXCEPTION
				);
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
	public static function disconnect(){
		GenericDAO::$connection = null;
	}

	public abstract static function create(object $object): int;
	public abstract static function readById(int $id): ?object;
	public abstract static function readAll(): ?array;
	public abstract static function update(object $object): bool;
	public abstract static function delete(object $object): bool;
}
?>
