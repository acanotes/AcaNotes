# AcaNotes Discussion Forum Implementation

**Changelog:**

> v1.0 - Alex Xu
>
> 2020/02/15
>
> Initial upload of document, abstraction of discussion form implementation.

This document describes the general implementation (or more accurately, just my own notes and thoughts) of the AcaNotes Discussion Forum. Feel free to make comments and/or additions as seen fit. All future edits, revisions, and versions of this document should also be written in markdown format (I personally suggest _Typora_ for writing GitHub Flavored Markdown).

While the structure must be either edited in this document or strictly maintained, actual code in this document is incomplete, possibly incorrect, and only for organizing my own thoughts, feel free to not use it at all. All in all, the code is only for reference, and I should probably mention that it's been a good couple of years since I've used php.

---



**Table of Contents: **

[toc]

---



### Database tables: 

These tables will act as the database of the entire forum.

#### Users

- user_id INT(8)
- user_name VARCHAR(30)
- user_pass VARCHAR(255)
- user_email VARCHAR(255)
- user_date DATETIME

```sql
CREATE TABLE users (
    /* Primary key */
	user_id        INT(8) NOT NULL AUTO_INCREMENT, 
	
	/* Declared as unique key */
	user_name  	   VARCHAR(30) NOT NULL, 

	/* Character length is based on what hashing method Andrew used */
	user_pass      VARCHAR(255) NOT NULL, 

	/* If an email identifier is needed */ 
	user_email     VARCHAR(255) NOT NULL,

	/* User's date of registration */
	user_date      DATETIME NOT NULL,

	/* The user's level, used to identify roles and/or permissions */
	user_level     INT(8) NOT NULL,
    
    /* If a user level is already defined for the main site, assuming we'll be using the existing user database table, an additional entry user_forum_level should be used instead to avoid confusion. */

	UNIQUE INDEX   user_name_unique (user_name),
	PRIMARY KEY    (user_id)
) TYPE=INNODB;
```


#### Categories

- cat_id INT(8)
- cat_name VARCHAR(255)
- cat_description VARCHAR(255)

```sql
CREATE TABLE categories (
	cat_id             INT(8) NOT NULL AUTO_INCREMENT,
	cat_name           VARCHAR(255) NOT NULL,
	cat_description    VARCHAR(255) NOT NULL,
    
	UNIQUE INDEX       cat_name_unique (cat_name),
	PRIMARY KEY (cat_id)
) TYPE=INNODB;
```



#### Topics

- topic_id INT(8)
- topic_subject VARCHAR(255)
- topic_date DATETIME
- topic_cat INT(8)
- topic_by INT(8)

```sql
CREATE TABLE topics (
	topic_id        INT(8) NOT NULL AUTO_INCREMENT,
	topic_subject   VARCHAR(255) NOT NULL,
	topic_date      DATETIME NOT NULL,
    topic_cat       INT(8) NOT NULL, /* category_id the topic falls under */
	topic_by        INT(8) NOT NULL, /* user_id who created the topic */
    
	PRIMARY KEY (topic_id)
) TYPE=INNODB;
```



#### Posts

- post_id INT(8)
- post_content TEXT
- post_date DATETIME
- post_topic INT(8) 
- post_by INT(8)

```sql
CREATE TABLE posts (
	post_id         INT(8) NOT NULL AUTO_INCREMENT,
	post_content    TEXT NOT NULL,
	post_date       DATETIME NOT NULL,
	post_topic      INT(8) NOT NULL,
	post_by         INT(8) NOT NULL,
    
	PRIMARY KEY (post_id)
) TYPE=INNODB;
```



#### Foreign key relationships

~~~sql
/* Links topic_cat to cat_id
 * When a category is deleted from the database, all its topics are also deleted 
 * When a cat_id is altered, it's updated in all of its topics
 * Could add protection so categories with topics aren't deleted: 'ON DELETE RESTRICT' */
ALTER TABLE topics ADD FOREIGN KEY(topic_cat) REFERENCES categories(cat_id) ON DELETE CASCADE ON UPDATE CASCADE;

