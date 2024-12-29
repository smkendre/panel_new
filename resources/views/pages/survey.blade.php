@extends('auth.app')

@section('content')

<div class="suravyformbg">
                
    <div class="suravyform1main">
        <h3>Virtual Conference - Survey Form <span>This survey is only applicable to the registered users of Virtual Conference</span></h3>
        <h4>Identify Yourself</h4>
        <form method="get" action="">
            <div class="suravyform1colwrap">
                <div class="suravyform1col1">
                    <label>Email Id:</label> <input type="text" name="email" required>
                </div>
                <div class="suravyform1col2"><button type="submit" class="button">Submit</button></div>
            </div>
            <p>Please use the same Email Id, that you have used to login to the Virtual Conference for an easy access</p>
            <p>Email Id is not registered as an attendee for the virtual conference, please enter the same email id you used at the time of registration/login to the virtual conference.</p>
        </form>
    </div>
    
    <div class="suravyform2main">
        <h4>Identify Yourself</h4>
        <form id="sabha-survey" name="sabha-survey">
            <input type="hidden" id="forms" name="forms" value="survey-oracle-remodel">
            
            <div class="suravyform2wrap1">
                <div class="suravyform2wrap1box1">
                    <label>Name:</label> <input type="text" id="name" name="name" disabled value="">
                   <input type="hidden" name="name" value="">
                </div>
                <div class="suravyform2wrap1box1">
                    <label>Registered Email Id:</label> <input type="text" id="email" name="email" disabled value="">
                   <input type="hidden" name="email" value="">
                </div>
                <div class="suravyform2wrap1box1">
                    <label>Company Name:</label> <input type="text" id="cname" name="cname" disabled value="">
                   <input type="hidden" name="cname" value="">
                </div>
            </div>
            
            <div class="suravyform2wrap1">
                <div class="suravyform2wrap1box2">
                    <label>(1) Are you planning to implement contactless citizen services in COVID/Post COVID era? </label>
                    <label id="rd_contactless-error" class="error" for="rd_contactless"></label>
                    <div id="div-noplan" class="survaytextformnormal">
                        <label class="radiobtn1">Yes
                            <input type="radio" name="rd_contactless" value="Yes">
                            <span class="radiocheckmark1"></span>
                        </label>
                        <label class="radiobtn1">No
                            <input type="radio" name="rd_contactless" value="No">
                            <span class="radiocheckmark1"></span>
                        </label>
                    </div>
                    <label id="reasonerror" tabindex="1"></label>
                </div>
                
            </div>
            
            <div class="suravyform2wrap1">
                <div class="suravyform2wrap1box2">
                    <label>(2)  Which Digital Technologies are you using/planning to use in New Normal?</label>
                    <label id="chk_newnormal-error" class="error" for="chk_newnormal"></label>
                    <div class="survaytextformnormal">
                        <label class="checkbox1">Remote working- Cloud Computing (Deployed/ Considering deploying)
                          <input type="checkbox" class="cl_expectations" name="chk_newnormal[]" value="Remote working- Cloud Computing (Deployed/ Considering deploying)">
                          <span class="checkboxmark1"></span>
                        </label>
                        <label class="checkbox1">Advanced Analytics
                          <input type="checkbox" class="cl_expectations" name="chk_newnormal[]" value="Advanced Analytics">
                          <span class="checkboxmark1"></span>
                        </label>
                        <label class="checkbox1">Artificial Intelligence & Machine Learning
                          <input type="checkbox" class="cl_expectations" name="chk_newnormal[]" value="Artificial Intelligence & Machine Learning">
                          <span class="checkboxmark1"></span>
                        </label>
            <label class="checkbox1">Blockchain/Digital Ledger Technology
                          <input type="checkbox" class="cl_expectations" name="chk_newnormal[]" value="Blockchain/Digital Ledger Technology">
                          <span class="checkboxmark1"></span>
                        </label>
                    </div>
                    <label id="reasonerror" tabindex="1"></label>
                </div>
                
            </div>
            
            <div class="suravyform2wrap1">
                <div class="suravyform2wrap1box2">
                    <label>(3)  Where are you in your journey to the cloud?</label>
                    <label id="rd_journey-error" class="error" for="rd_journey"></label>
                    <div class="survaytextformnormal">
                        <div id = "div-noplan">
                            <label class="radiobtn1">Already on cloud
                              <input type="radio" name="rd_journey" value="Already on cloud">
                              <span class="radiocheckmark1"></span>
                            </label>
                            <label class="radiobtn1">In the process of migrating to cloud
                              <input type="radio" name="rd_journey" value="In the process of migrating to cloud">
                              <span class="radiocheckmark1"></span>
                            </label>
                            <label class="radiobtn1">Considering moving to cloud
                              <input type="radio" name="rd_journey" value="Considering moving to cloud">
                              <span class="radiocheckmark1"></span>
                            </label>
                <label class="radiobtn1">No plans to move to cloud
                              <input type="radio" id="journey_noplan" name="rd_journey" value="No plans to move to cloud">
                              <span class="radiocheckmark1"></span>
                            </label>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <div class="suravyform2wrap1">
                <div class="suravyform2wrap1box2">
                    <label>(4)  If you intend to move to the cloud, what timeframe are you looking at?</label>
                    <label id="rd_timeframe-error" class="error" for="rd_timeframe"></label>
                    <div class="survaytextformnormal">
                        <label class="radiobtn1">Immediately
                            <input type="radio" name="rd_timeframe" value="Immediately">
                            <span class="radiocheckmark1"></span>
                        </label>
                        <label class="radiobtn1">In 1-3 months
                            <input type="radio" name="rd_timeframe" value="In 1-3 months">
                            <span class="radiocheckmark1"></span>
                        </label>
                        <label class="radiobtn1">In 3-6 months
                            <input type="radio" name="rd_timeframe" value="In 3-6 months">
                            <span class="radiocheckmark1"></span>
                        </label>
                        <label class="radiobtn1">In 6-9 months
                            <input type="radio" name="rd_timeframe" value="In 6-9 months">
                            <span class="radiocheckmark1"></span>
                        </label>
                        <label class="radiobtn1">In 9-12 months
                            <input type="radio" name="rd_timeframe" value="In 9-12 months">
                            <span class="radiocheckmark1"></span>
                        </label>
                    </div>
                </div>
                
            </div>
            
            <div class="suravyform2wrap1">
                <div class="suravyform2wrap1box2">
                    <label>(5)  Which specific cloud service would you be interested</label>
                    <label id="chk_interested-error" class="error" for="chk_interested"></label>
                    <div class="survaytextformnormal">
                        <label class="checkbox1">Moving workloads to cloud
                            <input type="checkbox" class="cl_expectations" name="chk_interested[]" value="Moving workloads to cloud">
                            <span class="checkboxmark1"></span>
                        </label>
                        <label class="checkbox1">Autonomous Services
                            <input type="checkbox" class="cl_expectations" name="chk_interested[]" value="Autonomous Services">
                            <span class="checkboxmark1"></span>
                        </label>
                        <label class="checkbox1">Cloud native
                            <input type="checkbox" class="cl_expectations" name="chk_interested[]" value="Cloud native">
                            <span class="checkboxmark1"></span>
                        </label>
                        <label class="checkbox1">Exadata
                            <input type="checkbox" class="cl_expectations" name="chk_interested[]" value="Exadata">
                            <span class="checkboxmark1"></span>
                        </label>
                    </div>
                    <label id="reasonerror" tabindex="1"></label>
                </div>
                
            </div>
            
            <div class="suravyform2wrap1">
                <div class="suravyform2wrap1box2">
                    <label>(6)  We would like to have a detailed discussion with you based on your responses. How would you like us to connect with you? Please respond appropriately</label>
                    <label id="chk_connect-error" class="error" for="chk_connect"></label>
                    <div class="survaytextformnormal">
                        <label class="checkbox1">Virtual meeting
                            <input type="checkbox" name="chk_connect[]" value="Virtual meeting">
                            <span class="checkboxmark1"></span>
                        </label>
                        <label class="checkbox1">Phone Call
                            <input type="checkbox" name="chk_connect[]" value="Phone Call">
                            <span class="checkboxmark1"></span>
                        </label>
                        <label class="checkbox1">Need more information
                            <input type="checkbox" name="chk_connect[]" value="Need more information">
                            <span class="checkboxmark1"></span>
                        </label>
                        <label class="checkbox1">Any Other
                            <input type="checkbox" id="chk_other" name="chk_connect[]" value="Any Other">
                            <span class="checkboxmark1"></span>
                        </label>
                        <label class="othercheckinput">
                            <input type="text" id="others" placeholder="Please Specify" name="others">
                        </label>
                    </div>
                    <label id="providererror" tabindex="1"></label>
                </div>
                
            </div>
            
            <div class="suravyform2wrap1">
                <div class="suravyform2wrap1box2">
                    <input type="checkbox" name="marketing"  id="marketing" value="Yes" >Yes, I would like Technology Sabha to provide my contact information to it's <strong><a href="sponsorship.php">Sponsors and Partners</a></strong> and they may contact me via email, phone or post to keep me updated about latest news & information, products & services as well as events & webinars.
                    <span id="errorToShow"></span>
                    </div>
                    <label id="providererror" tabindex="1"></label>
                </div>
            
            <button type="submit" id="submit" name="submit">Submit</button>
            
            
        </form>
    </div>
    
</div>


@endsection