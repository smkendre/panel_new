<div id="poll" class="popmain3">
    <div class="popmainheading">Poll</div>
    <div class="popmain1con1">
        <div class="popupformmain3">
            <form id="pollFrm" name="pollFrm" method="POST" action="" role="form">
                @csrf
                <div class="popupformmain1box" id="poll-question">
                    <h6>Are you currently using a remote support solution to assist your organization’s needs?</h6>
                    <label class="radiobtn1">Yes – Happy with current solution
                        <input type="radio" name="poll_experience" value="Yes – Happy with current solution">
                        <span class="radiocheckmark1"></span>
                    </label>
                    <label class="radiobtn1">Yes – But exploring other solutions
                        <input type="radio" name="poll_experience" value="Yes – But exploring other solutions">
                        <span class="radiocheckmark1"></span>
                    </label>
                    <label class="radiobtn1">No – But, would like to understand more
                        <input type="radio" name="poll_experience" value="No – But, would like to understand more">
                        <span class="radiocheckmark1"></span>
                    </label>
                   
                </div>
                <button type="submit" id="submit" name="submit" class="button pollBtn">Submit</button>
                
            </form>
        </div>
    </div>
</div>
<div id="pollresult" class="popmain1">
    <div class="popmainheading">Poll Result</div>
    <div class="popmain1con1">
       
    <div id="chartContainer" style="height: 370px; width: 30%;"></div>
    </div>
</div>