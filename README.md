# xPager
###### API for pagination

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
Style your control bar: (optional)<br>
```
$paginator->setControl(" |< ", " > ", " < ", " >| ");
$paginator->setLnkStyle("active", "inactive");
$paginator->setDivider("|", "|");
```

Fetch records from a database table:<br>
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

Display the records: (example)<br>
```
foreach ($paginator->displayRecords as $rec) {
  echo 
    "<p>Date: {$rec->postdate}
    Headline: {$rec->headline}
    Content: {$rec->content}</p>";
}
```

<br>

## METHODS

**xPager::__construct(string $host, string $username, string $password, string $db = NULL)**<br>
Connects to the specified database.<br>
* **$host** Defines the server (e.g. localhost)<br>
* **$username** Defines the username for your database<br>
* **$password** Password for the database<br>
* **$db** (optional) In case if it's not yet defined, choose your database name<br>

<br>

**xPager::setControl(string $first, string $next, string $previous, string $last)**<br>
This method will show the content being shown to control xPager. It can be any character, image or links.<br>
* **$first** Shows the first page<br>
* **$next** Will render the next available page<br>
* **$previous** Goes to the previous page by 1 step<br>
* **$last** Renders the last page<br>

<br>

**xPager::setLnkStyle(string $active, string $inactive)** (optional)<br>
Styles the links using classes defined in CSS.<br>
* **$active** Styles the active page number<br>
* **$inactive** Styles the other page numbers<br>

<br>

**xPager::setDivider(string $ctrl, string $pg)** (optional)<br>
This will join a separator between the controllers and page numbers.<br>
* **$ctrl** Separator for the controllers<br>
* **$pg** Separator for the pages<br>

<br>

**xPager::SQLRequest(string $sql)** (optional)<br>
Look up data from a table.<br>
* **$sql** Query requests in SQL only<br>

<br>

**xPager::getCount()** (optional)<br>
Displays the total amount of data.<br>

<br>

**xPager::paging(int $limit, string $pagename = NULL)**<br>
Defines the amount of data being shown on each page.<br>
* **$limit** Data limit for each page<br>
* **$pagename** (optional) Defines the page name as a key value for a GET request<br>

<br>

**xPager::paging(int $limit, string $pagename = NULL)**<br>
Defines the amount of data being shown on each page.<br>
* **$limit** Data limit for each page<br>
* **$pagename** (optional) Defines the page name as a key value for a GET request<br>

<br>

**xPager::paginate()**<br>
This will calculate and render the pages and the control bar.<br>

<br>

## ARRAY

**xPager::displayRecords**<br>
This is an array containing the SQL data for each page.<br>

<br>
<br>

:new: A **[Demo](https://github.com/thielicious/xPager/tree/master/demo)** has been added.

<br>

###### If you encounter any bugs, feel free to open up an **[issue](https://github.com/thielicious/xPager/issues)**, thank you.

---
**[thielicious.github.io](http://thielicious.github.io)**
