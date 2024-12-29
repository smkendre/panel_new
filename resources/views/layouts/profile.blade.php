<div id="editpopup" class="popmain1">
    <div class="popmainheading">Edit Profile</div>
    <div class="popmain1con1">
        <div class="popupformmain1">
            <div class="btn3 tar"><a data-fancybox data-src="#viewpopup"
                    data-options='{"touch": false, "smallBtn" : false}' href="javascript:;">View Profile</a></div>
            <form id="" name="" method="POST" action="{{ route('edit-profile') }}" role="form">
                @csrf

                <div class="popupformmain1box">
                    <div class="popupformmain1boxcol1">
                        <label>First Name</label>
                        <input type="text" maxlength="128" name="fname" id="fname" value="{{$user->au_fname}}" required>
                    </div>
                    <div class="popupformmain1boxcol2">
                        <label>Last Name</label>
                        <input type="text" maxlength="128" name="lname" id="lname" value="{{$user->au_lname}}" required>
                    </div>
                </div>

                <div class="popupformmain1box">
                    <div class="popupformmain1boxcol1">
                        <label>Email Address</label>
                        <input type="text" maxlength="128" name="email" id="email" value="{{$user->au_email}}" required>
                    </div>
                    <div class="popupformmain1boxcol2">
                        <label>Phone Number</label>
                        <input type="text" maxlength="128" name="phone" id="phone" value="{{$user->au_phone}}" required>
                    </div>
                </div>

                <div class="popupformmain1box">
                    <div class="popupformmain1boxcol1">
                        <label>Organization</label>
                        <input type="text" maxlength="128" name="organization" id="organization"
                            value="{{$user->au_company}}" required>
                    </div>
                    <div class="popupformmain1boxcol2">
                        <label>Job Title</label>
                        <input type="text" maxlength="128" name="job_title" id="job_title"
                            value="{{$user->au_job_title}}" required>
                    </div>
                </div>

                <div class="popupformmain1box">
                    <div class="popupformmain1boxcol1">
                        <label>Street Address</label>
                        <input type="text" maxlength="128" name="address" id="address" value="{{$user->au_address}}">
                    </div>
                    <div class="popupformmain1boxcol2">
                        <label>City</label>
                        <input type="text" maxlength="128" name="city" id="city" value="{{$user->au_city}}" required>
                    </div>
                </div>

                <div class="popupformmain1box">
                    <div class="popupformmain1boxcol1">
                        <label>Zip/Postal Code </label>
                        <input type="text" maxlength="6" name="zipCode" id="zipCode" value="{{$user->au_pincode}}">
                    </div>
                </div>

                <button type="submit" id="submit" name="submit" class="button">Save Details</button>
            </form>
        </div>

    </div>
</div>

<div id="viewpopup" class="popmain1">
    <div class="popmainheading">View Profile</div>
    <div class="popmain1con1">
        <div class="popupformmain1">
            <table class="table2">
                <tr>
                    <th>View Profile</th>
                    <th>
                        <div class="btn1 tar"><a data-fancybox data-src="#editpopup"
                                data-options='{"touch": false, "smallBtn" : false}' href="javascript:;">Edit Profile</a>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td>{{$user->au_fname}}</td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td>{{$user->au_lname}}</td>
                </tr>
                <tr>
                    <td>Email Address</td>
                    <td>{{$user->au_email}}</td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td>{{$user->au_phone}}</td>
                </tr>
                <tr>
                    <td>Organization</td>
                    <td>{{$user->au_company}}</td>
                </tr>
                <tr>
                    <td>Job Title</td>
                    <td>{{$user->au_job_title}}</td>
                </tr>
                <tr>
                    <td>Street Address</td>
                    <td>{{$user->au_address}}</td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>{{$user->au_city}}</td>
                </tr>
                <tr>
                    <td>Zip/Postal Code</td>
                    <td>{{$user->au_pincode}}</td>
                </tr> 
            </table>
        </div>
    </div>
</div>