/* Links topic_by to user_id
 * Likewise, if a user_id is updated, so are all of the user's topics
 * Users cannot be deleted if they have any topics under them so topics aren't lost */
ALTER TABLE topics ADD FOREIGN KEY(topic_by) REFERENCES users(user_id) ON DELETE RESTRICT ON UPDATE CASCADE;

/* Links post_topic to topic_id */
ALTER TABLE posts ADD FOREIGN KEY(post_topic) REFERENCES topics(topic_id) ON DELETE CASCADE ON UPDATE CASCADE;

/* Links post_by to user_id */
ALTER TABLE posts ADD FOREIGN KEY(post_by) REFERENCES users(user_id) ON DELETE RESTRICT ON UPDATE CASCADE;
~~~



---



### Front-end wrappers

Each forum page will include a `header.php` at the top and a `footer.php` at the bottom. The header will include the doctype, a link to the stylesheet, and other important information. Examples of each are included below.



##### header.php

```php+HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="A short description." />
    <meta name="keywords" content="put, keywords, here" />
    <title>PHP-MySQL forum</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<h1>AcaNotes Discussion forum</h1>
    <div id="wrapper">
    <div id="menu">
        <a class="item" href="/forum/index.php">Home</a> -
        <a class="item" href="/forum/create_topic.php">Create a topic</a> -
        <a class="item" href="/forum/create_cat.php">Create a category</a>
    <!-- Note: maybe include code to hide create_cat.php link if user isn't an admin? --> 
        
<?php
<div id="userbar">
if($_SESSION['signed_in'])
{
    echo 'Welcome to the forums, ' . $_SESSION['user_name'] . '! Not you? <a href="signout.php">Sign out</a>';
}
else
{
	// STUB: redirect to sign-in/register page
} 
    </div>
        <div id="content">
```



##### footer.php

```html
</div><!-- content -->
</div><!-- wrapper -->
<div id="footer">AcaNotes Discussion Forum</div>
</body>
</html>
```



##### A basic stylesheet

```css
body {
	background-color: #4E4E4E;
	text-align: center;         /* make sure IE centers the page too */
}
 
#wrapper {
    width: 900px;
    margin: 0 auto;             /* center the page */
}
 
#content {
    background-color: #fff;
    border: 1px solid #000;
    float: left;
    font-family: Arial;
    padding: 20px 30px;
    text-align: left;
    width: 100%;                /* fill up the entire div */
}
 
#menu {
    float: left;
    border: 1px solid #000;
    border-bottom: none;        /* avoid a double border */
    clear: both;                /* clear:both makes sure the content div doesn't float next to this one but stays under it */
    width:100%;
    height:20px;
    padding: 0 30px;
    background-color: #FFF;
    text-align: left;
    font-size: 85%;
}
 
#menu a:hover {
    background-color: #009FC1;
}
 
#userbar {
    background-color: #fff;
    float: right;
    width: 250px;
}
 
#footer {
    clear: both;
}
 
/* begin table styles */
table {
    border-collapse: collapse;
    width: 100%;
}
 
table a {
    color: #000;
}
 
table a:hover {
    color:#373737;
    text-decoration: none;
}
 
th {
    background-color: #B40E1F;
    color: #F0F0F0;
}
 
td {
    padding: 5px;
}
 
/* Begin font styles */
h1, #footer {
    font-family: Arial;
    color: #F1F3F1;
}
 
h3 {margin: 0; padding: 0;}
 
/* Menu styles */
.item {
    background-color: #00728B;
    border: 1px solid #032472;
    color: #FFF;
    font-family: Arial;
    padding: 3px;
    text-decoration: none;
}
 
.leftpart {
    width: 70%;
}
 
.rightpart {
    width: 30%;
}
 
.small {
    font-size: 75%;
    color: #373737;
}
#footer {
    font-size: 65%;
    padding: 3px 0 0 0;
}
 
.topic-post {
    height: 100px;
    overflow: auto;
}
 
.post-content {
    padding: 30px;
}
 
textarea {
    width: 500px;
    height: 200px;
}
```



---



### Database connection (very important)

A `connect.php` is to be included in every page file created, this is to establish a connection to the database.

##### connect.php

