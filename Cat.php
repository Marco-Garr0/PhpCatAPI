<?php
class Cat{
	private int $id = 0;
	private ?string $name = null;
	private ?int $age = 0;

	public function __construct($id, $name, $age){
		$this->id = $id;
		$this->name = $name;
		$this->age = $age;
      	}

	public function getId(): int{
		return $this->id;
	}

	public function getName(): ?String{
		return $this->name;
	}

	public function getAge(): ?int{
		return $this->age;
	}

	public function setId($id): void{
		$this->id = $id;
	}

	public function setName(?String $name) {
		$this->name = $name;	
	}

	public function setAge(?int $age){
		$this->age = $age;
	}

	public function __toString(): String{
		return "[cat] id:".$this->id."\nname: ".$this->name."\nage:".$this->age."\n";
	}
	public function catToHTMLTable(): void{
		echo <<<HTML
			<tr>
				<td class="text-center">$this->id</td>
				<td class="text-center">$this->name</td>
				<td class="text-center">$this->age</td>
				<td class="text-center"><a href="CatDetail.php?id=$this->id"> Detail </a></td>
			</tr>
		HTML;
	}
	public function toJson(){
		return json_encode(get_object_vars($this));
	}
	public static function jsonToCat(String $json): ?Cat{
		$decoded = json_decode($json);
		if($decoded->id === null || $decoded->name == null || $decoded->age == null)
			return null;
		return new Cat($decoded->id, $decoded->name, $decoded->age);
	}
}
?>
