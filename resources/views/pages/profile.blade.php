@extends('auth.app')

@section('content')
@csrf
<div class="innercontainwrapper">

    <div class="popmainheading"> Profile</div>
    <div class="popmain1con1">
        <div class="popupformmain1">
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
    
@endsection