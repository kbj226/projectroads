<?php
$conn=mysqli_connect('localhost', 'nesteng', 'rnqhswns226');
mysqli_select_db($conn, 'nesteng');

mysqli_query($conn, "set session character_set_connection=utf8;");
mysqli_query($conn, "set session character_set_results=utf8;");
mysqli_query($conn, "set session character_set_client=utf8;");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/style.css">
  </head>
  <body>
    <form action="process.php" method="POST">
      <h2>
        Class Id
      </h2>
      <blockquote>
        <input type="text" name="class_id">
      </blockquote>
      <h2>
        Class Name
      </h2>
      <blockquote>
        <input type="text" name="class_name">
      </blockquote>
      <h2>
        Subclass Id
      </h2>
      <blockquote>
        <input type="text" name="subclass_id">
      </blockquote>
      <h2>
        Subclass Name
      </h2>
      <blockquote>
        <input type="text" name="subclass_name">
      </blockquote>
      <h2>
        Subclass Contents
      </h2>
      <blockquote>
        <textarea name="subclass_contents"></textarea>
      </blockquote>
      <h2>
        Del Subclass Id
      </h2>
      <blockquote>
        <input type="text" name="del_subclass_id">
      </blockquote>
      <br>
      
      <blockquote>
        <p>
          passworld: <input type="password" name="password">
        </p>
        <input type="submit">
      </blockquote>
      
      <input type="hidden" value="Location: /homepage_editor.php" name="redirect_page">
    </form>
  </body>
</html>