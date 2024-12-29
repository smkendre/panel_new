@extends('auth.app')

@section('content')
@csrf
    
    <div class="innercontainwrapper">
       
       
       <div class="group clearboth text-center">
           @foreach($sponsors as $row)
           <div class="">
               <img src="{{$row->asp_logo}}" alt="">
              
           </div>
           @endforeach
           
       </div>
       
   </div>
   
   
   @endsection