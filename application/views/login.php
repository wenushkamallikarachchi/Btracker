<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!doctype html>
<html lang="en">

<head>
    <title>Bookmark Tracker | Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="/w1673746cw2/assets/css/loginstyle.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="/w1673746cw2/assets/js/underscore.js"></script>
    <script type="text/javascript" src="/w1673746cw2/assets/js/backbone.js"></script>
</head>

<body background="/w1673746cw2/assets/img/hero.png">
    <h4 class="loginText" id="myBtn">login</h4>
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="loginBox">

            <div class="login-form">
                <form>
                    <br>
                    <!-- <h2 style="text-align: center;">Login</h2> -->
                    <p style="margin-left: 20px;">Please fill in this form to log in to the BTracker.</p>

                    <div class="form-group email">
                        <input type="email" class="form-control" id="email" placeholder="Email" required="required">
                    </div>
                    <br>
                    <div class="form-group password">
                        <input type="password" class="form-control" id="password" placeholder="Password" required="required">
                    </div>
                    <br> <br>
                    <div class="form-group loginBtBox">
                        <button type="submit" class="loginbtn" id="loginBtn">Login</button>
                    </div>
                </form>
                <br>
                <div class="signup">Don't have an account? <a href="/w1673746cw2/index.php/UserManager/signUp">Sign Up</a></div>
            </div>


        </div>

    </div>
    <script type="text/javascript" lang="javascript">
        var User = Backbone.Model.extend({
            url: '/w1673746cw2/index.php/?/api/Users/login'
        });




        $(document).ready(function() {
            var modal = document.getElementById("myModal");
            var btn = document.getElementById("myBtn");
            // When the user clicks on the button, open the modal
            var modalState = localStorage.getItem("isSuccessSignup")
            console.log(modalState)
            if (modalState) {
                modal.style.display = "block";
            }
            btn.onclick = function() {
                modal.style.display = "block";
            }



            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
            $("span.errorText").remove();

            $('#loginBtn').click(function(e) {
                e.preventDefault();
                let userEmail = $('#email').val();
                let userPassword = $('#password').val();
                console.log(userEmail);

                var isEmailValid, isPasswordValid;
                isEmailValid = isPasswordValid = true;

                if (userEmail === "") {
                    $('#email').after('<span style="color: #ff5349" class="errorText">Please enter the email!</span>');
                    isEmailValid = false;
                }
                if (userPassword === "") {
                    $('#password').after('<span style="color: #ff5349" class="errorText">Please enter the password!</span>');
                    isPasswordValid = false;
                }
                isSuccessValidation = (isEmailValid === true && isPasswordValid === true);

                if (isSuccessValidation) {
                    $("span.errorText").remove();
                    var signupUser = new User();

                    signupUser.set("email", userEmail);
                    signupUser.set("password", userPassword);

                    signupUser.save(null, {
                        async: false,
                        success: function(signupUser, response) {
                            var fullName = response.firstName + "  " + response.lastName
                            localStorage.setItem("username", fullName);
                            window.location = "/w1673746cw2/index.php/BookmarkManager";
                            console.log("Successfully logged in!");
                        },
                        error: function(signupUser, response) {
                            if (response.status === 401) {
                                $('#password').after('<span style="color: #ff5349" class="errorText">Password is incorrect!</span>');
                            }
                            if (response.status === 403) {
                                $('#password').after('<span style="color: #ff5349" class="errorText">Invalid login credentials!</span>');
                            }
                        }
                    })
                }


            });
        });
    </script>

</body>

</html>