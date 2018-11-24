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
    
    <header>
      <a href="/index.php"><img src="/contents/nest_logo.jpg"/></a>
    </header>
    
    <div id="indicator">
      <p align="center">
        단열계획프로그램
      </p>
    </div>
    
    <form action="envelopedesign02.php" method="POST">
      <h2>
        기본정보 입력
      </h2>
      <blockquote>
        <h3>
          용도
        </h3>
        <p>
          <input type="radio" name="building_type" value="building_type_0">공동주택<br>
          <input type="radio" name="building_type" value="building_type_1">공동주택 외
        </p>
        <br>
        
        <h3>
          건축물의 에너지절약설계기준에 의한 지역구분<sup>[1]</sup>
        </h3>
        <p>
        <?php
        $sql="SELECT e_reg FROM energysaving";
        $result=mysqli_query($conn, $sql);
        while($row=mysqli_fetch_assoc($result)){
          echo "<input type='radio' name='region_a' value='".$row['e_reg']."'>".$row['e_reg']."<br>";
        }
        ?>
        </p>
        <br>
        
        <h3>
          에너지절약형 친환경주택의 건설기준에 의한 지역구분<sup>[2]</sup>
        </h3>
        <p>
          <input type="radio" name="region_b" value="region_b_0">에너지절약형 친환경주택 건설기준 적용범위에 포함되지 않음<br>
        <?php
        $sql="SELECT h_env_reg FROM ecohouse_env";
        $result=mysqli_query($conn, $sql);
        while($row=mysqli_fetch_assoc($result)){
          echo "<input type='radio' name='region_b' value='".$row['h_env_reg']."'>".$row['h_env_reg']."<br>";
        }
        ?>
        </p>
        <br>
        
        <h3>
          단열재
        </h3>
        <p>
          <select name="mat_ins">
            <?php
            $sql="SELECT * FROM thermal_property WHERE mat_category LIKE '%보온재'";
            $result=mysqli_query($conn, $sql);
            while($row=mysqli_fetch_assoc($result)){
              echo "<option value='".$row['mat_name']."'>".$row['mat_name']."</option>";
            }
            ?>
            <option value="mat_ins_0">직접입력</option>
          </select>
        </p>
        <p>
          열전도율(W/㎡·K): <input type="float" name="ins_cus_con" value="직접입력 선택시 입력">
        </p>
        <br>
        <input type="submit">        
      </blockquote>
      
      <br>
      <hr color="gray">
      
      <p>[1] <a href="http://www.law.go.kr/행정규칙/건축물의에너지절약설계기준">건축물의 에너지절약설계기준</a>에 의한 지역구분</p>
      <blockquote>
        <ol>
          <li>중부1지역: 강원도(고성, 속초, 양양, 강릉, 동해, 삼척 제외), 경기도(연천, 포천, 가평, 남양주, 의정부, 양주, 동두천, 파주), 충청북도(제천), 경상북도(봉화, 청송)</li>
          <li>중부2지역: 서울특별시, 대전광역시, 세종특별자치시, 인천광역시, 강원도(고성, 속초, 양양, 강릉, 동해, 삼척), 경기도(연천, 포천, 가평, 남양주, 의정부, 양주, 동두천, 파주 제외), 충청북도(제천 제외), 충청남도, 경상북도(봉화, 청송, 울진, 영덕, 포항, 경주, 청도, 경산 제외), 전라북도, 경상남도(거창, 함양)</li>
          <li>남부지역: 부산광역시, 대구광역시, 울산광역시, 광주광역시, 전라남도, 경상북도(울진, 영덕, 포항, 경주, 청도, 경산), 경상남도(거창, 함양 제외)</li>
        </ol>
      </blockquote>
      
      <p>[2] <a href="http://www.law.go.kr/행정규칙/에너지절약형친환경주택의건설기준">에너지절약형 친환경주택의 건설기준</a>에 의한 지역구분</p>
      <blockquote>
        <ol>
          <li>중부1: 강원도(고성, 속초, 양양, 강릉, 동해 제외), 경기도(연천, 포천, 가평, 남양주, 의정부, 양주, 동두천, 파주, 강화), 충청북도(제천), 경상북도(봉화, 청송)</li>
          <li>중부2: 서울특별시, 대전광역시, 세종특별자치시, 인천광역시, 강원도(고성, 속초, 양양, 강릉, 동해), 경기도(연천, 포천, 가평, 남양주, 의정부, 양주, 동두천, 파주, 강화 제외), 충청북도(제천 제외), 충청남도, 경상북도(봉화, 청송, 울진, 영덕, 포항, 경주, 청도, 경산 제외), 전라북도, 경상남도(거창, 함양)</li>
          <li>남부: 부산광역시, 대구광역시, 울산광역시, 광주광역시, 전라남도, 경상북도(울진, 영덕, 포항, 경주, 청도, 경산), 경상남도(거창, 함양 제외)</li>
          <li>제주: 제주도 전역</li>
        </ol>
      </blockquote>
      
    </form>
  </body>
</html>