@extends('auth.app')



@section('content')
@csrf
<div class="innermaincontain">
            
	<!--<a href="" class="confrancebanner1"><img src="images/trs.png" alt="" ></a>
	<a href="" class="confrancebanner2"><img src="images/trs.png" alt="" ></a>-->
	
	<img src="https://img.ebpd.in/ec/website/backtowork/oct2020/metting.jpg" alt="" class="rsinnerimg" >
	
</div>


@endsection

@section('js_after')
<script type="text/javascript" src="{{ asset('js-chat/twiliochat-boot.js?1') }}"></script>
<script type="text/javascript">
	window.jQuery(document).ready(function() {
		var box = $('#chatpop');
		$.fancybox.open(box);
	});
</script>
@endsection
