<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/styles/style.css" />
	<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/images/icon.png"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/styles/ddlevelsmenu-base.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/styles/ddlevelsmenu-topbar.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/styles/ddlevelsmenu-sidebar.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/default/easyui.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/icon.css"/>
<link rel="shortcut icon" href="<? echo base_url(); ?>public/images/bantaeng.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/demo/demo.css"/>

<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.edatagrid.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/autoCurrency.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/numberFormat.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/ajaxfileupload.js"></script>

<link href="<?php echo base_url(); ?>easyui/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/ddlevelsmenu.js"></script>
	<SCRIPT LANGUAGE="JavaScript">

	var secs;
	var timerID = null;
	var timerRunning = false;
	var delay = 2000;

	function InitializeTimer(){
		secs = 1;
		StopTheClock();
		StartTheTimer();
	}

	function StopTheClock(){
		if(timerRunning)
		clearTimeout(timerID);
		timerRunning = false;
	}

	function StartTheTimer(){
		if (secs==0){
			StopTheClock();
			ceklogin();
			secs = 1;
			timerRunning = true;
			timerID = self.setTimeout("StartTheTimer()", delay);
		}else{
			self.status = secs;
			secs = secs - 1;
			timerRunning = true;
			timerID = self.setTimeout("StartTheTimer()", delay);
		}
	}


	function ceklogin(){

        $(function(){      
         $.ajax({
            type: 'POST',
            dataType:"json",
            url:"<?php echo base_url(); ?>index.php/welcome/ceklogin",
            success:function(data){
			   if ((data==1) && (document.location.href != '<?php echo base_url(); ?>index.php')){
				  document.location.href = '<?php echo base_url(); ?>index.php'; 
			   }
			}
         });
        });

	}	



	</SCRIPT>  

</head>

<body onload="InitializeTimer(); StartTheTimer();">
<div id="container1">
	<div id="header"></div>
     <div id="cssmenu">
        <?php
        	$topmenu = $this->Mmenu->get_menu(); 
        	//$topmenu = $this->dynamic_menu->build_menu();  		
    		echo $topmenu;
    	?>
      </div>
      
    <div id="body1" style="background:<?php echo base_url();?>/public/images/back.jpg">
   	<?php
   		//if($this->auth->is_logged_in() == true){ 
			if(isset($contents)){
            	echo $contents;
                
            }
		//} 
    ?>
	</div>

	<div id="boxfoot">
	<p style="color:white;"> SIMBAKDA 2024 &copy;</p>
	</div>
  </div>
</body>
</html>
