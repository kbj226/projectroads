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
    
    <?php
    /*건축물의 에너지절약설계기준*/
    $sql="SELECT * FROM energysaving WHERE e_reg='".$_POST['region_a']."'";
    $result=mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)){
      $ed_e[0]=$row['e_0'];
      $ed_e[1]=$row['e_1'];
      $ed_e[2]=$row['e_2'];
      $ed_e[3]=$row['e_3'];
      $ed_e[4]=$row['e_4'];
      $ed_e[5]=$row['e_5'];
      $ed_e[6]=$row['e_6'];
      $ed_e[7]=$row['e_7'];
      $ed_e[8]=$row['e_8'];
      $ed_e[9]=$row['e_9'];
      $ed_e[10]=$row['e_10'];
      $ed_e[11]=$row['e_11'];
      $ed_e[12]=$row['e_12'];
      $ed_e[13]=$row['e_13'];
      $ed_e[14]=$row['e_14'];
      $ed_e[15]=$row['e_15'];
      $ed_e[16]=$row['e_16'];
      $ed_e[17]=$row['e_17'];
      $ed_e[18]=$row['e_18'];
    }
    
    /*에너지절약형 친환경주택의 건설기준*/
    if(($_POST['building_type']==="building_type_0")and($_POST['region_b']!="region_b_0")){
      /*에너지절약형 친환경주택의 건설기준-창*/
      $sql="SELECT * FROM ecohouse_win WHERE h_win_reg='".$_POST['region_b']."'";
      $result=mysqli_query($conn, $sql);
      while($row=mysqli_fetch_assoc($result)){
        $ed_h[7]=$row['h_win_0'];
        $ed_h[8]=$row['h_win_1'];
      }
      
      /*에너지절약형 친환경주택의 건설기준-벽체 등*/
      $sql="SELECT * FROM ecohouse_env WHERE h_env_reg='".$_POST['region_b']."'";
      $result=mysqli_query($conn, $sql);
      while($row=mysqli_fetch_assoc($result)){
        $ed_h[0]=$row['h_env_0'];
        $ed_h[1]=$row['h_env_1'];
        $ed_h[2]=$row['h_env_2'];
        $ed_h[3]=$row['h_env_3'];
        $ed_h[4]=$row['h_env_4'];
        $ed_h[5]=$row['h_env_5'];
        $ed_h[6]=$row['h_env_6'];
      }
      
      /*에너지절약형 친환경주택의 건설기준-세대 내 강재문*/
      $sql="SELECT * FROM ecohouse_doo WHERE h_doo_reg='".$_POST['region_b']."'";
      $result=mysqli_query($conn, $sql);
      while($row=mysqli_fetch_assoc($result)){
        $ed_h[9]=$row['h_doo_0'];
        $ed_h[10]=$row['h_doo_1'];
        $ed_h[11]=$row['h_doo_2'];
      }
    }
    else{
      for($i=0; $i<=11; $i++){
        $ed_h[$i]=false;
      }
    }
    
    /*function_열관류율 기준 결정하기(둘 중 더 작은 숫자 선택*/
    function smallerone($a, $b){
      if($b===false){
        return ($a);
      }
      else if($a===false){
        return ($b);
      }
      else if($a>=$b){
        return ($b);
      }
      else{
        return ($a);
      }
    }
    
    if($_POST["building_type"]==="building_type_0"){
      $ed_cr[0]=smallerone($ed_e[0], $ed_h[0]);/*거실의 외벽-외기에 직접면함*/
      $ed_cr[1]=smallerone($ed_e[2], $ed_h[1]);/*거실의 외벽-외기에 간접면함*/
      $ed_cr[12]=smallerone($ed_e[11], $ed_h[7]);/*창-외기에 직접 면하는 경우*/
      $ed_cr[13]=smallerone($ed_e[17], $ed_h[9]);/*문-외기에 직접 면하는 경우*/
      $ed_cr[14]=smallerone($ed_e[14], $ed_h[8]);/*창-외기에 간접 면하는 경우*/
      $ed_cr[15]=smallerone($ed_e[18], $ed_h[10]);/*문-외기에 간접 면하는 경우*/
      $ed_cr[16]=$ed_h[11];/*거실 내 방화문*/
    }
    else if($_POST["building_type"]==="building_type_1"){
      $ed_cr[0]=$ed_e[1];/*거실의 외벽-외기에 직접면함*/
      $ed_cr[1]=$ed_e[3];/*거실의 외벽-외기에 간접면함*/
      $ed_cr[12]=$ed_e[12];/*창-외기에 직접 면하는 경우*/
      $ed_cr[13]=$ed_e[13];/*문-외기에 직접 면하는 경우*/
      $ed_cr[14]=$ed_e[15];/*창-외기에 간접 면하는 경우*/
      $ed_cr[15]=$ed_e[16];/*문-외기에 간접 면하는 경우*/
      $ed_cr[16]=false;/*거실 내 방화문*/
    }
    $ed_cr[2]=smallerone($ed_e[4], $ed_h[2]);/*최상층에 있는 거실의 반자 또는 지붕-외기에 직접면함*/
    $ed_cr[3]=smallerone($ed_e[5], $ed_h[3]);/*최상층에 있는 거실의 반자 또는 지붕-외기에 간접면함*/
    $ed_cr[4]=smallerone($ed_e[6], $ed_h[4]);/*최하층에 있는 거실의 바닥-외기에 직접면함-바닥난방인 경우*/
    $ed_cr[6]=smallerone($ed_e[7], $ed_h[4]);/*최하층에 있는 거실의 바닥-외기에 직접면함-바닥난방이 아닌 경우*/
    $ed_cr[7]=smallerone($ed_e[8], $ed_h[5]);/*최하층에 있는 거실의 바닥-외기에 간접면함-바닥난방인 경우*/
    $ed_cr[9]=smallerone($ed_e[9], $ed_h[5]);/*최하층에 있는 거실의 바닥-외기에 간접면함-바닥난방이 아닌 경우*/
    $ed_cr[10]=smallerone($ed_e[10], $ed_h[6]);/*바닥난방인 층간바닥*/
    
    /*표면열전달저항 결정하기*/
    $sql="SELECT * FROM thermal_property WHERE mat_category='실내표면열전달저항' AND mat_name='거실의 외벽'";
    $result=mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)){
      $ed_ri[0]=$row['mat_resistance'];
      $ed_ri[1]=$row['mat_resistance'];
    }
    $sql="SELECT * FROM thermal_property WHERE mat_category='실내표면열전달저항' AND mat_name='최하층에 있는 거실 바닥'";
    $result=mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)){
      $ed_ri[4]=$row['mat_resistance'];
      $ed_ri[6]=$row['mat_resistance'];
      $ed_ri[7]=$row['mat_resistance'];
      $ed_ri[9]=$row['mat_resistance'];
    }
    $sql="SELECT * FROM thermal_property WHERE mat_category='실내표면열전달저항' AND mat_name='최상층에 있는 거실의 반자 또는 지붕'";
    $result=mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)){
      $ed_ri[2]=$row['mat_resistance'];
      $ed_ri[3]=$row['mat_resistance'];
    }
    $sql="SELECT * FROM thermal_property WHERE mat_category='실내표면열전달저항' AND mat_name='공동주택의 층간 바닥'";
    $result=mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)){
      $ed_ri[10]=$row['mat_resistance'];
      $ed_ro[10]=$row['mat_resistance'];
    }
    $sql="SELECT * FROM thermal_property WHERE mat_category='실외표면열전달저항' AND mat_name='거실의 외벽/외기에 간접 면하는 경우'";
    $result=mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)){
      $ed_ro[1]=$row['mat_resistance'];
    }
    $sql="SELECT * FROM thermal_property WHERE mat_category='실외표면열전달저항' AND mat_name='거실의 외벽/외기에 직접 면하는 경우'";
    $result=mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)){
      $ed_ro[0]=$row['mat_resistance'];
    }
    $sql="SELECT * FROM thermal_property WHERE mat_category='실외표면열전달저항' AND mat_name='최하층에 있는 거실 바닥/외기에 간접 면하는 경우'";
    $result=mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)){
      $ed_ro[7]=$row['mat_resistance'];
      $ed_ro[9]=$row['mat_resistance'];
    }
    $sql="SELECT * FROM thermal_property WHERE mat_category='실외표면열전달저항' AND mat_name='최하층에 있는 거실 바닥/외기에 직접 면하는 경우'";
    $result=mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)){
      $ed_ro[4]=$row['mat_resistance'];
      $ed_ro[6]=$row['mat_resistance'];
    }
    $sql="SELECT * FROM thermal_property WHERE mat_category='실외표면열전달저항' AND mat_name='최상층에 있는 거실의 반자 또는 지붕/외기에 간접 면하는 경우'";
    $result=mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)){
      $ed_ro[3]=$row['mat_resistance'];
    }
    $sql="SELECT * FROM thermal_property WHERE mat_category='실외표면열전달저항' AND mat_name='최상층에 있는 거실의 반자 또는 지붕/외기에 직접 면하는 경우'";
    $result=mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)){
      $ed_ro[2]=$row['mat_resistance'];
    }
    
    /*단열재 열관류율 결정하기*/
    if($_POST["mat_ins"]==="mat_ins_0"){
      $ed_con=$_POST["ins_cus_con"];
    }
    else{
      $sql="SELECT * FROM thermal_property WHERE mat_name='".$_POST['mat_ins']."'";
      $result=mysqli_query($conn, $sql);
      while($row=mysqli_fetch_assoc($result)){
        $ed_con=$row['mat_conductance'];
      }
    }
    
    /*function_설정된 열관류율에 따른 단열재 두께 구하기*/
    function thkofins($ri, $ro, $con, $cri){
      if($cri!=0){
        return round((($con/$cri-$con*($ri+$ro))*1000), 3);
      }
      else{
        return false;
      }
    }
    
    for($i=0; $i<=10; $i++){
      $ed_ins[$i]=thkofins($ed_ri[$i], $ed_ro[$i], $ed_con, $ed_cr[$i]);
      if(($i===4)or($i===7)){
        $i++;
      }
    }
    
    $ed_ins[5]=round((0.7*$ed_con/$ed_e[6])*1000, 3);
    $ed_ins[8]=round((0.7*$ed_con/$ed_e[8])*1000, 3);
    $ed_ins[11]=round((0.6*$ed_con/$ed_e[10])*1000, 3);
    ?>
    
    <!--PHP변수를 JavaScript로 전달-->
    <script>
      var ed_ri=<?=json_encode($ed_ri)?>;
      var ed_ro=<?=json_encode($ed_ro)?>;
      var ed_cr=<?=json_encode($ed_cr)?>;
      var ed_ins=<?=json_encode($ed_ins)?>;
    </script>
    
    <h2>
        검토결과
    </h2>
    <blockquote>
      <table>
        <thead>
          <tr><th colspan='4'>구분</th><th>열관류율<br>(W/㎡·K, 법적기준)</th><th>단열재 최소두께<br>(mm, 법적기준)</th></tr>
        </thead>
        <tbody>
            <script>
              document.write("<tr><td rowspan='2'>거실의 외벽</td><td colspan='3'>외기에 직접면함</td><td>"+ed_cr[0]+"</td><td>"+ed_ins[0]+"</td></tr>");
              document.write("<tr><td colspan='3'>외기에 간접면함</td><td>"+ed_cr[1]+"</td><td>"+ed_ins[1]+"</td></tr>");
              document.write("<tr><td rowspan='2'>최상층에 있는 거실의 반자 또는 지붕</td><td colspan='3'>외기에 직접면함</td><td>"+ed_cr[2]+"</td><td>"+ed_ins[2]+"</td></tr>");
              document.write("<tr><td colspan='3'>외기에 간접면함</td><td>"+ed_cr[3]+"</td><td>"+ed_ins[3]+"</td></tr>");
              document.write("<tr><td rowspan='6'>최하층에 있는 거실의 바닥</td><td rowspan='3'>외기에 직접면함</td><td rowspan='2'>바닥난방인 경우</td><td>전체</td><td>"+ed_cr[4]+"</td><td>"+ed_ins[4]+"</td></tr>");
              document.write("<tr><td>슬래브 상단</td><td>-</td><td>"+ed_ins[5]+"</td></tr>");
              document.write("<tr><td colspan='2'>바닥난방이 아닌 경우</td><td>"+ed_cr[6]+"</td><td>"+ed_ins[6]+"</td></tr>");
              document.write("<tr><td rowspan='3'>외기에 간접면함</td><td rowspan='2'>바닥난방인 경우</td><td>전체</td><td>"+ed_cr[7]+"</td><td>"+ed_ins[7]+"</td></tr>");
              document.write("<tr><td>슬래브 상단</td><td>-</td><td>"+ed_ins[8]+"</td></tr>");
              document.write("<tr><td colspan='2'>바닥난방이 아닌 경우</td><td>"+ed_cr[9]+"</td><td>"+ed_ins[9]+"</td></tr>");
              document.write("<tr><td rowspan='2'>바닥난방인 층간바닥</td><td colspan='3'>전체</td><td>"+ed_cr[10]+"</td><td>"+ed_ins[10]+"</td></tr>");
              document.write("<tr><td colspan='3'>슬래브 상단</td><td>-</td><td>"+ed_ins[11]+"</td></td></tr>");
              document.write("<tr><td rowspan='4'>창 및 문</td><td rowspan='2'>외기에 직접면함</td><td colspan='2'>창</td><td>"+ed_cr[12]+"</td><td>-</td></td></tr>");
              document.write("<tr><td colspan='2'>문</td><td>"+ed_cr[13]+"</td><td>-</td></td></tr>");
              document.write("<tr><td rowspan='2'>외기에 간접면함</td><td colspan='2'>창</td><td>"+ed_cr[14]+"</td><td>-</td></td></tr>");
              document.write("<tr><td colspan='2'>문</td><td>"+ed_cr[15]+"</td><td>-</td></td></tr>");
              document.write("<tr><td colspan='4'>거실 내 방화문</td><td>"+ed_cr[16]+"</td><td>-</td></td></tr>");
            </script>
          </tbody>
      </table>
    </blockquote>
    
    <br>
    <hr color="gray">
    
    <p>※적용기준:
      <ol>
        <li>건축물의 에너지절약설계기준[시행 2018. 9. 1.] [국토교통부고시 제2017-881호, 2017. 12. 28., 일부개정]</li>
        <li>에너지절약형 친환경주택의 건설기준[시행 2018. 9. 3.] [국토교통부고시 제2018-533호, 2018. 9. 3., 일부개정]</li>
      </ol>
    </p>
  </body>
</html>