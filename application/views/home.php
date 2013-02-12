<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kathy Zheng</title>
<link href='http://fonts.googleapis.com/css?family=Nunito:700,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Judson' rel='stylesheet' type='text/css'>
<link rel="StyleSheet" href="css.css" type="text/css">

<!-- jquery lightbox -->
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/lightbox.js"></script>
<link href="css/lightbox.css" rel="stylesheet" />

<script type="text/javascript" src="jquery/jquery-1.4.1.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("body").css("display", "none");
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
            $("body").css("display", "none");
            $("body").fadeIn(200);
    });
</script>

<script type="text/javascript">
$(document).ready(function() {
    $("body").css("display", "none");
 
    $("body").fadeIn(200);
 
    $("a.transition").click(function(event){
        event.preventDefault();
        linkLocation = this.href;
        $("body").fadeOut(200, redirectPage);      
    });
         
    function redirectPage() {
        window.location = linkLocation;
    }
});
</script>

</head>




<body>





<div id="banner" class="translucent">
<img src="header_white.png" />
</div>


<div class="wrapper">
 <div id="table1">
  <center><font size="+3">RUSH WEEK</font></center>
   <br />
   <font size="+1">MEET THE CHAPTER</font><br />
&nbsp;&nbsp;&nbsp;Maude Fife Room, Wheeler 315<br />
&nbsp;&nbsp;&nbsp;Tues February 5th | 7 - 9 PM<br />
&nbsp;&nbsp;&nbsp;Business Casual
<br /><br />
  <font size="+1">SOCIAL MIXER</font><br />
&nbsp;&nbsp;&nbsp;Caffe Strada<br />
&nbsp;&nbsp;&nbsp;Wed February 6th | 7 - 9 PM<br />
&nbsp;&nbsp;&nbsp;Campus Casual<br />

</div>

<div id="table2">
<center><font size="+3">INTERVIEWS</font></center>
<br />
<font size="+1">INDIVIDUAL</font><br />
&nbsp;&nbsp;&nbsp;February 8th<br />
&nbsp;&nbsp;&nbsp;Business professional<br />
&nbsp;&nbsp;&nbsp;*By appointment
<br /><br />
<font size="+1">GROUP</font><br />
&nbsp;&nbsp;&nbsp;February 12th<br />
&nbsp;&nbsp;&nbsp;Business professional<br />
&nbsp;&nbsp;&nbsp;*By invitation<br />

</div> <!--end wrapper-->


<div id="footer">
<center><img src="footer.png" /></center>
</div>

</body>
</html>
