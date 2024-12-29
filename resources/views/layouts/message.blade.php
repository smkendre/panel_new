<div id="HirenMistry" class="popmain3">
    <div class="popmainheading">Send Messeges</div>
    <div class="popmain1con1">
        <div class="popupformmain1">
            <form id="sndFrm" name="sndFrm" method="POST" action="{{ route('emailconnect') }}" role="form">
                @csrf
                <input type="hidden" id="to_id" name="to_id" value="" />
                <input type="hidden" id="to_email" name="email" value="" />
                <input type="hidden" id="receiver_name" name="receiver_name" value="" />
                <div class="popupformmain1box">
                    <label>Subject</label>
                    <input type="text" maxlength="128" name="subject" id="subject" placeholder="Enter your Subject" required>
                </div>
                <div class="popupformmain1box">
                    <label>Messagee</label>
                    <textarea rows="5" cols="2" id="message" name="message" placeholder="Type message here..."></textarea>
                </div>
                <button type="submit" id="submit" name="submit" class="button">Send</button>
            </form>
        </div>
    </div>
</div>
