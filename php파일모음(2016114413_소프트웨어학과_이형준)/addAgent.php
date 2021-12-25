<html>
  <head>
    <title>학과관리</title>
  </head>

  <body>
    <table>
	<tr>
	  <td> 
	    <?php include "header.php";
	    $db=mysqli_connect("localhost", "아이디", "비밀번호");
	    mysqli_select_db($db, "res");
	    ?> 
	  </td>
	  <td> 
	    이곳은 새 에이전트 등록 페이지입니다. <br><br>
	
	    <?php
	    //echo "<br>post 넘어온 부분 시작<br>";
	    //print_r($_POST);
	    //echo "<br>post 넘어온 부분 끝<br>";
	    if($_POST) { //sql insert 작성부분
	      // g) 데이터베이스에 새 에이전트를 추가합니다. 
	      $result=mysqli_query($db, "insert into 부동산중개인 values (".$_POST["중개인번호"].", '".$_POST["중개인이름"]."', ".$_POST["부동산중개횟수"].")");
    	      echo $result;
	    }
	    ?>
	    <form method="post">
 	      중개인번호:<input type="text" name="중개인번호"><br>
	      중개인이름:<input type="text" name="중개인이름"><br>
	      부동산중개횟수:<input type="text" name="부동산중개횟수"><br>
	      <input type="submit" value="추가">	      
	    </form>
	    <br><br>
	    
	    <?php
		//$db=mysqli_connect("localhost", "root", "wsxcv4545");
		//mysqli_select_db($db,"university");
		$sql_result=mysqli_query($db, "select * from 부동산중개인");

		// echo $sql_result;
		echo "<table border=1>";
		while($sql_array=mysqli_fetch_row($sql_result)) { // row or array or assoc
		  //print_r($sql_array);
		  echo "<tr>";
		  for($i=0;$i<sizeof($sql_array);$i++)
		    echo "<td>".$sql_array[$i]."</td>";
		  echo "</tr>";
		}
 		echo "</table>";
	    ?>
	  </td>
	</tr>
    </table>
  </body>
</html