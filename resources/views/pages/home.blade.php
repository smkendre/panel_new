@extends('layouts.app')

@section('content')
   <div class="loginbg" style=" background: url({{ asset($event->ae_login_bg) }}) no-repeat center;">
        <div class="eclogo">
            <a href="{{ url('/') }}"><img src="{{ asset('images/ec-logo1.png') }}" alt=""></a>
        </div>

        <div class="datetime"><i>09</i>
            <h6 class=""><span>August 20223</span>02:00PM - 06:00PM</h6>
        </div>
        <div class="loginbox">
            <div class="loginboxlogo"><img src="{{ asset('images/digital_smb_logo_white.svg') }}" alt="" style="width: 180px; margin: auto;"></div>
            <form action="{{ route('userlogin') }}" method="POST" id="loginFrm">
                @csrf 
                <h3><i>LOGIN</i> <span class="">Not Registered? <a href="https://digitalsmb.expresscomputer.in/registration.php">Register Now</a></span></h3>
                <h6 class="">If you have already registered, please log in</h6>
                <label class="">Email Address</label>
                <input type="email" id="email" name="email" maxlength="128" value="" required="">
                <div class="group clearboth"><button type="submit">Login</button></div>
            </form>
        </div>
        <div class="idxrightcon">
            <h3 class="">Speakers</h3>
            <!-- <ul class="nobullet headerslider"> -->
            <ul class="nobullet">
                <li>
                    <div class="group clearboth tac">
                        @foreach ($speakers as $sp)
                            <div class="idxspeakerbox idxspeakerboxheight" style="min-height: 232.146px;">
                            <img src="{{ asset($sp->ap_image) }}" alt="">
                            <h4>{{$sp->ap_name}}</h4>
                            <p>{{$sp->ap_designation}}, {{$sp->ap_company}}</p>
                            </div> 
                        @endforeach
                    </div>
                </li>

            </ul>
        </div>
    </div>
   
    <div id="resigterpopup" class="popmain1">
        <div class="fancybox_content">

            <h5>You have not registered for this event </h5>
            <br>
            <div class="btn1"><a href="https://digitalsmb.expresscomputer.in/registration.php" target="_blank"
                title="Close">Register</a>
            </div>
        </div>
    </div>

    <div id="resigterpopup1" class="popmain1">
        <div class="fancybox_content">
            <h5>Thank you for login, Conference will start at 2PM on 8th June 2021</h5>
        </div>
    </div>

    <!-- <div id="loginpop" class="popmain1">
        <div class="fancybox_content">
            <h3>VIRTUAL CONFERENCE </h3>
            <h2>Data Breaches in the post pandemic world      </h2>
            <h4>will be live on</h4>
            <br>
            <h5>8<sup>th</sup> June 2021 | 02:00 PM IST </h5>
            <br>
            <div class="btn1"><a href="javascript:" data-fancybox-close="" title="Close">OK</a>
            </div>
        </div>
    </div>
</div> -->
@endsection


@section('customJs')
    <script src="js/jquery.fancybox.min.js" type="text/javascript"></script>

    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
    <script type="text/javascript">
    $(document).ready(function () { 
        //openCity(event, 'tue2');

        $('button').attr('disabled',false);
        // login page validation
        $("#loginFrm").validate({
            rules: {
                email: { required: true, email: true },
            },
            messages: {
                email: {
                    required: "Please enter your email address",
                    email: "Please enter valid email address"
                },
            },
            submitHandler: function(form) {            

                $.ajax({
                    url: 'ajaxlogin',
                    data:{email: $("#email").val(), _token: $("input[name='_token']").val() },
                    type: 'post',
                    dataType: 'json',
                    success: function(response){
                        if(response.status == 200){
                        // if($("#email").val() == 'sangita.kendre@indianexpress.com'){
                            $("#loginFrm")[0].submit();
                        //  }else{
                        //   $.fancybox.open($("#loginpop"));

                        //  }
                        //   $("#loginFrm")[0].submit();
                        }else{
                            $.fancybox.open($("#resigterpopup"));
                        }
                    }
                });
                return false;
            }
        });
    });
    </script>
@endsection

