<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">

<head>
    <title>Bookmark Tracker | Sign Up</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="/w1673746cw2/assets/css/signstyle.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="/w1673746cw2/assets/js/underscore.js"></script>
    <script type="text/javascript" src="/w1673746cw2/assets/js/backbone.js"></script>

</head>

<body style="background-color: #fedfce">
    <div class="signupBox">
        <div class="signup-form">
            <form>
                <h2 style="text-align: center;">Sign Up</h2>
                <p style="margin-left: 20px;">Please fill in this form to sign up to the BTracker.</p>

                <div class="form-group">
                    <div class="row">
                        <div class="col" style="margin-left: 10px;"><input type="text" class="form-control" id="fName" placeholder="First Name*" required="required"></div>
                        <div class="col" style="margin-right: 10px;"><input type="text" class="form-control" id="lName" placeholder="Last Name" required="required"></div>
                    </div>
                </div>
                <div class="form-group email">
                    <input type="email" class="form-control " id="email" placeholder="Email*" required="required">
                </div>
                <br>
                <div class="form-group email">
                    <input type="password" class="form-control" id="password" placeholder="Password*" required="required">
                </div>
                <br>
                <div class="form-group email">
                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required="required">
                </div>
                <br>
                <br>
                <div class="form-group loginBtBox">
                    <button type="submit" class="loginbtn" id="signUpButton">Sign Up</button>
                </div>
            </form>

            <div class="login">Already have an account? <a href="/w1673746cw2/index.php/UserManager">Login here</a></div>
        </div>
    </div>
    <script type="text/javascript" lang="javascript">
        var User = Backbone.Model.extend({
            url: '/w1673746cw2/index.php/?/api/Users/register'
        });


        $(document).ready(function() {
            $('#signUpButton').click(function(e) {
                e.preventDefault();

                var firstName = $('#fName').val();
                var lastName = $('#lName').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var confirmPassword = $('#confirmPassword').val();

                var isFirstNameValid, isEmailValid, isPasswordValid, isConfirmPassword, isSuccessValidation;
                isSuccessValidation = isFirstNameValid = isEmailValid = isPasswordValid = isConfirmPassword = true;

                $("span.errorText").remove();

                if (firstName === "") {
                    $('#fName').after('<span style="color: #ff5349" class="errorText">Please enter the first name!</span>');
                    isFirstNameValid = false;
                }
                if (email === "") {
                    $('#email').after('<span style="color: #ff5349" class="errorText">Please enter the email!</span>');
                    isEmailValid = false;
                } else {
                    var regex = /\S+@\S+\.\S+/;
                    var patternValid = regex.test(email);
                    if (!patternValid) {
                        $('#email').after('<span style="color: #ff5349" class="errorText">Enter a valid email address!</span>');
                        isEmailValid = false;
                    }
                }
                if (password === "") {
                    $('#password').after('<span style="color: #ff5349" class="errorText">Please enter the password!</span>');
                    isPasswordValid = false;
                }
                if (confirmPassword === "") {
                    $('#confirmPassword').after('<span style="color: #ff5349" class="errorText">Please enter the confirm password!</span>');
                    isConfirmPassword = false;

                } else if (!(password === confirmPassword)) {
                    $('#confirmPassword').after('<span style="color: #ff5349" class="errorText">Passwords did not match Try again!</span>');
                    isConfirmPassword = false;
                }

                isSuccessValidation = !(isFirstNameValid === false || isEmailValid === false || isPasswordValid === false || isConfirmPassword === false);
                console.log("Is Sign up Form Valid: " + isSuccessValidation);

                if (isSuccessValidation) {
                    console.log("getting inputs values ")

                    let firstName = $('#fName').val();
                    let lastName = $('#lName').val();
                    let email = $('#email').val();
                    let password = $('#password').val();

                    var newUser = new User;
                    console.log("setting inputs to DB fields ");

                    newUser.set("firstName", firstName);
                    newUser.set("lastName", lastName);
                    newUser.set("email", email);
                    newUser.set("password", password);

                    newUser.save(null, {
                        async: false,
                        success: function(newUser, response) {
                            window.location = "/w1673746cw2/index.php/UserManager";
                            localStorage.setItem("isSuccessSignup", true);
                            console.log("added user pass");
                        },

                        error: function(newUser, response) {
                            if (response.status === 406) {
                                $('#confirmPassword').after('<span style="color: #ff5349" class="errorText">This Email address is already exists!</span>');
                            } else {
                                $('#confirmPassword').after('<span style="color: #ff5349" class="errorText">Server Error. Please Try again!</span>');
                            }
                        }
                    })
                }

            });
        });
    </script>

</body>

</html>