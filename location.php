<?php

	class Location	{
		private $id;
		private $Event;
		private $Address;
		private $Classification;
		private $Description;
		private $Latitude;
		private $Longitude;

		private $conn;
		private $tableName = "Events";

		function setId($id) { $this->id = $id; }
		function getId() { return $this->id; }
		function setName($Event) { $this->Event = $Event; }
		function getName() { return $this->Event; }
		function setAddress($Address) { $this->Address = $Address; }
		function getAddress() { return $this->Address; }
		function setType($Classification) { $this->Classification = $Classification; }
		function getType() { return $this->Classification; }
		function setDesc($Description) { $this->Event_Description_Agenda = $Description; }
		function getDesc() { return $this->Event_Description_Agenda; }
		function setLat($Latitude) { $this->Latitude = $Latitude; }
		function getLat() { return $this->Latitude; }
		function setLng($Longitude) { $this->Longitude = $Longitude; }
		function getLng() { return $this->Longitude; }

		public function __construct() {
			require_once('db/DbConnect.php');
			$conn = new DbConnect;
			$this->conn = $conn->connect();
		}

		public function getLocsBlankLatLng() {
			$sql = "SELECT * FROM $this->tableName WHERE Latitude IS NULL AND Longitude IS NULL";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getAll() {
			$sql = "SELECT * FROM $this->tableName";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function updateLocsWithLatLng() {
			$sql = "UPDATE $this->tableName SET Latitude = :Latitude, Longitude = :Longitude WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(':Latitude', $this->Latitude);
			$stmt->bindParam(':Longitude', $this->Longitude);
			$stmt->bindParam(':id', $this->id);

			if($stmt->execute()) {
				return true;
			} else {
				return false;
			}
		}
	}

?>
