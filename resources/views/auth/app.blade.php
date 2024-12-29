<!doctype html>
<html lang="en">

<head>
  <title>{{$event->ae_title}}</title>
  <meta name="description" content="">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0, minimal-ui" />

  <link rel="shortcut icon" href="favicon.png">
  <link rel="icon" type="image/png" href="favicon.png">

  <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<!--<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<link rel="stylesheet" href="{{ asset('css/jquery.fancybox.min.css') }}" type="text/css" media="screen" />
<link rel="stylesheet" href="{{ asset('css/jquery.datetimepicker.min.css') }}" type="text/css" media="screen" />

<link href="{{ asset('css/common-text.css?1.0.4') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/common-layout.css?2.2.2') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/popup.css?2.0.5') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/resrponsive.css?1.3.7') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css?1.2') }}">

<script>
  var JS_URL = "{{ url('/') }}/";
</script>
</head>

<body>


<div class="loader"><span></span></div>

    
<div class="topmainbg">
    	<div class="topmainleft"><a href="{{ url('/') }}"><img src="{{ asset('images/ie-logo2.png') }}" alt="" class="border-right" /><img src="{{ asset('images/ec-logo1.png') }}" alt=""  class="border-right" /><img src="{{ asset('images/crn-logo.png') }}" alt="" ></a></div>
        <div class="innertopmenubg">
            <a  class="toprightlink" ><i class="fa fa-cog"></i></a>
            <div class="toprightlinkshow">
                <ul class="nobullet">
                    <li><a href="{{ url('profile') }}"> Profile</a></li>
                    <!-- <li><a data-fancybox data-src="#viewpopup" data-options='{"touch": false}' href="javascript:;">View Profile</a></li> -->
                    <li><a href="{{ url('logout') }}">Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="attendingbox">
        
        <a data-fancybox data-src="#totalattending" data-options='{"touch": false}'
          href="javascript:;" {{ (Request::segment(1) == 'agenda') ? 'style="display: none;"': '' }}>Total Attending : <u id="totalcount">0</U></a>

          <a style="display: none;" data-fancybox data-src="#nowattending" data-options='{"touch": false}'
          href="javascript:;">Now Attending : <u id="livecount">0</U></a>
        </div>
    </div>
    
    @include('layouts.menu')
    @yield('content')
    
    
    <div class="mainfooter">
            <div class="mainfooterleft"><a href="https://www.expresscomputer.in/" target="_blank"><img src="{{ asset('images/ie-logo2.png') }}" alt="" class="border-right" /><img src="{{ asset('images/ec-logo1.png') }}" alt=""  class="border-right" /></a><a href="https://www.crn.in/" target="_blank"><img src="{{ asset('images/crn-logo.png') }}" alt="" ></a>  Copyright &copy; The Indian Express [P] Ltd. All Rights Reserved. <span>|</span> <a href="https://www.crn.in/privacy-policy/" target="_blank">Privacy Policy</a></div>
            <div class="mainfooterright">
                <a href="https://www.facebook.com/ExpressComputerOnline" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="https://www.linkedin.com/company/express-computer/" target="_blank"><i class="fab fa-linkedin"></i></a>
                <a href="https://twitter.com/ExpComputer?s=20" target="_blank"><i class="fab fa-twitter"></i></a>
                {{--  <a href="https://www.instagram.com/crnindia/" target="_blank"><i class="fab fa-instagram"></i></a>  --}}
            </div>
        </div>

    
    
    @include('layouts.profile')
    @include('layouts.requestmeeting')

  @include('layouts.nowattending')
  @include('layouts.message')
  @include('layouts.poll')
  @include('layouts.askquestion')
  @include('layouts.chat')

    <div id="messagePopup" class="popmain3">
    <div class="popmainheading">Message</div>
    <div class="popmain1con1">
      <div class="popupformmain1">
        <p id="successMsg"><label></label></p>
      </div>
    </div>
  </div>


  <div id="announsmessage" class="popmain3">
        <div class="popmainheading">Announcement Message</div>
        <div class="popmain1con1">
            <div class="popupformmain1">
                <p class="tac"><label for=""></label></p>
                <p class="desc">is live now</p>
                <br>
                <div class="actionBtn btn1"><a href="">Join Now</a></div>
            </div>
        </div>
        <button type="button" data-fancybox-close="" class="fancybox-button fancybox-close-small"
            title="Close"></button>
    </div>


  <input type="hidden" name="name" id="name" value="{{session()->get('username')}}" />
  <input type="hidden" name="user_id" id="user_id" value="{{session()->get('daid')}}" />
  <input type="hidden" name="email" id="email" value="{{session()->get('useremail')}}" />
  <input type="hidden" name="job_title" id="job_title" value="{{session()->get('job_title')}}" />
  <input type="hidden" name="company" id="company" value="{{session()->get('company')}}" />
  <input type="hidden" name="page" id="page" value="{{Request::segment(1)}}" />
  <input type="hidden" name="live_session" id="live_session" value="{{ (isset($_COOKIE['event_id'])) ? $_COOKIE['event_id']: '' }}" />

  <script type="text/javascript" src="https://s.ebpd.in/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="https://s.ebpd.in/ajax-1.9.0.min.js"></script>
  <script type="text/javascript" src="https://s.ebpd.in/source-tracking.js"></script>

  <script src="{{ asset('js/jquery.balance.js') }}" type="text/javascript"></script>
