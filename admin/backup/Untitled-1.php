<form action="#" method="POST" class="row g-3 needs-validation register card-body" novalidate>
<div class="col-md-6">
    <label for="first_name" class="form-label">First name</label>
    <input type="text" class="form-control" id="first_name" placeholder="First Name" required>
</div>
<div class="col-md-6">
    <label for="last_name" class="form-label">Last name</label>
    <input type="text" class="form-control" id="last_name" placeholder="Last Name" required>
</div>

<!-- email -->
<div class="col-md-6">
    <label for="validationCustom06" class="form-label">Email</label>
    <input type="email" class="form-control" id="validationCustom06" placeholder="Email" required>
    <div class="invalid-feedback">
        Please provide a valid city.
    </div>
</div>
<div class="col-md-6">
    <label for="role" class="form-label">Role</label>
    <select class="form-select" id="role" required>
        <option selected disabled value="">Choose...</option>
        <option>Doctor</option>
        <option>Councilor</option>
        <option>Patient</option>
    </select>
    <div class="invalid-feedback">
        Please select country.
    </div>
</div>


<!-- gender  -->
<div class="col-md-6">
    <div class="gender-container">
        <label for="gender" class="form-label">Gender</label>
        <div class="row ms-0">
            <div class="form-check col-4">
                <input class="form-check-input" type="radio" required name="flexRadioDefault" id="male">
                <label class="form-check-label" for="male">
                    Male
                </label>
            </div>
            <div class="form-check col-4">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="female">
                <label class="form-check-label" for="female">
                    Female
                </label>
            </div>
            <div class="form-check col-4">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="other">
                <label class="form-check-label" for="other">
                    Other
                </label>
            </div>
        </div>
    </div>
</div>

<!-- date of birth  -->
<div class="col-md-6">
    <label for="dob" class="form-label">Date Of Birth</label>
    <input type="date" class="form-control" id="dob" required>
    <div class="invalid-feedback">
        Please provide a valid date of birth.
    </div>
</div>


<!-- password section  -->
<div class="col-md-6">
    <label for="password" class="form-label">Password</label>
    <div class="input-group has-validation">
        <input type="password" class="form-control" name="pass" minlength="8" id="password" aria-describedby="inputGroupPrepend" placeholder="Password" required>
        <div class="invalid-feedback">
            Please choose a strong password.
        </div>
    </div>
</div>
<div class="col-md-6">
    <label for="confirm_pass" class="form-label">Confirm Password</label>
    <div class="input-group has-validation">
        <input type="password" class="form-control" id="confirm_pass" aria-describedby="inputGroupPrepend" placeholder="Confirm Password" required>
        <div class="invalid-feedback">
            Please choose a strong password.
        </div>
    </div>
</div>

<!-- Contact and country  -->
<div class="col-md-6">
    <label for="validationCustom04" class="form-label">Country</label>
    <select class="form-select" id="validationCustom04" required>
        <option selected disabled value="">Choose...</option>
        <option>Bangladesh</option>
    </select>
    <div class="invalid-feedback">
        Please select country.
    </div>
</div>

<div class="col-md-2">
    <label for="country" class="form-label">Code</label>
    <select class="form-select" id="validationCustom04" required>
        <option selected disabled value="">Choose...</option>
        <option>+880</option>
    </select>
    <div class="invalid-feedback">
        Please select a valid phone code.
    </div>
</div>

<div class="col-md-4">
    <label for="country" class="form-label">Phone</label>
    <input type="text" class="form-control" id="country" placeholder="" required>
    <div class="invalid-feedback">
        Please provide a valid contact number.
    </div>
</div>



<!-- address info  -->
<div class="col-md-6">
    <label for="address_" class="form-label">Address</label>
    <input type="text" class="form-control" id="address_" aria-describedby="validationServer03Feedback" required>
    <div id="validationServer03Feedback" class="invalid-feedback">
        Please provide a valid address.
    </div>
</div>
<div class="col-md-3">
    <label for="city_" class="form-label">City</label>
    <select class="form-select " id="city_" aria-describedby="validationServer04Feedback" required>
        <option selected disabled value="">Choose...</option>
        <option>...</option>
    </select>
    <div id="validationServer04Feedback" class="invalid-feedback">
        Please select your city.
    </div>
</div>
<div class="col-md-3">
    <label for="zip_" class="form-label">Zip</label>
    <input type="text" class="form-control" id="zip_" aria-describedby="validationServer05Feedback" required>
    <div id="validationServer05Feedback" class="invalid-feedback">
        Please provide a valid zip.
    </div>
</div>



<div class="col-12">
    <div class="form-check m-auto">
        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
        <label class="form-check-label" for="invalidCheck">
            Agree to terms and conditions
        </label>
        <div class="invalid-feedback">
            You must agree before submitting.
        </div>
    </div>
</div>
<div class="col-12 d-grid">
    <button class="btn btn-primary" type="submit">Register Now</button>
</div>
</form>