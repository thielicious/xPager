# xPager
##### API for pagination
---

<br>

## INTRODUCTION

**xPager** is an API to paginate data which is fully optimizable.

<br>

## SETUP INFORMATION

Use your CLI and enter the following to clone:<br>
`git clone https://github.com/thielicious/xPager.git`

<br>

## USAGE

Get the namespace:
```
use Thielicious\APIs\xPager as xPager;
```

Create an object:
```
$paginator = new xPager\xPager("localhost", "root", "", "news_blog");
```

Set your controller style:<br>
```
$paginator->setControl(" |< ", " > ", " < ", " >| ");
$paginator->setLnkStyle("active", "inactive");
$paginator->setDivider("|", "|");
```

Fetch records from a database:<br>
```
$paginator->SQLRequest("
  SELECT `postdate`, `headline`, `content` 
    FROM `entries`
");
```

Set the page count:<br>
```
$paginator->paging(3, "page");
$paginator->paginate();
```

Display the records:<br>
```
foreach ($paginator->displayRecords as $rec) {
  echo 
    "<p><div class=entry-bg>Date: ".$rec->postdate."</div>".
    "<div class=entry-bg>Headline: ".$rec->headline."</div>".
    "<div class=entry-bg>Content: ".$rec->content."</div></p>";
}
```

The database is just an example.

<br>

## METHODS

**xPager::__construct(string $host, string $user, string $pass, string $db = NULL)**
* Connects to the specified database.<br>
<br>

**xPager::setControl(string $first, string $next, string $previous, string $last)**
* text.<br>
<br>



<br>
<br>

<!--:new: A **[Demo](https://jsfiddle.net/Thielicious/)** has been added.-->

<br>

###### If you encounter any bugs, feel free to open up an **[issue](https://github.com/thielicious/cImgur/issues)**, thank you.

---
**[thielicious.github.io](http://thielicious.github.io)**
