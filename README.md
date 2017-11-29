# xPager
An API for pagination

<br>
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
  SELECT * FROM `TableName`
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
  echo $rec->data;
}
```

<br>

## METHODS

**xPager::__construct(string $host, string $username, string $password, string $db = NULL)** (required)<br>
Connects to the specified database.<br>
* **$host** Defines the server (e.g. localhost)<br>
* **$username** Defines the username for your database<br>
* **$password** Password for the database<br>
* **$db** (optional) In case if it's not yet defined, choose your database name<br>

<br>

**xPager::setControl(string $first, string $next, string $previous, string $last)** (optional)<br>
This method will show the content being shown to control xPager. It can be any character, image or links but usualy arrows.<br>
* **$first** Shows the first page (default: "First")<br>
* **$next** Will render the next available page (default: "Next")<br>
* **$previous** Goes to the previous page by 1 step (default: "Back")<br>
* **$last** Renders the last page (default: "Last")<br>

<br>

**xPager::setLnkStyle(string $active, string $inactive)** (required)<br>
Creates a link for each page and apply the style using classes defined in CSS.<br>
* **$active** Styles the active page number<br>
* **$inactive** Styles the other page numbers<br>

<br>

**xPager::setDivider(string $ctrl, string $pg)** (optional)<br>
This will join a separator between the controllers and page numbers.<br>
* **$ctrl** Separator for the controllers (default: "|")<br>
* **$pg** Separator for the pages (default: "|")<br>

<br>

**xPager::SQLRequest(string $sql)** (required)<br>
Look up data from a table.<br>
* **$sql** Query requests in SQL only<br>

<br>

**xPager::getCount()** (optional)<br>
Displays the total amount of data.<br>

<br>

**xPager::paging(int $limit, string $pagename = NULL)** (required)<br>
Defines the amount of data being shown on each page.<br>
* **$limit** Data limit for each page<br>
* **$pagename** (optional) Defines the page name as a key value for a GET request<br>

<br>

**xPager::paginate()** (optional)<br>
This will calculate and render the pages and the control bar using the defined settings above. This method should always be placed after all other methods explained above.<br>

<br>

## ARRAY

**xPager::displayRecords** (required)<br>
This is an array containing the SQL data for each page.<br>

<br>
<br>

:new: A **[Demo](https://github.com/thielicious/xPager/tree/master/demo)** has been added.

<br>
<br>

###### If you encounter any bugs, feel free to open up an **[issue](https://github.com/thielicious/xPager/issues)**, thank you.

---
**[thielicious.github.io](http://thielicious.github.io)**
