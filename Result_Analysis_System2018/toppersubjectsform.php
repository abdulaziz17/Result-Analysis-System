
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
       
        
  </ul>
</div>

<div id="bodyMain">
<div id="body">
<div id="right">

<center>
<h3>Subject Wise Topper </h3>
</center>
<div>
<span class="rightTxt2">
<br/>
<br/>
<center>
      <?php
        
        $v2=$_POST["sem"];
        $v3=$_POST["sec"];
        ?>
         <?php
        $con= mysqli_connect("localhost","root","","ras2018");
        if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
        }
        $sql="SELECT scode, sname FROM subjects WHERE ssem=$v2"; 
        $result= mysqli_query($con, $sql);
        ?>
        
        <br>
        <form action="toppersubresult.php" method="POST">
            <select name="subject">
               <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <option value="<?php echo $row["scode"];?>"><?php echo $row["sname"];?></option>
                    <?php endwhile;?>
            </select>
           
            <input type="hidden" value="<?php echo htmlspecialchars($_POST["sem"]);?>" name="sem">
            <input type="hidden" value="<?php echo htmlspecialchars($_POST["sec"]);?>" name="sec">
            Top :<select name="top">
                <option value="5">5</option>
                <option value="10">10</option>
            </select>
            <input style="padding:5px 15px;cursor:pointer;border-radius: 5px;" type="submit" value="Submit !" />
        </form>
</center>
</span>
</div>

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
