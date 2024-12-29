@extends('auth.app')

@section('content')
@csrf
   
    <div class="innercontainwrapper">
       
        <h2>Agenda</h2>
        
        <div class="group clearboth" id="agendaWrapper">
         
        </div>
        
    </div>
    
@endsection

@section('js_after')
   <script type="text/javascript">

    ajax_agenda_load();
</script> 
@endsection