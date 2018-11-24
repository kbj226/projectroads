<?php
$conn=mysqli_connect('localhost', 'nesteng', 'rnqhswns226');
mysqli_select_db($conn, 'nesteng');

mysqli_query($conn, "set session character_set_connection=utf8;");
mysqli_query($conn, "set session character_set_results=utf8;");
mysqli_query($conn, "set session character_set_client=utf8;");

$password=mysqli_real_escape_string($conn, $_POST['password']);

if($password==="nest"){
  /*홈페이지 내용 추가 및 삭제하기*/
  if(empty($_POST['subclass_id'])===false){
    $sql="INSERT INTO homepage (class_id, class_name, subclass_id, subclass_name, subclass_contents) VALUES('".$_POST['class_id']."', '".$_POST['class_name']."', '".$_POST['subclass_id']."', '".$_POST['subclass_name']."', '".$_POST['subclass_contents']."')";
    $result=mysqli_query($conn, $sql);
  }
  if(empty($_POST['del_subclass_id'])===false){
    $sql="DELETE FROM homepage WHERE subclass_id='".$_POST['del_subclass_id']."'";
    $result=mysqli_query($conn, $sql);
  }
    
  /*건축물의 에너지절약설계기준 지역별 열관류율 기준 추가 및 삭제하기*/
  if(empty($_POST['e_reg'])===false){
    $sql="INSERT INTO energysaving (e_reg, e_0, e_1, e_2, e_3, e_4, e_5, e_6, e_7, e_8, e_9, e_10, e_11, e_12, e_13, e_14, e_15, e_16, e_17, e_18) VALUES('".$_POST['e_reg']."', ".$_POST['e_0'].", ".$_POST['e_1'].", ".$_POST['e_2'].", ".$_POST['e_3'].", ".$_POST['e_4'].", ".$_POST['e_5'].", ".$_POST['e_6'].", ".$_POST['e_7'].", ".$_POST['e_8'].", ".$_POST['e_9'].", ".$_POST['e_10'].", ".$_POST['e_11'].", ".$_POST['e_12'].", ".$_POST['e_13'].", ".$_POST['e_14'].", ".$_POST['e_15'].", ".$_POST['e_16'].", ".$_POST['e_17'].", ".$_POST['e_18'].")";
    $result=mysqli_query($conn, $sql);
  }
  if(empty($_POST['del_e_reg'])===false){
    $sql="DELETE FROM energysaving WHERE e_reg='".$_POST['del_e_reg']."'";
    $result=mysqli_query($conn, $sql);
  }
  
  /*에너지절약형 친환경주택의 건설기준 지역별 창 열관류율 기준 추가 및 삭제하기*/
  if(empty($_POST['h_win_reg'])===false){
    $sql="INSERT INTO ecohouse_win (h_win_reg, h_win_0, h_win_1) VALUES('".$_POST['h_win_reg']."', ".$_POST['h_win_0'].", ".$_POST['h_win_1'].")";
    $result=mysqli_query($conn, $sql);
  }
  if(empty($_POST['del_h_win_reg'])===false){
    $sql="DELETE FROM ecohouse_win WHERE h_win_reg='".$_POST['del_h_win_reg']."'";
    $result=mysqli_query($conn, $sql);
  }
  
  /*에너지절약형 친환경주택의 건설기준 지역별 벽체 등 열관류율 기준 추가 및 삭제하기*/
  if(empty($_POST['h_env_reg'])===false){
    $sql="INSERT INTO ecohouse_env (h_env_reg, h_env_0, h_env_1, h_env_2, h_env_3, h_env_4, h_env_5, h_env_6) VALUES('".$_POST['h_env_reg']."', ".$_POST['h_env_0'].", ".$_POST['h_env_1'].", ".$_POST['h_env_2'].", ".$_POST['h_env_3'].", ".$_POST['h_env_4'].", ".$_POST['h_env_5'].", ".$_POST['h_env_6'].")";
    $result=mysqli_query($conn, $sql);
  }
  if(empty($_POST['del_h_env_reg'])===false){
    $sql="DELETE FROM ecohouse_env WHERE h_env_reg='".$_POST['del_h_env_reg']."'";
    $result=mysqli_query($conn, $sql);
  }
  
  /*에너지절약형 친환경주택의 건설기준 지역별 세대 내 강재문 열관류율 기준 추가 및 삭제하기*/
  if(empty($_POST['h_doo_reg'])===false){
    $sql="INSERT INTO ecohouse_doo (h_doo_reg, h_doo_0, h_doo_1, h_doo_2) VALUES('".$_POST['h_doo_reg']."', ".$_POST['h_doo_0'].", ".$_POST['h_doo_1'].", ".$_POST['h_doo_2'].")";
    $result=mysqli_query($conn, $sql);
  }
  if(empty($_POST['del_h_doo_reg'])===false){
    $sql="DELETE FROM ecohouse_doo WHERE h_doo_reg='".$_POST['del_h_doo_reg']."'";
    $result=mysqli_query($conn, $sql);
  }
  
  /*재료별 물성치 추가 및 삭제하기*/
  if(empty($_POST['mat_conductance'])===false){
    $sql="INSERT INTO thermal_property (mat_category, mat_name, mat_conductance) VALUES('".$_POST['mat_category']."', '".$_POST['mat_name']."', ".$_POST['mat_conductance'].")";
    $result=mysqli_query($conn, $sql);
  }
  if(empty($_POST['mat_resistance'])===false){
    $sql="INSERT INTO thermal_property (mat_category, mat_name, mat_resistance) VALUES('".$_POST['mat_category']."', '".$_POST['mat_name']."', ".$_POST['mat_resistance'].")";
    $result=mysqli_query($conn, $sql);
  }
  if(empty($_POST['mat_ufactor'])===false){
    $sql="INSERT INTO thermal_property (mat_category, mat_name, mat_ufactor) VALUES('".$_POST['mat_category']."', '".$_POST['mat_name']."', ".$_POST['mat_ufactor'].")";
    $result=mysqli_query($conn, $sql);
  }
  if(empty($_POST['del_mat_name'])===false){
    $sql="DELETE FROM thermal_property WHERE mat_name='".$_POST['del_mat_name']."'";
    $result=mysqli_query($conn, $sql);
  }
  
  header($_POST['redirect_page']);
}
  
else{
  echo "<p>Wrong Password!</p>";
}
?>