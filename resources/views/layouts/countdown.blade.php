@extends('layouts.app')

@section('content')

<div class="loginbg">
    	
  <div class="eclogo"><a href="index.html"><img src="images/crn-logo.png" alt="" ></a></div>
  
  <div class="datetime"><i>08</i><h6><span>June 2021</span>02:00PM - 4:30PM</h6></div>
  
  <div class="loginbox">
    <div class="loginboxlogo"><a href="index.html"><img src="images/logmeinlogo.png" alt="" ></a></div>
      <div class="countboxcon">
          <h3>Data Breaches in the<br>Pandemic World and Beyond</h3>
          <h5><img src="images/date-time.png" alt="" > 08 June, 2021 <span>|</span> <img src="images/time-icon.png" alt="" > 02:00PM IST</h5>
          
          <div class="idxcount">
              <ul class="nobullet">
                  <li><span id="days"></span>days</li>
                  <li><span id="hours"></span>Hours</li>
                  <li><span id="minutes"></span>Minutes</li>
                  <li><span id="seconds"></span>Seconds</li>
              </ul>
          </div>
          <h6><span>You will be redirected to the Login Page once the conference begins.</span></h6>
          <!-- <div class="tac"><h4><span>Hiren Mistry</span>hiren.mistry@indianexpress.com</h4></div> -->
          <p class="tac"><i>If you are not redirected automatically,<span>click on the below button to enter the session</span></i></p><br>
          {{-- <div class="btn1 tac"><a href="lobby.html">Login Now</a></div> --}}
      </div>
  </div>
  
  
  
  
</div>

@endsection

@section('customJs')
<script type="text/javascript">
  const second = 1000,
	      minute = second * 60,
	      hour = minute * 60,
	      day = hour * 24; 
		 let countDown = new Date('June 8, 2021 13:30:00').getTime(),
	    x = setInterval(function() {
	
	      let now = new Date().getTime(),
	      distance = countDown - now;
	
	      document.getElementById('days').innerText = Math.floor(distance / (day)),
	        document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour)),
	        document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute)),
	        document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);
	      
	      //do something later when date is reached
	      if (distance < 0) {
	        clearInterval(x);
            window.location.href = 'agenda';
	      }
	
	    }, second);


</script>
@endsection