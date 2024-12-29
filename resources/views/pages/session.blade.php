@extends('auth.app')

@section('content')
@csrf

<div class="innercontainwrapper">
    	
      <div class="group clearboth">

      <div class="row conference_video">
        <div class="agendacol1">
        <h2>Session - {{ $live_session->assm_title}}</h2>
        <br />
        <div class="mainscreenvideo">
            <iframe src="{{ $live_session->assm_url }}" frameborder="0" allowfullscreen width="100%" height="500px"></iframe>
        </div></div>
       
         
      </div>
      
      <hr>
      
      </div>
      </div>

@endsection

@section('js_after')
<script>
    video_tracking('{{ url($live_session->assm_url) }}', 'ondemand', '{{ $live_session->assm_id}}');
</script>
@endsection
