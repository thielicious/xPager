<?php
	
	namespace Thielicious\APIs\xPager;
	
	use 
		Thielicious\utils\slimPDO,
		PDO;
		
	
	trait CustomizexPager {

		private
			$firstPageName, $nextPageName,
			$previousPageName, $lastPageName, 
			$ctrlDivider, $pgDivider,
			$active, $inactive;

		public function setControl(string $first, string $next, string $previous, string $last) {
			$this->firstPageName = $first;
			$this->nextPageName = $next;
			$this->previousPageName = $previous;
			$this->lastPageName = $last;
		}

		public function setLnkStyle(string $active, string $inactive) {
			$this->active = $active;
			$this->inactive = $inactive;
		}

		public function setDivider(string $ctrl, string $pg) {
			$this->ctrlDivider = $ctrl;
			$this->pgDivider = $pg;
		}

		private function customize(string $custom, $default) {
			if (@$this->$custom !== null) { 
				return $this->$custom;
			} else { 
				return $default;
			}
		}
		
	}


	
	interface PublicController {
		
		public function setControl(string $first, string $next, string $previous, string $last);
		public function setLnkStyle(string $active, string $inactive);
		public function setDivider(string $ctrl, string $pg);
		
		function __construct(string $host, string $user, string $pass, string $db = null);
		public function SQLRequest(string $sql);
		public function getCount();
		public function paging(int $limit, string $pagename = null);
		public function paginate();
		
	}
	
	
	
	class xPager implements PublicController {

		use 
			CustomizeXPager, 
			slimPDO\DB;

		public
			$displayRecords;

		private 
			$sqlPaging, $limit, 
			$offset, $page, 
			$last, $pagevar, 
			$count;

		const
			ERR = "Error ".__METHOD__.": ";

		function __construct(string $host, string $user, string $pass, string $db = null) {
			try {
				$this->connect($host, $db, $user, $pass);
			} catch (PDOException $e) {
				echo self::ERR.$e->getMessage();
			}
		}

		public function SQLRequest(string $sql) {
			$this->sqlPaging = $sql;
		}

		private function count() {
			try {
				$sql = $this->pdo->prepare($this->sqlPaging);
				if ($sql->execute()) {
					$this->count = $sql->rowCount();
				} 
			} catch (PDOException $e) {
				echo self::ERR.$e->getMessage();
			}
		}

		public function getCount() { 
			$this->count();
			return $this->count; 
		}

		public function paging(int $limit, string $pagename = null) {
			$this->count();
			$this->limit = $limit;
			$this->pagevar = $pagename ? $pagename : "page";
			if (isset($_GET[$this->pagevar])) {
				$this->page = !preg_match("/\./", $_GET[$this->pagevar]) ? 
					$_GET[$this->pagevar] + 1 :
					preg_replace("/\.\d/", "", $_GET[$this->pagevar]) + 1;
				$this->offset = $this->limit * $this->page;
			} else {
				$this->page = 0;
				$this->offset = 0;
			}
			try {
				$sql = $this->pdo->qry(
					$this->sqlPaging
					." LIMIT {$this->offset}, {$this->limit}"
				);
				if ($sql->execute()) {
					$sql->setFetchMode(PDO::FETCH_OBJ);
					$this->displayRecords = $sql->fetchAll();
				} else {
					die("Could not fetch entries: ".$sql->error);	
				}
			} catch (PDOException $e) {
				echo self::ERR.$e->getMessage();
			}
		}

		public function paginate() {
			$lastPage = null;
			$pageCount = preg_replace("/\.\w+[0-9]/","", $this->count / $this->limit);
			$pageLnk = function($pg, $txt) {
				return "<a class="
					.$this->customize("inactive", "")
					." href=?".$this->pagevar."=".$pg.">".$txt."</a>";
			};
			if (strpos($this->count / $this->limit, ".") !== false) {
				$lastPage = 1;
			}
			echo "<br><a class=".$this->customize("inactive", "")
				." href=".$_SERVER["PHP_SELF"].">"
				.$this->customize("firstPageName", "First")."</a>"
				.$this->customize("ctrlDivider", "|");
			if ($this->page > 0) {
				$this->last = $this->page - 2;
				echo $pageLnk($this->last, $this->customize("previousPageName", "Back"))
					.$this->customize("ctrlDivider", "|");
				if ($lastPage == 1) { 
					if ($pageCount >= $this->page + 1) {
						echo $pageLnk($this->page, $this->customize("nextPageName", "Next"))
							.$this->customize("ctrlDivider", "|");
					}
				} else if ($lastPage == null) {
					if ($pageCount > $this->page + 1) {
						echo $pageLnk($this->page, $this->customize("nextPageName", "Next"))
							.$this->customize("ctrlDivider", "|");
					}
				}
			} else if ($this->page == 0) {
				echo $pageLnk($this->page, $this->customize("nextPageName", "Next"))
					.$this->customize("ctrlDivider", "|");
			}
			if ($lastPage == 1) {
				echo $pageLnk($pageCount - 1, $this->customize("lastPageName", "Last"));
			} else if ($lastPage == null) {
				echo $pageLnk($pageCount - 2, $this->customize("lastPageName", "Last"));
			}
			echo "<br>";
			for ($i = 0; $i <= $pageCount; $i++) {
				if ($lastPage == 1) {
					if ($pageCount >= $i) {
						if ($this->page == $i) {
							echo "<span class=".$this->customize("active", "").">".($i + 1)."</span>"
								.$this->customize("pgDivider", "|");
						} else {
							echo $pageLnk($i - 1, $i + 1)
								.$this->customize("pgDivider", "|");
						}
					}
				} else if ($lastPage == null) {
					if ($pageCount > $i) {
						if ($this->page == $i) {
							echo "<span class=".$this->customize("active", "").">".($i + 1)."</span>"
								.$this->customize("pgDivider", "|");
						} else {
							echo $pageLnk($i - 1, ($i + 1))
								.$this->customize("pgDivider", "|");
						}
					}
				}
			}
		}
	}
	
?>
