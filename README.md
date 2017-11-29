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

**xPager::__construct(string $host, string $username, string $password, string $db = NULL)**
Connects to the specified database.<br>
* $host defines the server (e.g. localhost)<br>
* $username defines the username for your database<br>
* $password password for the database<br>
* $db in case if it's not yet defined, choose your database name<br>

<br>

**xPager::setControl(string $first, string $next, string $previous, string $last)**
This method will show the content being shown to control xPager. It can be any character, image or links.<br>
* $first Shows the first page<br>
* $next Will render the next available page<br>
* $previous Goes to the previous page by 1 step<br>
* $last Renders the last page<br>

<br>

**xPager::setLnkStyle(string $active, string $inactive)** (optional)
Styles the links using classes defined in CSS.<br>
* $active Styles the active page number<br>
* $inactive Styles the other page numbers<br>

<br>

**xPager::setDivider(string $ctrl, string $pg)** (optional)
This will join a separator between the controllers and page numbers.<br>
* $ctrl Separator for the controllers<br>
* $pg Separator for the pages<br>

<br>

**xPager::SQLRequest(string $sql)** (optional)
Look up data from a table.<br>
* $sql Query requests in SQL only<br>


<br>
<br>

<!--:new: A **[Demo](https://jsfiddle.net/Thielicious/)** has been added.-->

<br>

###### If you encounter any bugs, feel free to open up an **[issue](https://github.com/thielicious/cImgur/issues)**, thank you.

---
**[thielicious.github.io](http://thielicious.github.io)**
