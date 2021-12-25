<html>
  <head>
    <title>매물관리</title>
    <style>
        	img {
	    width:100px;
	}
    </style>
  </head>

  <body>
    <center>
    <table>
	<tr>
	  <td> 
	    <?php include "header.php";
	    $db=mysqli_connect("localhost", "아이디", "비밀번호");
	    mysqli_select_db($db, "res");
	    ?> 
	  </td>
	  <td> 
	    이곳은 매물검색 페이지입니다. <br><br>
	    <hr><h2>a. 도시 "상주시"에서 매매할 주택의 가격이 1억에서 2억 사이인 매물</h2><hr>
	    <?php
		// a) 도시 "상주시"에서 매매할 주택의 가격이 1억에서 2억 사이인 매물을 찾으십시오.
		$sql_result=mysqli_query($db, "select * from 현재매물 where 도시='상주' and 판매가>=100000000 and 판매가<=200000000");

		echo "<table border=1>";
		echo "<tr><td>매물번호</td><td>판매자 번호</td><td>판매 대리인 번호</td><td>건물사진</td><td>건물이름</td><td>침실갯수</td><td>화장실갯수</td><td>도시</td><td>판매가</td><td>등록상태</td><td>등록일</td></tr>";
		while($sql_array=mysqli_fetch_row($sql_result)) { // row or array or assoc
		  echo "<tr>";
		  for($i=0;$i<sizeof($sql_array);$i++) {
		    if(strpos($sql_array[$i], 'Image') !== false) {
		        echo "<td><img src=".$sql_array[$i]."></td>";
		    }
		    else {
		        echo "<td>".$sql_array[$i]."</td>";
		    }
		  }
		  echo "</tr>";
		}
 		echo "</table>";
	    ?>
	  </td>
	</tr>
	<tr>
	    <td>
		<?php include "header.php";?>
	    </td>
	    <td>
	      <hr><h2>b. 침실이 3개 이상 있고 화장실이 2개인 특정 동네의 매물 주소</h2><hr>
	      <?php
		// b) 침실이 3개 이상 있고 화장실이 2개인 특정 동네의 매물 주소를 찾으십시오.
	       	$sql_result2=mysqli_query($db, "select * from 현재매물 where 침실갯수>=3 and 화장실갯수=2");

		echo "<table border=1>";
		echo "<tr><td>매물번호</td><td>판매자번호</td><td>판매 대리인 번호</td><td>건물사진</td><td>건물이름</td><td>침실갯수</td><td>화장실갯수</td><td>도시</td><td>판매가</td><td>등록상태</td><td>등록일</td></tr>";
		while($sql_array2=mysqli_fetch_row($sql_result2)) { // row or array or assoc
		  echo "<tr>";
		  for($i=0;$i<sizeof($sql_array2);$i++) {
		    if(strpos($sql_array2[$i], 'Image') !== false) {
		        echo "<td><img src=".$sql_array2[$i]."></td>";
		    }
		    else {
		        echo "<td>".$sql_array2[$i]."</td>";
		    }
		  }
		  echo "</tr>";
		}
 		echo "</table>";
	      ?>
	    </td>
	</tr>
	<tr>
	    <td>
		<?php include "header.php";?>
	    </td>
	    <td>
	      <hr><h2>c. 총 거래 매물의 합계로 2021년에 가장 많은 부동산을 거래한 에이전트의 이름</h2><hr>
	      <?php
		// c) 총 거래 매물의 합계로 2021년에 가장 많은 부동산을 거래한 에이전트의 이름을 찾으십시오.
		$sql_result3=mysqli_query($db, "SELECT b.중개인이름, count(b.중개인번호) FROM 최근거래매물 AS a, 부동산중개인 AS b WHERE a.중개인번호=b.중개인번호 AND 판매일 LIKE '%2021%' GROUP BY(b.중개인번호) order by count(*) desc limit 1");
		echo "<table border=1>";
		echo "<tr><td>중개인이름</td><td>부동산 거래 횟수</td></tr>";
		while($sql_array3=mysqli_fetch_row($sql_result3)) { // row or array or assoc
		  echo "<tr>";
		  for($i=0;$i<sizeof($sql_array3);$i++) {
		    if(strpos($sql_array3[$i], 'Image') !== false) {
		        echo "<td><img src=".$sql_array3[$i]."></td>";
		    }
		    else {
		        echo "<td>".$sql_array3[$i]."</td>";
		    }
		  }
		  echo "</tr>";
		}
 		echo "</table>";
	      ?>
	    </td>
	</tr>
	<tr>
	    <td>
		<?php include "header.php";?>
	    </td>
	    <td>
	      <hr><h2>d. 각 에이전트에 대해 2020년에 판매된 부동산의 평균 매매 가격과 부동산 매물로 나온뒤 거래가 성사될 때까지의 평균 시간</h2><hr>
	      <?php
		// d) 각 에이전트에 대해 2020년에 판매된 부동산의 평균 매매 가격과 부동산 매물로 나온뒤 거래가 성사될 때까지의 평균 시간을 계산합니다.
	       	$sql_result4=mysqli_query($db, "SELECT 현재매물.중개인번호, AVG(판매가), avg(cast(replace(판매일,'-','') as signed)-(cast(replace(등록일,'-','') as signed))) FROM 최근거래매물, 현재매물 WHERE 현재매물.중개인번호=최근거래매물.중개인번호 AND 판매일 LIKE '%2020%' GROUP BY 현재매물.중개인번호;");

		echo "<table border=1>";
		echo "<tr><td>중개인번호</td><td>평균판매가</td><td>거래 성사 평균 시간</td></tr>";
		while($sql_array4=mysqli_fetch_row($sql_result4)) { // row or array or assoc
		  echo "<tr>";
		  for($i=0;$i<sizeof($sql_array4);$i++) {
		    if(strpos($sql_array4[$i], 'Image') !== false) {
		        echo "<td><img src=".$sql_array4[$i]."></td>";
		    }
		    else {
		        echo "<td>".$sql_array4[$i]."</td>";
		    }
		  }
		  echo "</tr>";
		}
 		echo "</table>";
	      ?>
	    </td>
	</tr>
	<tr>
	    <td>
		<?php include "header.php";?>
	    </td>
	    <td>
	      <hr><h2>e. 가장 비싼 집의 사진</h2><hr>
	      <?php
		// e) 데이터베이스에서 가장 비싼 집의 사진을 보여주십시오.
	       	$sql_result5=mysqli_query($db, "SELECT 건물사진 FROM 현재매물 WHERE 판매가 = (SELECT max(판매가) FROM 현재매물)");

		echo "<table border=1>";
		while($sql_array5=mysqli_fetch_row($sql_result5)) { // row or array or assoc
		  echo "<tr>";
		  for($i=0;$i<sizeof($sql_array5);$i++) {
		    if(strpos($sql_array5[$i], 'Image') !== false) {
		        echo "<td><img src=".$sql_array5[$i]."></td>";
		    }
		    else {
		        echo "<td>".$sql_array5[$i]."</td>";
		    }
		  }
		  echo "</tr>";
		}
 		echo "</table>";
	      ?>
	    </td>
	</tr>
	<tr>
	    <td>
		<?php include "header.php";?>
	    </td>
	    <td>
	      <hr><h2>f. 현재 거래 할 수 있는 매물의 내역</h2><hr>
	      <?php
		// f) 현재 거래 할 수 있는 매물의 내역을 출력합니다. 여기에는 판매 가격, 판매자, 판매 대리인, 판매등록날짜를 ​​저장해야 합니다.
	       	$sql_result6=mysqli_query($db, "SELECT 판매가, 판매자이름, 중개인이름, 등록일 FROM 현재매물 natural join 판매자 natural join 부동산중개인 WHERE 등록상태='등록'");

		echo "<table border=1>";
		echo "<tr><td>판매가격</td><td>판매자</td><td>판매 대리인</td><td>판매등록날짜</td></tr>";
		while($sql_array6=mysqli_fetch_row($sql_result6)) { // row or array or assoc
		  echo "<tr>";
		  for($i=0;$i<sizeof($sql_array6);$i++) {
		    if(strpos($sql_array6[$i], 'Image') !== false) {
		        echo "<td><img src=".$sql_array6[$i]."></td>";
		    }
		    else {
		        echo "<td>".$sql_array6[$i]."</td>";
		    }
		  }
		  echo "</tr>";
		}
 		echo "</table>";
	      ?>
	    </td>
	</tr>
	<tr>
	    <td>
		<?php include "header.php";?>
	    </td>
	    <td>
	      <hr><h2>쿼리 g번은 좌측메뉴 새 에이전트 추가를 클릭하세요</h2><hr>
	    </td>
	</tr>
    </table>
    </center>
  </body>
</html