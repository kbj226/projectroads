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
        재료별 물성치
      </h2>
      <blockquote>
        <table>
          <thead>
            <tr><th>분류</th><th>재료</th><th>열전도율(W/m·K)</th><th>열전달저항(㎡·K/W)</th><th>열관류율(W/㎡·K)</th><th>삭제</th></tr>
          </thead>
          <tbody>
            <?php
            $sql="SELECT * FROM thermal_property";
            $result=mysqli_query($conn, $sql);
            while($row=mysqli_fetch_assoc($result)){
              echo "<tr>";
              echo "<td>".$row['mat_category']."</td><td>".$row['mat_name']."</td><td>".$row['mat_conductance']."</td><td>".$row['mat_resistance']."</td><td>".$row['mat_ufactor']."</td><td><input type='radio' name='del_mat_name' value='".$row['mat_name']."'></td>";
              echo "<tr/>";
            }
            ?>
            <tr><td><input type="text" name="mat_category"></td><td><input type="text" name="mat_name"></td><td><input type="float" name="mat_conductance"></td><td><input type="float" name="mat_resistance"></td><td><input type="float" name="mat_ufactor"></td><td></td></tr>
          </tbody>
        </table>
      </blockquote>
      <br>
      
      <blockquote>
        <p>
          passworld: <input type="password" name="password">
        </p>
        <input type="submit">
      </blockquote>
      
      <input type="hidden" value="Location: /thermal_property.php" name="redirect_page">
    </form>
  </body>
</html>