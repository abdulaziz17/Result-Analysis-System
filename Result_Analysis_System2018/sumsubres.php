
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>MJCET RAS2018</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="css/jquerycssmenu.css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<script type="text/javascript"  src="js/jquerycssmenu.js"></script>
<link rel="stylesheet" href="menu.css" type="text/css" media="screen" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/ss/s3Slider.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="js/ss/ssstyle.css" rel="stylesheet" type="text/css" />
<link href="news/news.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="mainmenu">
<ul id="menu">
</ul>
</div>
<div id="topmain">
  <div id="top">    <img src="images/logo.png" alt="Muffakham Jah College of Engineering and Technology" border="0" class="logo" title="Muffakham Jah College of Engineering and Technology" /> </div>
  <ul class="menu">
        <li class="menuLink"><a href="http://www.mjcollege.ac.in" target="_self" class="testimonial">MJCET Home</a></li>
        <li class="menuLink"><a href="index.php" class="testimonial">HOME</a></li>
         <li class="menuLink"><a href="sumsubform.php" class="testimonial">Select Subject</a></li>
         
        
        

         
        
  </ul>
</div>

<div id="bodyMain">
<div id="body">
<div id="right">

<center>
<h3>Result Analysis System </h3>
</center>
<div>
<?php
        
        $v2=$_POST["sem"];
        $v3=$_POST["sec"];
        $v4=$_POST["subject"];
        ?>
        <?php
        $con1= mysqli_connect("localhost","root","","ras2018");
        if (!$con1) {
        die("Connection failed: " . mysqli_connect_error());
        }
        $sql1="SELECT sname FROM `subjects` WHERE scode=$v4";
        $res= mysqli_query($con1, $sql1);
        ?>
    
    <br></br>
    <form style="overflow:hidden;"><input style="float:right;clear:both; margin-right: 100px;" type="button" value=" Print this page "
