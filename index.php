<?php
$conn=mysqli_connect('localhost', 'nesteng', 'rnqhswns226');

mysqli_query($conn, "set session character_set_connection=utf8;");
mysqli_query($conn, "set session character_set_results=utf8;");
mysqli_query($conn, "set session character_set_client=utf8;");

mysqli_select_db($conn, 'nesteng');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/style.css">
  <title>네스트이엔지</title>
</head>
<body>
  
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  
  <header>
    <a href="/index.php"><img src="/contents/nest_logo.jpg"/></a>
  </header>
  
  <div id="indicator">
    <?php
      echo "<p align='center'>";
      if(empty($_GET['subclass_name'])===false){
        echo $_GET['subclass_name'];
      }
      else{
        echo "HOME";
      }
      echo "</p>";
    ?>
  </div>
  
  <div id="middle">
    <div id="middle_left">
      <nav>
        <p>
          MENU
        </p>
        <ul>
          <li class="menu"><a href="/index.php">HOME</a></li>
          <?php
            $tempClassId="z99";
            $sql="SELECT * FROM homepage ORDER BY subclass_id ASC";
            $result=mysqli_query($conn, $sql);
            while($row=mysqli_fetch_assoc($result)){
              if($row['class_id']===$tempClassId){
                echo "<li><a href='/index.php?subclass_name=".$row['subclass_name']."'>".$row['subclass_name']."</a></li>";
                $tempClassId=$row['class_id'];
              }
              else if($tempClassId==="z99"){
                echo "<li class='menu'>";
                echo "<a>".$row['class_name']."</a>";
                echo "<ul class='hide'>";
                echo "<li><a href='/index.php?subclass_name=".$row['subclass_name']."'>".$row['subclass_name']."</a></li>";
                $tempClassId=$row['class_id'];
              }
              else{
                echo "</ul>";
                echo "</li>";
                echo "<li class='menu'>";
                echo "<a>".$row['class_name']."</a>";
                echo "<ul class='hide'>";
                echo "<li><a href='/index.php?subclass_name=".$row['subclass_name']."'>".$row['subclass_name']."</a></li>";
                $tempClassId=$row['class_id'];
              }
            }
            echo "</ul>";
            echo "</li>";
          ?>
          <li class="menu">
            <a>TOOLS</a>
            <ul class="hide">
              <li><a href="/envelopedesign01.php" target="_blank">단열계획프로그램</a></li>
            </ul>
          </li>
          <li class="menu"><a href="/index.php?subclass_name=CONTACT US">CONTACT US</a></li>
        </ul>
      </nav>
    </div>

    <div id="middle_center">
      <article>
        <?php
        if((empty($_GET['subclass_name'])===false)and($_GET['subclass_name']==='CONTACT US')){
        echo "<h1>";
        echo "CONTACT US";
        echo "</h1>";
        echo "<h2>";
        echo "E-MAIL";
        echo "</h2>";
        echo "<blockquote>";
        echo "<p>nestengkorea@gmail.com</p>";
        echo "</blockquote>";
        echo "<h2>";
        echo "PHONE";
        echo "</h2>";
        echo "<blockquote>";
        echo "<p>+82 10 6387 3875</p>";
        echo "</blockquote>";
        }
        else if(empty($_GET['subclass_name'])===false){
          $sql="SELECT * FROM homepage WHERE subclass_name='".$_GET['subclass_name']."'";
          $result=mysqli_query($conn, $sql);
          $row=mysqli_fetch_assoc($result);
          echo $row['subclass_contents'];
        }
        else{
          echo "<img src='/contents/nest_home.jpg'/>";
          echo "<p align='center'>네스트이엔지를 방문해 주셔서 감사합니다.</p>";
          echo "<p align='center'>문의사항은 우측 하단의 Live Chat 기능을 이용하시거나</p>";
          echo "<p align='center'><a href='/index.php?subclass_name=CONTACT US'>CONTACT US</a> 페이지를 통해 질문해 주시면 빠른 시일 내에 답변드리겠습니다.</p>";
        }
        ?>
      </article>
    </div>

    <div id=middle_right>
      <div id=banner></div>
    </div>
  </div>
  
  <footer>
    <p>상호명: 어디야디자인</p>
    <p>TEL: +82 10 6387 3875</p>
  </footer>
  
  <script>
    $(document).ready(function(){
        $(".menu>a").click(function(){
            $(this).next("ul").toggleClass("hide");
        });
    });
  </script>
  
  <!--Start of Tawk.to Script-->
  <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5b515328df040c3e9e0bc6ba/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
  </script>
  <!--End of Tawk.to Script-->
</body>
</html>