```php
<?php
$server     = 'localhost';
$username   = 'username';
$password   = 'password';
$database   = 'database_name';

if(!mysql_connect($server, $username,  $password))
{
    exit('Error: could not connect to database.');
}
if(!mysql_select_db($database)
{
    exit('Error: could not select the database.');
}
?>
```



-----



### Forum home page

The forum's home page should ideally include categories and topics that can be sorted by recent popularity, date of creation, and other conditions.

For the sake of time, the optional feature of displaying _sorted_ categories/topics can be worked on in the future; for now, a simple home page will do (for the sake of implementation). A sample home page is included below.

```php
<?php
//create_cat.php
include 'connect.php';
include 'header.php';
         
echo '<tr>';
    echo '<td class="leftpart">';
        echo '<h3><a href="category.php?id=">Category name</a></h3> Category description goes here';
    echo '</td>';
    echo '<td class="rightpart">';                
            echo '<a href="topic.php?id=">Topic subject</a> at 10-10';
    echo '</td>';
echo '</tr>';
include 'footer.php';
?>
```



-----



### Forum user levels and authentication

The authentication process will be ideally completed via an API that will request data of the user's current session from the main domain. If the user's current session is as a visitor, attempts to post, reply, and sign-in should all redirect to the main domain's sign-in/register page. Logging in should then return the user to the forum site with the given session data on user info. An example is included below:

```php
<?php   
include 'connect.php';
include 'header.php';
 
echo '<h3>Sign in</h3>';
 
// Check if the user is already signed in.
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
    echo 'You are already signed in, you can <a href="signout.php">sign out</a> if you want.';
}
else
{
    // STUB: redirect to sign-in/register page
}

include 'footer.php';
?>
```



User-levels, if implemented, should be included as an extra parameter from the user's session.

-----



### Creating categories

Creating a category should be done using a page with a form that displays an empty form if the form has never been posted, or a filled form with a "success" prompt once it has. An example has been included:

##### create_cat.php

```php
<?php
include 'connect.php';
/* TODO: include a $_SERVER check here to confirm the current user is an admin, or is a role with the correct permissions */
 
if($_SERVER['REQUEST_METHOD'] != 'POST') // Check if the form has been posted
{
    // Displays the raw form
    echo '<form method='post' action=''>
        Category name: <input type='text' name='cat_name' />
        Category description: <textarea name='cat_description' /></textarea>
        <input type='submit' value='Add category' />
     </form>';
}
else
{
    // Save the posted form.
    $sql = ìINSERT INTO categories(cat_name, cat_description)
       VALUES('' . mysql_real_escape_string($_POST['cat_name']) . ì',
             '' . mysql_real_escape_string($_POST['cat_description']) . ì')';
    $result = mysql_query($sql);
    
    if(!$result) // Checks for SQL errors
    {
        // Display the error
        echo 'Error' . mysql_error();
    }
    else
    {
        echo 'New category successfully added.';
    }
}
?>
```



These categories also need to be displayed on `index.php`, which should retrieve the categories via SQL query. Perhaps would look something like this:

```php
<?php
include 'connect.php';
include 'header.php';
 
$sql = "SELECT
            cat_id,
            cat_name,
            cat_description,
        FROM
            categories";
 
$result = mysql_query($sql);
 
if(!$result)
{
    echo 'The categories could not be displayed due to an unexpected error.';
}
else
{
    if(mysql_num_rows($result) == 0)
    {
        echo 'No categories defined yet.';
    }
    else
    {
        /* A primitive table for displaying categories for development purposes, definitely should use css to make this look better. Categories are retrieved using the SQL query defined above */
        
        echo '<table border="1">
              <tr>
                <th>Category</th>
                <th>Last topic</th>
              </tr>'; 
             
        while($row = mysql_fetch_assoc($result))
        {               
            echo '<tr>';
                echo '<td class="leftpart">';
                    echo '<h3><a href="category.php?id">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
                echo '</td>';
                echo '<td class="rightpart">';
                            echo '<a href="topic.php?id=">Topic subject</a> at 10-10';
                echo '</td>';
            echo '</tr>';
        }
    }
}
 
include 'footer.php';
?>
```



