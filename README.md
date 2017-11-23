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

After a form has been submitted, use this boilerplate:<br>
```
try {
  $imgur->upload($_FILES["upload"]);
  $response = $imgur->data(cImgur::RETURN_OBJECT);
  echo $response->link;
} catch (Exception $e) {
  foreach ($imgur->getErrors() as $err) {
    echo $err;
  }
}
```
This example above spits out the direct URL to the uploaded image at imgur.com. You may use this as a PRG pattern or whatever you like.

<br>

## METHODS

**cImgur::__construct(string $clientID = NULL)** (required)
* (optional) defines the CLIENT-ID for authorization. If you don't have a Client-ID, then visit https://api.imgur.com/oauth2/addclient to register and copy the ID. You may leave this parameter blank and add later your ID with **cImgur::clientID(string $clientID)**.<br>
<br>

**cImgur::setUploadSize(int $size)** (required)
* defines the maximum size of images.<br>
<br>

**cImgur::setImageSize(int $width, int $height)** (optional)
* use this method to implicitly set the image's height and width. This will check if the selected image meets the requirement.<br>
<br>

**cImgur::upload(array $file)** (required)
* this will upload the file, if `$_FILES` is set.<br>
<br>

**cImgur::data(const $return_type = NULL)** (required)
* (optional) this method returns the response data encoded in JSON once the upload process to imgur.com was successful. <br>
The following return types can be used: <br>
`cImgur::RETURN_JSON` (default)<br>
`cImgur::RETURN_OBJECT` (Std Class Object)<br>
`cImgur::RETURN_ARRAY` (Associative Array)<br>

Use **print_r()** if you would like to view the whole response.<br>
<br>

**cImgur::getErrors()** (optional)
* through a try-catch block it might throw an exception when the upload has failed. You can check out the errors with this method, which returns an `Array`.<br>
<br>

**cImgur::debug()** (optional)
* if this method is in use, it will not upload the file but an array of information of the selected file will be displayed for debugging plus the data response from imgur if available.<br>


<br>
<br>

<!--:new: A **[Demo](https://jsfiddle.net/Thielicious/)** has been added.-->

<br>

###### If you encounter any bugs, feel free to open up an **[issue](https://github.com/thielicious/cImgur/issues)**, thank you.

---
**[thielicious.github.io](http://thielicious.github.io)**
