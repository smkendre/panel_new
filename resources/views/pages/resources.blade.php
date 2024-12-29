@extends('auth.app')

@section('content')
@csrf
   
    <div class="innercontainwrapper">
       
      <!-- <h2>Welcome to LogMeIn Content Hub</h2>
      
      <div class="group clearboth">
        <div class="meetaboutleft"><img src="images/last-pass-logo.png" alt="" ></div><div class="meetaboutright">Technology that works the way you do. We build products that simplify the way people interact with each other and the world around them. We enable people to drive meaningful insights, deeper relationships, and better outcomes for all with frictionless technology.</div>
      </div>
      
      <hr> -->
      
            @if(count($pdfs) > 0)

      <div class="headingtext1">UPCOMING EVENTS</div>
      <div class="group clearboth tac">
                {{--  @foreach($pdfs as $pdf)

          <div class="assetsbox1">
            <div class="asset_left">
                <p><img src="{{ $pdf->ad_image}}" alt=""></p>
                <h6>{{ucfirst($pdf->ad_title)}}</h6> 
                <p>{{$pdf->ad_description}}</p> 
            </div>
              
            <div class="asset_right">
                <p class="btn1" style="margin-right: 10px"><a href="{{$pdf->ad_url}}" data-id="157" target="_blank" class="assetTrack">Download Brochure</a></p>

                <p class="btn1"><a href="mailto:vikram.vora@indianexpress.com" target="_blank" class="assetTrack">Contact Sales</a></p>
            </div>
          </div>

          @endforeach  --}}
                     
          <div class="assetsbox1">
            <div class="asset_left">
                <p><img src="https://panel.expressbpd.in/expresscomputer/digitalsmb/images/techsabha_logo.jpg" alt=""></p>
                <h6>Jaipur</h6> 
                <p>25th to 27th August</p> 
            </div>
              
            <div class="asset_right">
                <p class="btn1" style="margin-right: 10px"><a href="https://panel.expressbpd.in/expresscomputer/digitalsmb/pdf/Tech-Sabha-Jaipur-25-27-Aug-2023-Brochure.pdf" data-id="157" target="_blank" class="assetTrack">Download Brochure</a></p>

                <p class="btn1"><a href="mailto:vikram.vora@indianexpress.com" target="_blank" class="assetTrack">Contact Sales</a></p>
            </div>
          </div>

          <div class="assetsbox1">
            <div class="asset_left">
                <p><img src="https://panel.expressbpd.in/expresscomputer/digitalsmb/images/Tech_Senate_Logo.svg" alt=""></p>
                <h6>Chandigarh</h6> 
                <p>15th and 16th September</p> 
            </div>
              
            <div class="asset_right">
                <p class="btn1" style="margin-right: 10px"><a href="https://panel.expressbpd.in/expresscomputer/digitalsmb/pdf/Technology-Senate-North-2023-brochure.pdf" data-id="157" target="_blank" class="assetTrack">Download Brochure</a></p>

                <p class="btn1"><a href="mailto:vikram.vora@indianexpress.com" target="_blank" class="assetTrack">Contact Sales</a></p>
            </div>
          </div>

          
          <div class="assetsbox1">
            <div class="asset_left">
                <p><img src="https://panel.expressbpd.in/expresscomputer/digitalsmb/images/startup_summit.jpg" alt=""></p>
                <h6>Bangalore</h6> 
                <p>22nd September</p> 
            </div>
              
            <div class="asset_right">
                <p class="btn1" style="margin-right: 10px"><a href="https://panel.expressbpd.in/expresscomputer/digitalsmb/pdf/startup-summit-2023-brochure-.pdf" data-id="157" target="_blank" class="assetTrack">Download Brochure</a></p>

                <p class="btn1"><a href="mailto:vikram.vora@indianexpress.com" target="_blank" class="assetTrack">Contact Sales</a></p>
            </div>
          </div>
                </div>
      
      <hr>
            @endif
        @if(count($videos) > 0)
      <div class="headingtext1">Watch Videos</div>
      
      <div class="group clearboth">
          @foreach($videos as $video)
          <div class="assetsbox spvideoboxheight">
              <iframe src="{{$video->ad_url}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              {{--  <h6>{{$video->ad_title}}</h6>  --}}
              <div class="btn1" style="margin-top: 10px;"><a class="fancybox assetTrack" data-id="{{$video->ad_id}}" data-fancybox-type="iframe" href="{{$video->ad_url}}">Watch Now</a></div>
          </div>
         @endforeach
      </div>
      
      <hr>
      @endif

      <div class="headingtext1">Contact Us for engagement opportunities in our Upcoming Events</div>
      
      <div class="group clearboth">
                <div class="speakerbox1 speakerbox1 speakerboxheight">
        <!-- <img src="https://lp.crn.in/lmi/iam-virtual-conference/images/mathew.jpg" alt=""> -->
                  <h4>Prabhas Jha</h4>
                  <p>+91 9899707440</p>
                   <p class="speakerboxheight1">Assistant Vice President</p>
                  <p><a href="mailto:prabhas.jha@expressindia.com" target="_blank" class="assetTrack">prabhas.jha@expressindia.com</a></p>
                </div>
         
               <!--  <div class="speakerbox speakerboxheight">
        <img src="https://lp.crn.in/lmi/iam-virtual-conference/images/rahul.jpg" alt="">
              <h4>Rahul Sharma</h4>
              <p class="speakerboxheight1">Managing Director - India &amp; SAARC</p>
            <h6><a href="https://www.linkedin.com/in/rahulks/" target="_blank"><i class="fab fa-linkedin"></i></a></h6>
          </div>
         
                <div class="speakerbox speakerboxheight">
        <img src="https://lp.crn.in/lmi/iam-virtual-conference/images/jithesh.jpg" alt="">
              <h4>Jithesh Gopan</h4>
              <p class="speakerboxheight1">Solutions Consultant</p>
        <h6><a href="https://www.linkedin.com/in/jithesh-gopan-27370a16/" target="_blank"><i class="fab fa-linkedin"></i></a></h6>
          </div>
         
                <div class="speakerbox speakerboxheight">
        <img src="https://lp.crn.in/lmi/iam-virtual-conference/images/prateek.jpg" alt="">
              <h4>Prateek Kedia</h4>
              <p class="speakerboxheight1">Regional Manager - Channels</p>
        <h6><a href="https://www.linkedin.com/in/prateek-kedia-a87a759/" target="_blank"><i class="fab fa-linkedin"></i></a></h6>
          </div> -->
         
              </div>

            <div class="group clearboth">
                <h4>North</h4>
                <div class="speakerbox1 speakerboxheight">
                  <h4>Sunil kumar</h4>
                  <p>+91 9810718050</p>
                  <p>Senior Manager</p>
                  <p><a href="mailto:sunil.kumar@expressindia.com" target="_blank" class="assetTrack">sunil.kumar@expressindia.com</a></p>
                </div>

                <div class="speakerbox1 speakerboxheight">
                  <h4>Saksham Sharma</h4>
                  <p>+91 9818822227</p>
                   <p class="speakerboxheight1">Deputy Manager</p>
                  <p><a href="mailto:saksham.sharma@expressindia.com" target="_blank" class="assetTrack">saksham.sharma@expressindia.com</a></p>
                </div>
            </div>
            
            <div class="group clearboth">
                <h4>West</h4>
                <div class="speakerbox1 speakerboxheight">
                  <h4>Ashish D Damania</h4>
                  <p>+91 9819662181</p>
                  <p>Deputy General Manager</p>
                  <p><a href="mailto:ashish.damania@indianexpress.com" target="_blank" class="assetTrack">ashish.damania@indianexpress.com</a></p>
                </div>

                <div class="speakerbox1 speakerboxheight">
                  <h4>Deepak Patel</h4>
                  <p>+91 9820733448</p>
                  <p>Senior Manager</p>
                  <p><a href="mailto:deepak.patel@expressindia.com" target="_blank" class="assetTrack">deepak.patel@expressindia.com</a></p>
                </div>
            </div>

            <div class="group clearboth">
                <h4>South</h4>
                <div class="speakerbox1 speakerboxheight">
                  <h4>Durgaprasad Talithaya</h4>
                  <p>+91 9900566513</p>
                  <p>Deputy General Manager</p>
                  <p><a href="mailto:durga.prasad@expressindia.com" target="_blank" class="assetTrack">durga.prasad@expressindia.com</a></p>
                </div>

                <div class="speakerbox1 speakerboxheight">
                  <h4>Praveen Kumar Soman</h4>
                  <p>+91 9900566513</p>
                  <p>Senior Manager</p>
                  <p><a href="mailto:praveenkumar.soman@expressindia.com" target="_blank" class="assetTrack">praveenkumar.soman@expressindia.com</a></p>
                </div>

                <div class="speakerbox1 speakerboxheight">
                  <h4>Aparna Tawade</h4>
                  <p>+91 9900566513</p>
                  <p>Senior Manager</p>
                  <p><a href="mailto:aparna.tawade@indianexpress.com" target="_blank" class="assetTrack">aparna.tawade@indianexpress.com</a></p>
                </div>
            </div>

            <div class="group clearboth">
                <h4>East</h4>
                <div class="speakerbox1 speakerboxheight">
                  <h4>Debnarayan Dutta</h4>
                  <p>+91 9051150480</p>
                  <p>General Manager</p>
                  <p><a href="mailto:debnarayan.dutta@expressindia.com" target="_blank" class="assetTrack">debnarayan.dutta@expressindia.com</a></p>
                </div>
            </div>
  </div>
  

@endsection