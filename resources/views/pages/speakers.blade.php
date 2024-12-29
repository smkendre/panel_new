@extends('auth.app')

@section('content')
@csrf
    
    <div class="innercontainwrapper">
       
       <h2>Speakers</h2>
       
       <div class="group clearboth">
           @foreach($speakers as $row)
           <div class="speakerbox speakerboxheight">
               <img src="{{$row->ap_image}}" alt="">
               <h4>{{$row->ap_name}}</h4>
               <p>{{$row->ap_designation}}, {{$row->ap_company}}</p>
           </div>
           @endforeach
           
       </div>
       
   </div>
   
   
   @endsection