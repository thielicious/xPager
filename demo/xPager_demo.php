<?php
	require_once "scr/aLoad.php";
	require_once "scr/slimPDO.inc.php";
	Thielicious\utils\aLoad\aLoad::register(["class"], "scr/");
	
	use Thielicious\APIs\xPager as xPager;
	use Thielicious\APIs\NewsBlog as NewsBlog;
	
	$newsblog = new NewsBlog\NewsBlog("localhost", "root", "", "news_blog");
	$paginator = new xPager\xPager("localhost", "root", "", "news_blog");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>xPager Demo</title>
		<link rel=stylesheet href=scr/css/style.css>
		 <script src=http://localhost/projects/aLocal.js></script> 
	</head>
	<body>
		<header>
			<h2>xPager Demo v0.8<br><hr><br>
			<span style=font-size:75%>&copy; 2016 Thielicious<br>thielicious.github.io</span></h2>
			<br>
		</header>
		<main>
			<div class=newsblog>
				<div class=news>
					<div class=pagination>
						<?php
							if (isset($_POST["submit"])) {
								$newsblog->submitEntry();
							}
							
							$paginator->setControl(" |< ", " > ", " < ", " >| ");
							$paginator->setLnkStyle("pag-active", "pag-inactive");
							$paginator->setDivider("|", "|");

							$paginator->SQLRequest(xPager\xPager::RECORDS, "
								SELECT * FROM `entries`
							");

							echo "There are ".$paginator->getCount()." entries.<br><br>";

							$paginator->SQLRequest(xPager\xPager::PAGING, "
								SELECT `postdate`, `headline`, `content` 
									FROM `entries`
							");

							$paginator->paging(3, "page");
							$paginator->paginate();

							foreach ($paginator->displayRecords as $rec) {
								echo 
									"<p><div class=entry-bg>Date: ".$rec->postdate."</div>".
									"<div class=entry-bg>Headline: ".$rec->headline."</div>".
									"<div class=entry-bg>Content: ".$rec->content."</div></p>";
							}
						?>
					</div>
				</div>
				<div class=archive></div>
				<p><hr></p>
			</div>
			<div class=entry>
				<form method=POST>
					<label>Headline</label><br>
					<input type=text name=headline><br>
					<label>Content</label><br>
					<textarea name=newsentry></textarea><br>
					<input type=submit name=submit value='Add News'>
				</form>
			</div>
		</main>
	</body>
</html>