<script type="text/javascript">
	$(window).load(function() {
		$('.aboutagendabox1').balance() ;
		$('.speakerboxheight').balance() ;
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
	  $(".toprightlink").click(function(){
		$(".toprightlinkshow").toggle();
	  });
	});
</script>


<script type="text/javascript" src="{{ asset('js/jquery.fancybox.min.js') }}"></script>

<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<script type="text/javascript" src="{{ asset('js/jquery.datetimepicker.full.min.js') }}"></script>
<script type="text/javascript" src="https://dev.expressbpd.in/socket.io/socket.io.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>

<script type="text/javascript" src="{{ asset('js/main.js?2.2.0') }}"></script>

<script type="text/javascript">
  $(document).ready(function(){

    const socket = io("https://dev.expressbpd.in");

    $('#datetimepicker3').datetimepicker({
      format:'d.m.Y H:i:s',
      inline:true,
      lang:'ru',
      startDate: "today",
      minTime:'8:00',
      maxTime:'21:00',
      onChangeDateTime:function(dp,$input){
        var dNow = new Date(dp);
        var hours = dNow.getHours();
        var minutes =  dNow.getMinutes();

        if (hours < 10) hours = "0" + hours;
        if (minutes < 10) minutes = "0" + minutes;

        var selected_date = dNow.getDate() + '-' + (dNow.getMonth()+1)  + '-' + dNow.getFullYear();
        var selected_time = hours + ':' + minutes;

        $("#selected_date").text(selected_date);
        $("#selected_time").text(selected_time);
        $("#sdate").val(selected_date);
        $("#stime").val(selected_time); 
       
      }
    });

    $("#meetingFrm").validate({
      rules:{
        msg:{required: true}
      },
      messages:{
        msg:{required: "Please enter message"}
      },
      submitHandler: function(form) {            

        $.ajax({
          url: '{{ url('request-meeting') }}',
          data:{msg: $("#msg").val(), _token: $("input[name='_token']").val(), sdate: $("#sdate").val(), stime: $("#stime").val(), sponsor: $("#sponsor").val() },
          type: 'post',
          dataType: 'json',
          success: function(response){
            if(response.status == 200){
              $.fancybox.close();
              $("#successMsg label").text("Request send successfully");
              $.fancybox.open($("#messagePopup"));
            }else{
              $.fancybox.open($("#resigterpopup"));
            }
          }
        });

        return false;
     
        // if($("#email").val() == 'viraj.mehta@indianexpress.com')
        //$("#loginFrm")[0].submit();
        //else
        // $.fancybox.open($("#loginpop").html());
      }
    });

    $("#pollFrm").validate({
        rules:{
            poll_experience:{required: true}
        },
        messages:{
            poll_experience:{required: "Please select question answer"}
        },
        submitHandler: function(form) {            
  
            const id = document.getElementById('pollid').value;
            const pollanswer = $("input[name='poll_experience']:checked").val();
        
            const msg = { pollid: id, userid: {{session()->get('daid')}}, pollanswer: pollanswer }
            socket.emit('pollResponse', msg);

            $("#successMsg label").text("Thank you. Your response noted");
            $.fancybox.open($("#messagePopup"));
  
            setTimeout(function() {
              parent.$.fancybox.close();


              $.fancybox.close();

        }, 3000);
          return false;
       
        
        }
      });

               
    $("#qsansFrm").validate({
      rules:{
        question:{required: true}
      },
      messages:{
        question:{required: "Please enter question"}
      },
      submitHandler: function(form) {            
        // $('#qnaBtn').button('loading');
        $('#qnaBtn').prop('disabled', true);

        /* perform processing then reset button when done */
        $.fancybox.close();
        $(".loader").fadeIn("slow");


        $.ajax({
          url: "{{ url('ask-question') }}",
          data:{question: $("#question").val(), _token: $("input[name='_token']").val()},
          type: 'post',
          dataType: 'json',
          success: function(response){
            if(response.status == 200){
              $.fancybox.close();
              $("#successMsg label").text("Question submitted successfully");
               socket.emit("qna-page-load", {{session()->get('daid')}});              
              $(".loader").fadeOut("slow");

              $.fancybox.open($("#messagePopup"));
              
            }else{
             // $.fancybox.open($("#resigterpopup"));
            }
          }
        });

        return false;
     
        // if($("#email").val() == 'viraj.mehta@indianexpress.com')
        //$("#loginFrm")[0].submit();
        //else
        // $.fancybox.open($("#loginpop").html());
      }
    });
  });
</script>
<script type="text/javascript" src="{{ asset('js/script.js?1.0.4') }}"></script>


<script type="text/javascript">
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
	// $(document).ready(function() {
	// 	$("data-fancybox").fancybox();
	// });
	// $(document).ready(function() {
	// 	$(".fancybox").fancybox();
	// });
	/*window.jQuery(document).ready(function() {
		var box = $('#introvideo');
		$.fancybox.open(box);
  });*/
  
  function sendmessage(id, name, email){

document.getElementById("to_id").value = id;
document.getElementById("to_email").value = email;
document.getElementById("receiver_name").value = name;

//document.getElementById('lblName').innerHTML = "Sending Message to " + name;
}
</script>

<script type="text/javascript">
	$(window).load(function() {
		$(".loader").fadeOut("slow");
	})
</script>
@yield('js_after')
</body>

</html>