-----



### Creating topics

A general structure for create_topic.php should be as seen below. It uses a similar logic as previous forms.

```php
if (signed in != true)
{
	redirect to login/signup
}
else
{
	if (form has been posted)
	{
		show raw form
	}
    else
	{
		process the submitted form
	}
}
```

I wrote out the actual code (it's an attempt), but it's somewhat messy, use sparingly for reference.

```php
<?php
include 'connect.php';
include 'header.php';
 
echo '<h2>Create a topic</h2>';
if($_SESSION['signed_in'] == false)
{
    echo 'Sorry, please <a href="/forum/signin.php">signed in</a> before creating a topic.';
}
else
{
    if($_SERVER['REQUEST_METHOD'] != 'POST') // Check if form has been posted
    {   
        // Display the raw form
        // Retrieve categories from database for dropdown menu in form
        $sql = "SELECT
                    cat_id,
                    cat_name,
                    cat_description
                FROM
                    categories";
         
        $result = mysql_query($sql);
         
        if(!$result)
        {
            // SQL query failed
            echo 'Error while selecting from database.';
        }
        else
        {
            if(mysql_num_rows($result) == 0)
            {
                // No categories exist, so a topic can't be posted
                if($_SESSION['user_level'] == 1) 
                    // or any other column name or user level assigned to admin/mods
                {
                    echo 'You have not created categories yet.';
                }
                else
                {
                    echo 'No categories exist, contact an administrator.';
                }
            }
            else
            {
         
                echo '<form method="post" action="">
                    Subject: <input type="text" name="topic_subject" />
                    Category:'; 
                 
                echo '<select name="topic_cat">';
                    while($row = mysql_fetch_assoc($result))
                    {
                        echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                    }
                echo '</select>'; 
                     
                echo 'Message: <textarea name="post_content" /></textarea>
                    <input type="submit" value="Create topic" />
                 </form>';
            }
        }
    }
    else
    {
        // Start processing the form here (begin SQL queries for inserting to database)
        $query  = "BEGIN WORK;";
        $result = mysql_query($query);
         
        if(!$result)
        {
            // SQL query failed
            echo 'An error occured while creating your topic. Please try again later.';
        }
        else
        {
            // Save the posted form
            // Insert the topic into the topics table first, then save the post into the posts table
            $sql = "INSERT INTO 
                        topics(topic_subject,
                               topic_date,
                               topic_cat,
                               topic_by)
                   VALUES('" . mysql_real_escape_string($_POST['topic_subject']) . "',
                               NOW(),
                               " . mysql_real_escape_string($_POST['topic_cat']) . ",
                               " . $_SESSION['user_id'] . "
                               )";
                      
            $result = mysql_query($sql);
            if(!$result)
            {
                // Display the error
                echo 'An error occured while inserting your data. Please try again later.' . mysql_error();
                $sql = "ROLLBACK;";
                $result = mysql_query($sql);
            }
            else
            {
                // Topic query successful, now start posts query
                // Retrieve the topic_id of the topic just created to use in the posts query
                // The content of the topic is saved as the topic's first child post
                $topicid = mysql_insert_id();
                 
                $sql = "INSERT INTO
                            posts(post_content,
                                  post_date,
                                  post_topic,
                                  post_by)
                        VALUES
                            ('" . mysql_real_escape_string($_POST['post_content']) . "',
                                  NOW(),
                                  " . $topicid . ",
                                  " . $_SESSION['user_id'] . "
                            )";
                $result = mysql_query($sql);
                 
                if(!$result)
                {
                    // Display the error
                    echo 'An error occured while inserting your post. Please try again later.' . mysql_error();
                    $sql = "ROLLBACK;";
                    $result = mysql_query($sql);
                }
                else
                {
                    $sql = "COMMIT;";
                    $result = mysql_query($sql);
                     
                    // All SQL queries have succeeded
                    echo 'You have successfully created <a href="topic.php?id='. $topicid . '">your new topic</a>.';
                }
            }
        }
    }
}
 
include 'footer.php';
?>
```



-----



### Category view

Instead of using a deployment API to automatically create pages for every category, a more elegant solution would be to have a "template" page that fills the blanks with information retrieved from the database.

```php
<?php
include 'connect.php';
include 'header.php';
 
// Select the category based on $_GET['cat_id']
$sql = "SELECT
            cat_id,
            cat_name,
            cat_description
        FROM
            categories
        WHERE
            cat_id = " . mysql_real_escape_string($_GET['id']);
 
$result = mysql_query($sql);
 
if(!$result)
{
    echo 'The category could not be displayed, please try again later.' . mysql_error();
}
else
{
    if(mysql_num_rows($result) == 0)
    {
        echo 'This category does not exist.';
    }
    else
    {
        // Display topics in category from get method
        while($row = mysql_fetch_assoc($result))
        {
            echo '<h2>Topics in ′' . $row['cat_name'] . '′ category</h2>';
        }
     
        // Query the topics
        $sql = "SELECT  
                    topic_id,
                    topic_subject,
                    topic_date,
                    topic_cat
                FROM
                    topics
                WHERE
                    topic_cat = " . mysql_real_escape_string($_GET['id']);
         
        $result = mysql_query($sql);
         
        if(!$result)
        {
            echo 'The topics could not be displayed, please try again later.';
        }
        else
        {
            if(mysql_num_rows($result) == 0)
            {
                echo 'There are no topics in this category yet.';
            }
            else
            {
                // A table that shows topics. Again, needs to be stylized in deployment
                echo '<table border="1">
                      <tr>
                        <th>Topic</th>
                        <th>Created at</th>
                      </tr>'; 
                     
                while($row = mysql_fetch_assoc($result))
                {               
                    echo '<tr>';
                        echo '<td class="leftpart">';
                            echo '<h3><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><h3>';
                        echo '</td>';
                        echo '<td class="rightpart">';
                            echo date('d-m-Y', strtotime($row['topic_date']));
                        echo '</td>';
                    echo '</tr>';
                }
            }
        }
    }
}
 
include 'footer.php';
?>
```



-----



### Topic view

Similar to categories, topics also need a page to display all their contents. The php code from [category view](###Category view) is similar to what is employed in this page, so I'll be focusing on the details on SQL queries in this section.

Retrieving basic topic information:

```sql
SELECT
    topic_id,
    topic_subject
FROM
    topics
WHERE
    topics.topic_id = " . mysql_real_escape_string($_GET['id'])
```

Retrieving all the posts (and their information) under said topic:

```sql
SELECT
    posts.post_topic,
    posts.post_content,
    posts.post_date,
    posts.post_by,
    users.user_id,
    users.user_name
FROM
    posts
LEFT JOIN /* so we can show the username of who posted */
    users
ON
    posts.post_by = users.user_id
WHERE
    posts.post_topic = " . mysql_real_escape_string($_GET['id'])
```



----



### Replying to topics (adding posts to topics)

A similar logic to posting topics is used here, where a form is submitted with the user's input, then the contents are uploaded to the database. The reply will be shown when its topic page is accessed.

```php
<?php
include 'connect.php';
include 'header.php';
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    echo 'This file cannot be called directly.';
}
else
{
    // Check sign-in status
    if(!$_SESSION['signed_in'])
    {
        echo 'You must be signed in to post a reply.';
    }
    else
    {
        $sql = "INSERT INTO 
                    posts(post_content,
                          post_date,
                          post_topic,
                          post_by) 
                VALUES ('" . $_POST['reply-content'] . "',
                        NOW(),
                        " . mysql_real_escape_string($_GET['id']) . ",
                        " . $_SESSION['user_id'] . ")";
                         
        $result = mysql_query($sql);
                         
        if(!$result)
        {
            echo 'Your reply failed to post, please try again later.';
        }
        else
        {
            echo 'Your reply has been posted, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.';
        }
    }
}
 
include 'footer.php';
?>
```

The replying form, ideally, should be on the same page as the topic itself. Also, if possible, the user should be automatically shown a refreshed version of the topic page with the new reply shown and a text prompt telling the user their reply was successful.



----



[Back to top](#AcaNotes Discussion Forum Implementation)
