<style type="text/css">

.hr_sep{
    border: 0 !important;
    border-top: 2px solid #000 !important;
    width: 60px !important;
    margin: 60px auto !important;
}
.site-footer__linklist{
	margin-bottom: 15px !important;
	list-style: none outside !important;
    margin-left: 0 !important;
	margin: 0 0 15px 20px !important;
    padding: 0 !important;
    text-rendering: optimizeLegibility !important;
	line-height: 1.563 !important;
}
.site-footer__linklist a{
	color:#222323;
	font-family: "News Cycle",sans-serif;
	font-weight: 400;
    font-style: normal;
    -webkit-font-smoothing: antialiased;
	font-size: 17px;
}
.footer-nav a{
	color:#222323 !important;
	font-size: 17px !important;
}

p.footer_menu_butom{
	font-size: 17px !important;
    font-family: "News Cycle",sans-serif !important;
    font-weight: 400 !important;
	color:#222323 !important;
    font-style: normal !important;
    -webkit-font-smoothing: antialiased !important;
}


@media screen and (max-width: 720px) {

	.adoption{
		font-size:11px !important;
		padding:2px !important;
	}
	.img_con{
		padding:2px !important;
	}
	.btn.btn-success.options{
		border-radius: 0px !important;
		width: 100% !important;
		padding: 2px !important;
		font-size: 11px !important;
		border: 2px solid #fff !important;
	}
	.table > tbody > tr > td{
		padding:0px !important;
	}
	
}
@media screen and (max-width: 480px) {
	.navbar-collapse { 
		right: auto !important; 
		left: 0% !important;  
		width: 200px !important;
		height: 270px  !important; 
	}
	.kd-rightside{
		float:left !important;
	}
	.sub-dropdown{
		box-shadow:none !important;
		border-top:none !important;
		margin:0px !important;
	}
	.sub-dropdown a{
		color:#333 !important;
	}
	.sub-dropdown li{
		border-bottom:none !important;
	}
	.kd-search{
		display:none !important;
	}
	.mob_cart{
		display:block !important;
		    margin-top: 10px;
    font-size: 25px;
	}
}
</style>
<script src="<?php echo $path?>js/jquery.js"></script> 
<script src="<?php echo $path?>js/bootstrap.min.js"></script> 
<script src="<?php echo $path?>js/bootstrap-datepicker.js"></script>
<script src="<?php echo $path?>js/custom.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<?php require_once ('../js/payment.php')?>
</body>
</html>