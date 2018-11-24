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
        건축물의 에너지절약설계기준 [별표1] 지역별 건축물 부위의 열관류율표(단위: W/㎡·K)
      </h2>
      <blockquote>
        <table>
          <thead>
            <tr><th rowspan="4">지역</th><th colspan="4">거실의 외벽</th><th colspan="2">최상층에 있는 거실의 반자 또는 지붕</th><th colspan="4">최하층에 있는 거실의 바닥</th><th rowspan="4">바닥난방인 층간바닥</th><th colspan="6">창 및 문</th><th colspan="2">공동주택 세대현관문</th><th rowspan="4">삭제</th></tr>
            <tr><th colspan="2">외기에 직접 면하는 경우</th><th colspan="2">외기에 간접 면하는 경우</th><th rowspan="3">외기에 직접 면하는 경우</th><th rowspan="3">외기에 간접 면하는 경우</th><th colspan="2">외기에 직접 면하는 경우</th><th colspan="2">외기에 간접 면하는 경우</th><th colspan="3">외기에 직접 면하는 경우</th><th colspan="3">외기에 간접 면하는 경우</th><th rowspan="3">외기에 직접 면하는 경우</th><th rowspan="3">외기에 간접 면하는 경우</th></tr>
            <tr><th rowspan="2">공동주택</th><th rowspan="2">공동주택 외</th><th rowspan="2">공동주택</th><th rowspan="2">공동주택 외</th><th rowspan="2">바닥난방인 경우</th><th rowspan="2">바닥난방이 아닌 경우</th><th rowspan="2">바닥난방인 경우</th><th rowspan="2">바닥난방이 아닌 경우</th><th rowspan="2">공동주택</th><th colspan="2">공동주택 외</th><th rowspan="2">공동주택</th><th colspan="2">공동주택 외</th></tr>
            <tr><th>창</th><th>문</th><th>창</th><th>문</th></tr>
          </thead>
          <tbody>
            <?php
            $sql="SELECT * FROM energysaving";
            $result=mysqli_query($conn, $sql);
            while($row=mysqli_fetch_assoc($result)){
              echo "<tr><td>".$row['e_reg']."</td><td>".$row['e_0']."</td><td>".$row['e_1']."</td><td>".$row['e_2']."</td><td>".$row['e_3']."</td><td>".$row['e_4']."</td><td>".$row['e_5']."</td><td>".$row['e_6']."</td><td>".$row['e_7']."</td><td>".$row['e_8']."</td><td>".$row['e_9']."</td><td>".$row['e_10']."</td><td>".$row['e_11']."</td><td>".$row['e_12']."</td><td>".$row['e_13']."</td><td>".$row['e_14']."</td><td>".$row['e_15']."</td><td>".$row['e_16']."</td><td>".$row['e_17']."</td><td>".$row['e_18']."</td><td><input type='radio' name='del_e_reg' value='".$row['e_reg']."'></td></tr>";
            }
            ?>
            <tr><td><input type="text" name="e_reg"></td><td><input type="float" name="e_0"></td><td><input type="float" name="e_1"></td><td><input type="float" name="e_2"></td><td><input type="float" name="e_3"></td><td><input type="float" name="e_4"></td><td><input type="float" name="e_5"></td><td><input type="float" name="e_6"></td><td><input type="float" name="e_7"></td><td><input type="float" name="e_8"></td><td><input type="float" name="e_9"></td><td><input type="float" name="e_10"></td><td><input type="float" name="e_11"></td><td><input type="float" name="e_12"></td><td><input type="float" name="e_13"></td><td><input type="float" name="e_14"></td><td><input type="float" name="e_15"></td><td><input type="float" name="e_16"></td><td><input type="float" name="e_17"></td><td><input type="float" name="e_18"></td><td></td></td></tr>
          </tbody>
        </table>
      </blockquote>
      <br>
      
      <h2>
        에너지절약형 친환경주택의 건설기준 [별표1] 친환경주택의 단열성능 기준(창, 단위: W/㎡·K)
      </h2>
      <blockquote>
        <table>
          <thead>
            <tr><th rowspan="2">지역</th><th colspan="2">창(발코니 내측 창호 포함)</th><th rowspan="2">삭제</th></tr>
            <tr><th>외기에 직접면함</th><th>외기에 간접면함</th></tr>
          </thead>
          <tbody>
            <?php
            $sql="SELECT * FROM ecohouse_win";
            $result=mysqli_query($conn, $sql);
            while($row=mysqli_fetch_assoc($result)){
              echo "<tr><td>".$row['h_win_reg']."</td><td>".$row['h_win_0']."</td><td>".$row['h_win_1']."</td><td><input type='radio' name='del_h_win_reg' value='".$row['h_win_reg']."'></td></tr>";
            }
            ?>
            <tr><td><input type="text" name="h_win_reg"></td><td><input type="float" name="h_win_0"></td><td><input type="float" name="h_win_1"></td><td></td></tr>
          </tbody>
        </table>
      </blockquote>
      <br>
  
      <h2>
        에너지절약형 친환경주택의 건설기준 [별표2] 친환경주택의 단열성능 기준(벽체 등, 단위: W/㎡·K)
      </h2>
      <blockquote>
        <table>
          <thead>
            <tr><th rowspan="2">지역</th><th colspan="2">거실의 외벽</th><th colspan="2">최상층에 있는 거실의 반자 또는 지붕</th><th colspan="2">최하층에 있는 거실의 바닥</th><th rowspan="2">바닥난방인 층간바닥</th><th rowspan="2">삭제</th></tr>
            <tr><th>외기에 직접면함</th><th>외기에 간접면함</th><th>외기에 직접면함</th><th>외기에 간접면함</th><th>외기에 직접면함</th><th>외기에 간접면함</th></tr>
          </thead>
          <tbody>
            <?php
            $sql="SELECT * FROM ecohouse_env";
            $result=mysqli_query($conn, $sql);
            while($row=mysqli_fetch_assoc($result)){
              echo "<tr><td>".$row['h_env_reg']."</td><td>".$row['h_env_0']."</td><td>".$row['h_env_1']."</td><td>".$row['h_env_2']."</td><td>".$row['h_env_3']."</td><td>".$row['h_env_4']."</td><td>".$row['h_env_5']."</td><td>".$row['h_env_6']."</td><td><input type='radio' name='del_h_env_reg' value='".$row['h_env_reg']."'></td></tr>";
            }
            ?>
            <tr><td><input type="text" name="h_env_reg"></td><td><input type="float" name="h_env_0"></td><td><input type="float" name="h_env_1"></td><td><input type="float" name="h_env_2"></td><td><input type="float" name="h_env_3"></td><td><input type="float" name="h_env_4"></td><td><input type="float" name="h_env_5"></td><td><input type="float" name="h_env_6"></td><td></td></tr>
          </tbody>
        </table>
      </blockquote>
      <br>
  
      <h2>
        에너지절약형 친환경주택의 건설기준 [별표3] 친환경주택의 단열성능 기준(세대 내 강재문, 단위: W/㎡·K)
      </h2>
      <blockquote>
        <table>
          <thead>
            <tr><th rowspan="2">지역</th><th colspan="2">세대 현관문</th><th rowspan="2">거실 내 방화문</th><th rowspan="2">삭제</th></tr>
            <tr><td>외기에 직접면함</td><td>외기에 간접면함</td></tr>
          </thead>
          <tbody>
            <?php
            $sql="SELECT * FROM ecohouse_doo";
            $result=mysqli_query($conn, $sql);
            while($row=mysqli_fetch_assoc($result)){
              echo "<tr><td>".$row['h_doo_reg']."</td><td>".$row['h_doo_0']."</td><td>".$row['h_doo_1']."</td><td>".$row['h_doo_2']."</td><td><input type='radio' name='del_h_doo_reg' value='".$row['h_doo_reg']."'></td></tr>";
            }
            ?>
            <tr><td><input type="text" name="h_doo_reg"></td><td><input type="float" name="h_doo_0"></td><td><input type="float" name="h_doo_1"></td><td><input type="float" name="h_doo_2"></td><td></td></tr>
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
  
    <input type="hidden" value="Location: /thermal_criteria.php" name="redirect_page">
    </form>
  </body>
</html>