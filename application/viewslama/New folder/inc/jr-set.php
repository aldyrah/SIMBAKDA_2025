<!--MSG-BOX-->
<div id="jr" title="Message Box.">
<p id="ok" style="font-size:18px;font-weight:bold;"></p>
<p id="x" style="font-size:18px;font-weight:bold;color:red;"></p>
<p id="eng" style="font-size:13px;"></p><hr>
</div>
<!--END-MSG-BOX-->
<!--SCROLL-TO-TOP-->
<style type="text/css">
	#jr-scroll{
			display: none;
			width: 30px;
			height: 30px;
			position: fixed;
			right: 81px;
			bottom: 40px;
			border: 0px;
			border-radius: 10%;
		}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$(window).scroll(function(){
			if($(this).scrollTop() > 200){
				$('#jr-scroll').fadeIn();
			}else{
				$('#jr-scroll').fadeOut();
			}
		});
		$('#jr-scroll').click(function(){
			$('html, body').animate({scrollTop:0},600);
			return false;
		});
	});
</script>
<a id="jr-scroll" href="#"><img src="<?php echo base_url();?>/image/up.png" height="auto" width="60"/></a>
<!--END SCROLL-TO-TOP-->