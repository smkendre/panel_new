@extends('auth.app')

@section('content')
@csrf

<div class="innercontainwrapper">
    	
      <div class="group clearboth">

      <div class="row conference_video">
        <div class="innercol1">
        <!-- <h2>Session - {{ $live_session->assm_title}}</h2> -->
        <div class="mainscreenvideo">
            <iframe src="{{ $live_session->assm_webinar_id }}" frameborder="0" allowfullscreen width="100%" height="500px"></iframe>
        </div></div>
        <div class="innercol2">
            {{--  <h2>Attendees</h2>  --}}
            {{--  <div id="nowattendingSidebar" class="popmain1" style="display: block;">
                <div class="popmainheading">Chat</div>
                <div class="popmain1con1">
                    <div class="popupformmain1" id="chat-sidebar">
                     <iframe src="https://vimeo.com/live/interaction_tools/live_event/3620116" frameborder="0" allowfullscreen width="100%" height="500px"></iframe>
                    </div>

                </div>
            </div>  --}}
            <div id="nowattendingSidebar" class="popmain1" style="display: block;">
                    <div class="popmainheading">Now Attending</div>
                    <div class="popmain1con1">
                        <div class="popupformmain1" id="user-list-sidebar">
                        
                        </div>

                    </div>
                </div>
            {{--  <div id="nowattendingSidebar" class="popmain1" style="display: block;">
                <div class="popmainheading">Technical Support</div>
                <div class="popmain1con1">
                    <div class="popupformmain1" id="qna-list">
                    
                    </div>

                </div>
            </div>  --}}
        </div>
      </div>
          <div class="innercol1 abouttext">
              {{--  <h2>About Conference</h2>  --}}
             {{$live_session->assm_description}}
          </div>
          <div class="innercol2">
           
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
<script>
     const socket = io("https://dev.expressbpd.in/");
     socket.emit("liveAttendeesCount", {
    name: $("#name").val(),
    email: $("#email").val(),
    jobtitle: $("#job_title").val(),
    company:   $("#company").val(),
    events: {{$live_session->assm_id}},  //this indicates event id in dbeavrce
    userId: $("#user_id").val()
  });

  function get_questions(){
   
    $.ajax({
        url: "{{ url('get_questions') }}",
        data:{ _token: $("input[name='_token']").val()},
        type: 'post',
        dataType: 'html',
        success: function(response){
            $("#qna-list").html(response);
            
        }
          
    });
  }
  get_questions();
</script>
@endsection
