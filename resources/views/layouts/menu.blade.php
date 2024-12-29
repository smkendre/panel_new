
    <div class="innerheadermain">
    	<div class="innerheaderimg"><img src="{{ asset($event->ae_banner_img) }}" alt="" ></div>
        <div class="innerheadermenu">
        	<ul class="nobullet">
            	<li>
                	<a href="{{ url('conference') }}" {{ (Request::segment(1) == 'conference') ? 'class=active': '' }}>
                    	<i class="fas fa-home"></i>
						<span>Info</span>
                    </a>
                </li>
                <li>
                	<a href="{{ url('agenda') }}" {{ (Request::segment(1) == 'agenda') ? 'class=active': '' }}>
                    	<i class="far fa-file-alt"></i>
						<span>Agenda</span>
                    </a>
                </li>
                 <li>
                	<a  href="{{ url('sponsors') }}" {{ (Request::segment(1) == 'sponsors') ? 'class=active': '' }}>
                    	<i class="far fa-file-alt"></i>
					<span>	Sponsors</span>
                    </a>
                </li>
                <li>
                	<a href="{{ url('speakers') }}" {{ (Request::segment(1) == 'speakers') ? 'class=active': '' }}>
                    	<i class="fas fa-microphone"></i>
						<span>Speakers</span>
                    </a>
                </li>
                <li>
                	<a href="{{ url('assets') }}" {{ (Request::segment(1) == 'assets') ? 'class=active': '' }}>
                    	<i class="fas fa-handshake"></i>
						<span>Upcoming Events</span>
                    </a>
                </li>
             {{--  <li>
                	<a data-fancybox data-src="#requestameeting" data-options='{"touch": false}' href="javascript:;">
                    	<i class="fas fa-bug"></i>
						<span>Request a Meeting</span>
                    </a>
                </li>  --}}

                   <li>
                <a data-fancybox data-src="#askaquestion" data-options='{"touch": false}' href="javascript:;">
                <i class="fas fa-question-circle" aria-hidden="true"></i>

                <span>Technical Support</span>
            </a>
                </li>
                
            </ul>
        </div>
    </div>
    
    