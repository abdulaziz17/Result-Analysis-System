
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
        <li class="menuLink"> <a href="individualform.php" class="testimonial">Search for another Roll Number</a></li>
        
        
  </ul>
</div>

<div id="bodyMain">
<div id="body">
<div id="right">

<center>
<h3>Result Analysis System 2018</h3>
</center>
    
    <?php
        $v3=$_POST["rno"];
        $co= mysqli_connect("localhost","root","","ras2018");
        if (!$co) {
        die("Connection failed: " . mysqli_connect_error());
        }?>
         <?php $sq1="SELECT  sem FROM `student_list` where rno=$v3";
                $res1= mysqli_query($co, $sq1);?>
         <?php while ($row = mysqli_fetch_assoc($res1)): ?>
                  <?php $v2= $row["sem"];?>
                    <?php endwhile;?>
    
    <br></br>
<form style="overflow:hidden;"><input style="float:right;clear:both; margin-right: 100px;" type="button" value=" Print this page "
onclick="window.print();return false;" /></form>        
<table align="center" border="3">
  <tr>
      <th align="center" colspan="10">OU Individual Result 2018</th>
  </tr>
  
  <tr>
      <?php
        $con2= mysqli_connect("localhost","root","","ras2018");
        if (!$con2) {
        die("Connection failed: " . mysqli_connect_error());
        }
        $s2="SELECT name FROM `student_list` WHERE rno=$v3";
        $r2= mysqli_query($con2, $s2);
        ?>
      <th colspan="2">Name: </th>
       <?php while ($row = mysqli_fetch_assoc($r2)): ?>
      <?php echo "<td colspan=\"2\"align=\"center\">{$row["name"]}</td>"?>
       <?php endwhile;?>
      <th >Roll Number: </th>
      <td colspan="3" align="center"><?php echo htmlspecialchars($_POST["rno"]);?></td>
  </tr>
  
  <tr>
      <th colspan="2">Class :</th>
    <td colspan="2" align="center"> B.E. I T D </td>
    <th>Section: </th>
     <?php
        $con1= mysqli_connect("localhost","root","","ras2018");
        if (!$con1) {
        die("Connection failed: " . mysqli_connect_error());
        }
        $s="SELECT section FROM `student_list` WHERE rno=$v3";
        $r= mysqli_query($con1, $s);
        ?>
    
     <?php while ($row = mysqli_fetch_assoc($r)): ?>
      <?php echo "<td align=\"center\">{$row["section"]}</td>"?>
       <?php endwhile;?>
    
    <th>Sem: </th>
    <td align="center"><?php echo $v2;?></td>
  </tr>
  <tr>
      <th>S.no</th>
        <th>BITCode</th>
        <th>Subject Name</th>
        <th>scode</th>
        <th>Subject Type</th>
         <th>credit</th>
          <th>grade point</th>
           <th>grade secured</th>
  </tr>
        <?php
        $con= mysqli_connect("localhost","root","","ras2018");
        if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
        }
        $sql="SELECT s.bitcode, s.sname as sname, s.stype, m.credit, m.gp, m.gs, s.scode
                FROM marks_info_it m,subjects s
                WHERE m.scode in (select scode from subjects where ssem=$v2)
                AND m.scode=s.scode
                AND m.rno=$v3 order by stype desc"; 
        $result= mysqli_query($con, $sql);
        $i=1;
        
    ?>
    
  <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <?php 
     echo 
        "<tr>
        <td align=\"center\">{$i}</td>
        <td>{$row["bitcode"]}</td>
        <td >{$row["sname"]}</td>
            <td>{$row["scode"]}</td>
        <td align=\"center\">{$row["stype"]}</td>
        <td align=\"center\">{$row["credit"]}</td>   
        <td align=\"center\">{$row["gp"]}</td>
        <td align=\"center\">{$row["gs"]}</td>
        </tr>";
    ?>
    <?php $i++ ?>
    <?php endwhile;?>
  <tr>
      <!--th>No of Backlogs :</th-->
      <?php   
      $sql4="SELECT COUNT(gs) AS back FROM marks_info_it WHERE rno=$v3
                AND gs IN ('F','Ab')";
      $res4= mysqli_query($con, $sql4);
      ?>
       <?php while ($row = mysqli_fetch_assoc($res4)): ?>
    <?php 
     echo 
        "
        <td align=\"center\" colspan=\"3\"> Total \"  {$row["back"]} \"  Backlogs ( Previous And Current )  </td>
        
        ";
    ?>
    <?php endwhile;?>       
      <th>RESULT-GPA :</th>
      <?php   
      $sql3="SELECT result,gpa FROM results_info_it where rno=$v3 and sem=$v2";
      $res= mysqli_query($con, $sql3);
      ?>
       <?php while ($row = mysqli_fetch_assoc($res)): ?>
        <?php echo " <td align=\"center\">{$row["result"]}</td>"; ?>
      <?php echo " <td align=\"center\">{$row["gpa"]}</td>"; ?>
       <?php endwhile;?>
  </tr>      
</table>
  <form style="overflow:hidden;"><input style="float:right;clear:both; margin-right: 100px;" type="button" value=" Print this page "
onclick="window.print();return false;" /></form>        
    <a href="individualresult.php"></a>

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
