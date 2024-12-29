
    <div id="requestameeting" class="popmain1">
      <div class="popmainheading">Request Meeting</div>
          <div class="popmain1con1">
              <div class="popupformmain1">
                <div class="requestmeetingmain">
                      <h2><span>Appointment with </span>
                        <select name="sponsor" id="sponsor">
                            <option value="Express Computer">Express Computer</option>
                          </select>
                      </h2>
                      <h6><i class="fas fa-clock"></i> 30 minutes</h6>
                      <h3>Select a Date & Time</h3>
                      <input id="datetimepicker3" type="text" style="display: none;" >
                      <button type="submit" data-fancybox data-src="#requestameetingform" onclick="$.fancybox.close()"
                      data-options='{"touch": false}' name="submit">Next</button>
  
                  </div>
              </div>
          </div>
      </div>
      
      <div id="requestameetingform" class="popmain1">
      <div class="popmainheading">Request Meeting</div>
          <div class="popmain1con1">
             <div class="popupformmain1">
             <form id="meetingFrm" name="meetingFrm" method="POST" action="" role="form">
          @csrf
                      <h6>You are requesting a 30 minutes meeting with <span  class="sponsor">Express Computer</span> on <span  id="selected_date">10-05-2021</span> at <span  id="selected_time">15:00</span> IST.</h6>
                      <h6><span>Express Computer</span> will contact you on <span><a href="#">{{session()->get('useremail')}}</a></span> or call you on <span>{{session()->get('userphone')}}</span>, in case you would like to add any additional contact details please provide the same in the message box below, along with any additional information like meeting agenda.</h6>
                      <div class="popupformmain1box">
            <label>Messagee</label>
            <textarea rows="5" cols="2" id="msg" name="msg" placeholder="Type message here..."></textarea>
            <input type="hidden" name="sp" id="sp" value="" />
            <input type="hidden" name="sdate" id="sdate" value="" />
            <input type="hidden" name="stime" id="stime" value="" />
          </div>
          <div class="btnWrapper">
            <button type="button" data-fancybox data-src="#requestameeting" onclick="$.fancybox.close()"
              data-options='{"touch": false}' name="submit">Back</button>
            <button type="submit" id="submit" name="submit" class="button">Send</button>
          </div>
                  </form>
             </div>
          </div>
      </div>
      
    