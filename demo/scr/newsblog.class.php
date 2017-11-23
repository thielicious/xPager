<?php
	
	namespace Thielicious\APIs\NewsBlog;
	
	use Thielicious\utils\slimPDO;
	
	
	trait FormFields {
		
		public
			$entry = array(
				"headline" => null,
				"content" => null
			);

		public function headline() {
			if (isset($_POST["headline"])) {
				$this->entry["headline"] = $_POST["headline"];
			}
		}
		
		public function content() {
			if (isset($_POST["newsentry"])) {
				$this->entry["content"] = $_POST["newsentry"];
			}
		}
		
	}


	class NewsBlog {

		use 
			FormFields, 
			slimPDO\DB;

		const
			ERR = "Error ".__METHOD__.": ";

		function __construct(string $host, string $user, string $pass, string $db = null) {
			try {
				$this->connect($host, $db, $user, $pass);
			} catch (PDOException $e) {
				echo self::ERR.$e->getMessage()."<br>";
			}
		}

		protected function getData(string $sql) { return $sql; }

		public function submitEntry() {
			$this->headline();
			$this->content();
			try {
				$this->put(
					$this->entry["headline"], 
					$this->entry["content"]
				);
			} catch (PDOException $e) {
				echo self::ERR.$e->getMessage()."<br>";
			}
			$this->pdo = null;
		}

		private function put(string $headline, string $content) {
			$sql = $this->pdo->prepare("
				INSERT INTO entries (postdate, headline, content) 
					VALUES (  
						NOW(), :headline, :content
					);
			");
			$sql->bindParam(":headline", $this->entry["headline"]);
			$sql->bindParam(":content", $this->entry["content"]);
			if ($sql->execute()) {
				if ($sql->rowCount() == 0) {
					echo self::ERR.$sql->error."<br>";
					echo "Something went wrong.<br>";
				} else {
					echo "SUCCESS: News has been successfully submitted.<br>";
				}
			}
		}
	}

?>