onclick="window.print();return false;" /></form>        

        <table align="center" border="3">
  <tr>
      <th align="center" colspan="8">OU Subject Wise Analysis Results</th>
  </tr>
  <tr>
      <th>Subject : </th>
      <?php while ($row = mysqli_fetch_assoc($res)): ?>
      <?php echo "<td colspan=\"2\" align=\"center\">{$row["sname"]}</td>"?>
       <?php endwhile;?>
      <?php
       $s="SELECT bitcode FROM `subjects` WHERE scode=$v4";
        $r= mysqli_query($con1, $s);
        ?>
      <th>BIT CODE : </th>
      <?php while ($row = mysqli_fetch_assoc($r)): ?>
      <?php echo "<td align=\"center\">{$row["bitcode"]}</td>"?>
       <?php endwhile;?>
      <?php
       $s1="SELECT bitcode,stype FROM `subjects` WHERE scode=$v4";
        $r1= mysqli_query($con1, $s1);
        ?>
      <th>Subject Type :</th>
      <?php while ($row = mysqli_fetch_assoc($r1)): ?>
      <?php echo "<td colspan=\"2\" align=\"center\">{$row["stype"]}</td>"?>
       <?php endwhile;?>
      
  </tr>
  <tr>
    <th>Class :</th>
    <td colspan="2" align="center">B.E.  IT D </td>
    <th>Section: </th>
    <td align="center">'<?php echo htmlspecialchars($_POST["sec"]);?>'</td>
    <th>Sem: </th>
    <td align="center"><?php echo htmlspecialchars($_POST["sem"]);?></td>
  </tr>
  <tr>
      <th align="center">S.no</th>
      <th colspan="3" align="center">Result</th>
      <th colspan="3" align="center">Total Number Students</th>
                
  </tr>
  <tr>
   <?php
        $con= mysqli_connect("localhost","root","","ras2018");
        if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
        }
        $sql="SELECT scode, gs, count(gs) AS ABC
                FROM marks_info_it
                WHERE rno in (select rno from student_list where section in ('$v3'))and gs in ('S','A','B','C','D','E','F','Ab')
                GROUP BY scode, gs
                HAVING scode=$v4"; 
        $result= mysqli_query($con, $sql);
        $i=1;
        ?>
  <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <?php echo "
    </tr>
    <td align=\"center\">{$i}</td>
    <td colspan=\"3\" align=\"center\">{$row["gs"]}</td>
    <td colspan=\"3\" align=\"center\">{$row["ABC"]}</td>
    </tr>";
    ?>
    <?php $i++ ?>
    <?php endwhile;?>
  </tr>
  <tr>
      <th >Total Students</th>
   <?php
        $cn= mysqli_connect("localhost","root","","ras2018");
        if (!$cn) {
        die("Connection failed: " . mysqli_connect_error());
        }
        $sq1="select count(rno)as count from student_list where sem=$v2 and section in ('$v3')"; 
        $rs1= mysqli_query($cn, $sq1);
          
    ?>
   <?php while ($row = mysqli_fetch_assoc($rs1)): ?>
    <?php  echo"<td align=\"center\" >{$row["count"]}</td>";?>
    <?php $i++ ?>
    <?php endwhile;?>   
      
      <th>Passed Percentage :</th>
      <?php
      
        $sp="SELECT round((count(gs)/count)*100,2) as res
                FROM (select count(rno)as count from student_list where  sem=$v2 and section in ('$v3'))as top , marks_info_it
                WHERE rno in (select rno from student_list where section in ('$v3') )
		and gs in ('S','A','B','C','D','E')
                GROUP BY scode
                HAVING scode=$v4 "; 
        $rp= mysqli_query($cn, $sp);
       
    ?>
   <?php while ($row = mysqli_fetch_assoc($rp)): ?>
    <?php  echo"<td align=\"center\">{$row["res"]} % </td>";?>
    <?php endwhile;?>  
      
      
      <th>Failed Percentage :</th>
      <?php
       
        $sf="SELECT round((count(gs)/count)*100,2) AS res
                FROM (select count(rno)as count from student_list where sem=$v2 and section in ('$v3'))as top , marks_info_it
                WHERE rno in (select rno from student_list where section in ('$v3') )
		and gs in ('F')
                GROUP BY scode
                HAVING scode=$v4"; 
        $rf= mysqli_query($con, $sf);
        
    ?>
   <?php while ($row = mysqli_fetch_assoc($rf)): ?>
    <?php  echo"<td align=\"center\" colspan=\"2\">{$row["res"]} % </td>";?>
    <?php endwhile;?>  
      
       
      
  </tr>
            <center> <tr><th>Absent Percentage :</th>
      <?php
      
        $sp="SELECT round((count(gs)/count)*100,2) as res
                FROM (select count(rno)as count from student_list where  sem=$v2 and section in ('$v3'))as top , marks_info_it
                WHERE rno in (select rno from student_list where section in ('$v3') )
		and gs in ('Ab')
                GROUP BY scode
                HAVING scode=$v4 "; 
        $rp= mysqli_query($cn, $sp);
        
       
    ?>
   <?php while ($row = mysqli_fetch_assoc($rp)): ?>
    <?php  echo"<td align=\"center\">{$row["res"]} % </td>";?>
    <?php endwhile;?> </tr></center> 
           
  
</table>
              <form style="overflow:hidden;"><input style="float:right;clear:both; margin-right: 100px;" type="button" value=" Print this page "
onclick="window.print();return false;" /></form>        

             
</div>
<br class="spacer" />
</div>

<br class="spacer" />
</div>

<div id="footerMain">
  <div id="footer">
    <p class="copyright">Muffakham Jah College of Engineering and Technology, Copyright ©   2017. All Rights Reserved.</p>
   <p class="design">&nbsp;</p>
  </div>
</div>
</body>
</html>
