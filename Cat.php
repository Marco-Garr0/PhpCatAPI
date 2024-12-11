<?php
class Cat{
	private int $id = 0;
	private ?string $name = null;
	private ?string $image = null;	#TODO
	private ?int $age = 0;
	private ?string $whereWasFound = null;
	private ?string $whereWasSeen = null;
	private ?bool $sex = null;
	private ?string $price = null;
	private ?string $color = null;
	private ?int $weight = 0;
	private ?string $breed = null;


	public function __construct($id, $name, $age, $image, $whereWasFound, $whereWasSeen, $sex, $price, $color, $weight, $breed)
	{
		$this->id = $id;
		$this->name = $name;
		$this->age = $age;
		$this->image = $image;
		$this->whereWasFound = $whereWasFound;
		$this->whereWasSeen = $whereWasSeen;
		$this->sex = $sex;
		$this->price = $price;
		$this->color = $color;
		$this->weight = $weight;
		$this->breed = $breed;
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
	public function getImage(): ?String{
		return $this->image;
	}
	public function getWhereWasFound(): ?String{
		return $this->whereWasFound;
	}
	public function getWhereWasSeen(): ?String{
		return $this->whereWasSeen;
	}
	public function getSex(): ?bool{
		return $this->sex;
	}
	public function getPrice(): ?String{
		return $this->price;
	}
	public function getColor(): ?String{
		return $this->color;
	}
	public function getWeight(): ?int{
		return $this->weight;
	}
	public function getBreed(): ?String{
		return $this->breed;
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
	public function setImage(?String $image){
		$this->image = $image;
	}
	public function setWhereWasFound(?String $whereWasFound){
		$this->whereWasFound = $whereWasFound;
	}
	public function setWhereWasSeen(?String $whereWasSeen){
		$this->whereWasSeen = $whereWasSeen;
	}
	public function setSex(?bool $sex){
		return $this->sex = $sex;
	}
	public function setPrice(?String $price){
		$this->price = $price;
	}
	public function setColor(?String $color){
		$this->color = $color;
	}
	public function setWeight(?int $weight){
		$this->weight = $weight;
	}
	public function setBreed(?String $breed){
		$this->breed = $breed;
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
		if($decoded->id === null || $decoded->name == null || $decoded->age == null
			|| $decoded->image == null || $decoded->whereWasFound == null || $decoded->whereWasSeen == null ||
			$decoded->sex == null || $decoded->price == null || $decoded->color == null || $decoded->weight == null || $decoded->breed == null)
			return null;
		return new Cat($decoded->id, $decoded->name, $decoded->age,
			$decoded->image, $decoded->whereWasFound, $decoded->whereWasSeen, $decoded->sex, $decoded->price,
			$decoded->color, $decoded->weight, $decoded->breed);
	}
}
?>
