
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
        <li class="menuLink"><a href="topperclassform.php" class="testimonial">Select Another Year/Section</a></li>
       
        
  </ul>
</div>

<div id="bodyMain">
<div id="body">
<div id="right">

<center>
<h3>Result Analysis System </h3>
</center>
 <?php
        
        $v2=$_POST["sem"];
        $v3=$_POST["sec"];
        $v4=$_POST["top"];
        ?>
       
   
    <br></br>
<form style="overflow:hidden;"><input style="float:right;clear:both; margin-right: 100px;" type="button" value=" Print this page "
onclick="window.print();return false;" /></form>        

<table align="center" border="3">
  <tr>
      <th align="center" colspan="7">OU Class Topper Result </th>
  </tr>

  
  <tr>
      <th>Class :</th>
      <td align="center" colspan="2">B.E. IT D </td>
    <th>Section: </th>
     <td align="center"><?php echo htmlspecialchars($_POST["sec"]);?></td>
    <th>Sem: </th>
    <td align="center"><?php echo htmlspecialchars($_POST["sem"]);?></td>
  </tr>
  <tr>
      <th>S.no</th>
      
      <th>Section</th>
      <th >Roll number</th>
        <th colspan="2">Student name</th>
           <th>GPA</th>
           
  </tr>
   <?php
        $con= mysqli_connect("localhost","root","","ras2018");
        if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
        }
        $sql="SELECT s.rno as rno ,section , name, gpa
            FROM results_info_it m,student_list s
            WHERE  m.rno in (select rno from student_list where section in ('$v3') and sem=$v2)
            AND s.rno=m.rno
            ORDER BY gpa desc,rno asc limit $v4"; 
        $result= mysqli_query($con, $sql);
        $i=1;
        ?>
  <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <?php echo "
    </tr>
    <td align=\"center\">{$i}</td>
    
   
   <td align=\"center\">{$row["section"]}</td>
       <td>{$row["rno"]}</td>
           <td colspan=\"2\">{$row["name"]}</td>
    <td>{$row["gpa"]}</td>
               
    </tr>";
    ?>
    <?php $i++ ?>
    <?php endwhile;?>
  
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
