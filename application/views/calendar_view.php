<?php

echo '<a href="'.DOMAIN_BASE_PATH.'internal" style="color: blue;">Click here to go back</a><br><br>';

?>

<!DOCTYPE html>
<html>
<head id="Head1">
    <title>  Calendar </title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link href="<?php echo CSS_BASE_PATH . 'calendar/dailog.css'?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo CSS_BASE_PATH . 'calendar/calendar.css'?>" rel="stylesheet" type="text/css" /> 
    <link href="<?php echo CSS_BASE_PATH . 'calendar/dp.css'?>" rel="stylesheet" type="text/css" />   
    <link href="<?php echo CSS_BASE_PATH . 'calendar/alert.css'?>" rel="stylesheet" type="text/css" /> 
    <link href="<?php echo CSS_BASE_PATH . 'calendar/main.css'?>" rel="stylesheet" type="text/css" /> 
    

    <script src="<?php echo JS_BASE_PATH . 'jQuery.js'?>" type="text/javascript"></script>  
    
    <script src="<?php echo SEPFILES_BASE_PATH . 'src/Plugins/Common.js'?>" type="text/javascript"></script>    
    <script src="<?php echo SEPFILES_BASE_PATH . 'src/Plugins/datepicker_lang_US.js'?>" type="text/javascript"></script>     
    <script src="<?php echo SEPFILES_BASE_PATH . 'src/Plugins/jquery.datepicker.js'?>" type="text/javascript"></script>

    <script src="<?php echo SEPFILES_BASE_PATH . 'src/Plugins/jquery.alert.js'?>" type="text/javascript"></script>    
    <script src="<?php echo SEPFILES_BASE_PATH . 'src/Plugins/jquery.ifrmdailog.js'?>" defer="defer" type="text/javascript"></script>
    <script src="<?php echo SEPFILES_BASE_PATH . 'src/Plugins/wdCalendar_lang_US.js'?>" type="text/javascript"></script>    
    <script src="<?php echo SEPFILES_BASE_PATH . 'src/Plugins/jquery.calendar.js'?>" type="text/javascript"></script>   
    
    <script type="text/javascript" src="<?php echo JS_BASE_PATH . 'calendar/calendar.js'?>"></script>    
</head>
<body>
    <div>

      <div id="calhead" style="padding-left:1px;padding-right:1px;">          
            <div class="cHead"><div class="ftitle">My Calendar</div>
            <div id="loadingpannel" class="ptogtitle loadicon" style="display: none;">Loading data...</div>
             <div id="errorpannel" class="ptogtitle loaderror" style="display: none;">Sorry, could not load your data, please try again later</div>
            </div>          
            
            <div id="caltoolbar" class="ctoolbar">
              <div id="faddbtn" class="fbutton">
                <div><span title='Click to Create New Event' class="addcal">

                New Event                
                </span></div>
            </div>
            <div class="btnseparator"></div>
             <div id="showtodaybtn" class="fbutton">
                <div><span title='Click to back to today ' class="showtoday">
                Today</span></div>
            </div>
              <div class="btnseparator"></div>

            <div id="showdaybtn" class="fbutton">
                <div><span title='Day' class="showdayview">Day</span></div>
            </div>
              <div  id="showweekbtn" class="fbutton fcurrent">
                <div><span title='Week' class="showweekview">Week</span></div>
            </div>
              <div  id="showmonthbtn" class="fbutton">
                <div><span title='Month' class="showmonthview">Month</span></div>

            </div>
            <div class="btnseparator"></div>
              <div  id="showreflashbtn" class="fbutton">
                <div><span title='Refresh view' class="showdayflash">Refresh</span></div>
                </div>
             <div class="btnseparator"></div>
            <div id="sfprevbtn" title="Prev"  class="fbutton">
              <span class="fprev"></span>

            </div>
            <div id="sfnextbtn" title="Next" class="fbutton">
                <span class="fnext"></span>
            </div>
            <div class="fshowdatep fbutton">
                    <div>
                        <input type="hidden" name="txtshow" id="hdtxtshow" />
                        <span id="txtdatetimeshow">Loading</span>

                    </div>
            </div>
            
            <div class="clear"></div>
            </div>
      </div>
      <div style="padding:1px;">

        <div class="t1 chromeColor">
            &nbsp;</div>
        <div class="t2 chromeColor">
            &nbsp;</div>
        <div id="dvCalMain" class="calmain printborder">
            <div id="gridcontainer" style="overflow-y: visible;">
            </div>
        </div>
        <div class="t2 chromeColor">

            &nbsp;</div>
        <div class="t1 chromeColor">
            &nbsp;
        </div>   
        </div>
     
  </div>
    
</body>
</html>
