@extends('auth.app')

@section('content')
@csrf

<div class="innercontainwrapper">
    	
      <div class="group clearboth">
          <div class="innercol1 abouttext">
              <h2>About Conference</h2>
            
              <h3>{{$event_details->ae_title}}</h3>
              <br />
              {!! nl2br(e($event_details->ae_details)) !!}
               </div>
          <div class="innercol2">
              <div class="lobbyrightvideo">
                  <h3>Welcome to the Conference</h3>
                  <iframe id="introvideo" src="{{$event->ae_intro_video}}" frameborder="0" allow=" fullscreen" allowfullscreen></iframe>
              </div>
              
              <!--<div class="aboutright">
                  <h3>Major highlights</h3>
                  <div class="aboutrightcon">
                      <p>
                          <img src="https://lp.crn.in/lmi/iam-virtual-conference/images/data-security.png" alt="" >
                          <span>Trends and challenges pertaining to data and password security and management</span>
                      </p>
                      <p>
                          <img src="https://lp.crn.in/lmi/iam-virtual-conference/images/success-stories.png" alt="" >
                          <span>Best practices and success stories</span>
                      </p>
                      <p>
                          <img src="https://lp.crn.in/lmi/iam-virtual-conference/images/remote-working.png" alt="" >
                          <span>Leveraging emerging technologies to enable a secure remote working infrastructure</span>
                      </p>
                      <p>
                          <img src="https://lp.crn.in/lmi/iam-virtual-conference/images/charting.png" alt="" >
                          <span>Charting the roadmap ahead</span>
                      </p>
                  </div>
              </div>-->
          </div>
      </div>
      
      <hr>
      
      <h2> Sessions <a href="{{ url('agenda') }}">View All <i class="fas fa-angle-double-right"></i></a></h2>
      
      <div class="group clearboth">
      @foreach($sessions as $row)
        <div class="aboutagenda aboutagendabox1">
            <a href="#">
                  <h3>9 AUGUST, 2023 ({{date('h:i A', strtotime($row->assm_start_time))}} -
                                    {{date('h:i A', strtotime($row->assm_end_time))}} IST)</h3>
                  <h4>{{$row->assm_title}}</h4>

                        @if(!empty($row->speakers) && count($row->speakers) > 0)

                                @foreach ($row->speakers as $sp)
                                <span>
                    <img src="{{$sp->ap_image}}" alt="" >
                  </span>

                                @endforeach                        @endif


                        @if(!empty($row->moderator))
                       
                            <span>
                    <img src="{{$row->moderator->ap_image}}" alt="" >
                  </span>

                        @endif

                        @if(!empty($row->panelists) && count($row->panelists) > 0)
                       
                            @foreach ($row->panelists as $sp)
                            <span>
                    <img src="{{$sp->ap_image}}" alt="" >
                  </span>
                          
                            @endforeach
                        @endif
                  
              </a>
              @if($row->assm_url)
              <div class="btn1">   <a href="javascript:" onclick="video_tracking('{{$row->assm_url}}', 'ondemand', {{$row->assm_id}})"
                  class="join_link conboxbtn" id="join-{{$row->assm_id}}" data-timeLeft="10">Watch
                  Now</a></div>
              @endif
              <!-- <div class="btn1"><a href="#">Join Session</a> -->
            </div>
          @endforeach
      </div>
      
      <hr>
      
      <h2>Speakers <a href="{{ url('speakers') }}">View All <i class="fas fa-angle-double-right"></i></a></h2>
      
      <div class="group clearboth">
      @foreach($speakers as $sp)
        <div class="speakerbox speakerboxheight">
            <img src="{{ $sp->ap_image}}" alt="">
              <h4>{{$sp->ap_name}}</h4>
              <p>{{$sp->ap_designation}}, {{$sp->ap_company}}</p>
          </div>
          @endforeach
          
      </div>
      
  </div>
  
  
  

@endsection

@section('js_after')
<script type="text/javascript">

    $(document).ready(function() {
		{{--  $.fancybox.open({
            	src  :'{{ asset($event->ae_intro_video) }}',
                autoplay: true

        });  --}}
  });

  </script>

@endsection