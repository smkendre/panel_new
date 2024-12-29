<!doctype html>
<html lang="en">
<head>
<title>{{$event->ae_title}}</title>
<meta name="description" content="">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0, minimal-ui" />

<link rel="shortcut icon" href="crnfavicon.ico">
<link rel="icon" type="image/png" href="crnfavicon.png">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.2/jquery.fancybox.min.css" type="text/css" media="screen" />


<link href="css/jquery.bxslider.css?1" rel="stylesheet" type="text/css" />
<link href="css/common-text.css?2.1.1" rel="stylesheet" type="text/css" />
<link href="css/common-layout.css?2.3.2" rel="stylesheet" type="text/css" />
<!-- <link rel="stylesheet" type="text/css" href="css/resrponsive.css?2.1.1"> -->
<link rel="stylesheet" type="text/css" href="css/resrponsive_old.css?1.0.0">
<link rel="stylesheet" type="text/css" href="css/style.css?2.1">

</head>
<body>
	
    
    <div class="loader"><span></span></div>
    
    @yield('content')
    
    
    
    
    
		<div class="mainfooter">
			<div class="mainfooterleft"><a href="https://www.crn.in/" target="_blank"><img src="images/crn-logo.png" alt="" ></a> &copy; 2021 - The Indian Express Pvt. Ltd. All Rights Reserved. <span>|</span> <a href="https://www.crn.in/privacy-policy/" target="_blank">Privacy Policy</a></div>
			<div class="mainfooterright">
					<a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
					<a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
					<a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
					<a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
			</div>
	</div>

    
    
    
<script type="text/javascript" src="https://s.ebpd.in/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="https://s.ebpd.in/ajax-1.9.0.min.js"></script>
<script type="text/javascript" src="https://s.ebpd.in/source-tracking.js"></script>

<script src="js/jquery.balance.js" type="text/javascript"></script>
<script type="text/javascript">
	$(window).load(function() {
		$('.idxspeakerboxheight').balance() ;
	});
</script>

<script src="js/jquery.bxslider.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
	  if($(window).width() < 10500){
		  $('.headerslider').bxSlider({
			infiniteLoop:true,
			auto:true,
			pager:true,
			controls:false,
			  oneToOneTouch:true,
				pause: 7000,
				touchEnabled: true,
		 });
	  }
	});
</script>


<script type="text/javascript">
	$(window).load(function() {
		$(".loader").fadeOut("slow");
	})
</script>

@yield('customJs')
</body>
</html>
