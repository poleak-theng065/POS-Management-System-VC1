<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$errors = $_SESSION['errors'] ?? [];
?>


<style>
  * {
  padding: 0;
  margin: 0;
  color: #1a1f36;
  box-sizing: border-box;
  word-wrap: break-word;
  font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;
}
body {
    min-height: 100vh;
    background-color: #ffffff;
    overflow: hidden;
}
h1 {
    letter-spacing: -1px;
}
a {
  color: #5469d4;
  text-decoration: unset;
}
.login-root {
    background: #fff;
    display: flex;
    width: 95%;
    /* min-height: 50vh; */
    position: relative;
    bottom: 50px;
    overflow: hidden;
}
.loginbackground {
    min-height: 692px;
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    top: 0;
    z-index: 0;
    overflow: hidden;
}
.flex-flex {
    display: flex;
}
.align-center {
  align-items: center; 
}
.center-center {
  align-items: center;
  justify-content: center;
}
.box-root {
    box-sizing: border-box;
}
.flex-direction--column {
    -ms-flex-direction: column;
    flex-direction: column;
}
.loginbackground-gridContainer {
    display: grid;
    grid-template-columns: [start] 1fr [left-gutter] repeat(16, 86.6px) [left-gutter] 1fr [end];
    grid-template-rows: [top] 1fr [top-gutter] repeat(10, 64px) [bottom-gutter] 1fr [bottom];
    justify-content: center;
    margin: 0 -3%;
    transform: rotate(-12deg) skew(-12deg);
}

.box-divider--light-all-2 {
    box-shadow: inset 0 0 0 2px #e3e8ee;
}
.box-background--blue {
    background-color: #5469d4;
}
.box-background--white {
  background-color: #ffffff; 
}
.box-background--blue800 {
    background-color: #212d63;
}
.box-background--gray100 {
    background-color: #e3e8ee;
}
.box-background--cyan200 {
    background-color: #7fd3ed;
}
.padding-top--64 {
  padding-top: 64px;
}
.padding-top--24 {
  padding-top: 24px;
}
.padding-top--48 {
  padding-top: 48px;
}
.padding-bottom--24 {
  padding-bottom: 24px;
}
.padding-horizontal--48 {
  padding: 48px;
}
.padding-bottom--15 {
  padding-bottom: 15px;
  position: relative;
  bottom:50px;
  left:70px;
  bottom: 64px;
}


.flex-justifyContent--center {
  -ms-flex-pack: center;
  justify-content: center;
}

.formbg {
  position: relative;
  right:80px;
    margin: 0px auto;
    width: 100%;
    max-width: 448px;
    background: white;
    border-radius: 4px;
    box-shadow: rgba(60, 66, 87, 0.12) 0px 7px 14px 0px, rgba(0, 0, 0, 0.12) 0px 3px 6px 0px;
}
span {
    display: block;
    font-size: 20px;
    line-height: 28px;
    color: #1a1f36;
}
label {
    margin-bottom: 10px;
}
.reset-pass a,label {
    font-size: 14px;
    font-weight: 600;
    display: block;
}
.reset-pass > a {
    text-align: right;
    margin-bottom: 10px;
}
.grid--50-50 {
    display: grid;
    grid-template-columns: 50% 50%;
    align-items: center;
}

.field input {
    font-size: 16px;
    line-height: 28px;
    padding: 8px 16px;
    width: 100%;
    min-height: 44px;
    border: unset;
    border-radius: 4px;
    outline-color: rgb(84 105 212 / 0.5);
    background-color: rgb(255, 255, 255);
    box-shadow: rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                rgba(60, 66, 87, 0.16) 0px 0px 0px 1px, 
                rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                rgba(0, 0, 0, 0) 0px 0px 0px 0px;
}

input[type="submit"] {
    background-color: rgb(84, 105, 212);
    box-shadow: rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                rgba(0, 0, 0, 0.12) 0px 1px 1px 0px, 
                rgb(84, 105, 212) 0px 0px 0px 1px, 
                rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                rgba(60, 66, 87, 0.08) 0px 2px 5px 0px;
    color: #fff;
    font-weight: 600;
    cursor: pointer;
}
.field-checkbox input {
    width: 20px;
    height: 15px;
    margin-right: 5px; 
    box-shadow: unset;
    min-height: unset;
}
.field-checkbox label {
    display: flex;
    align-items: center;
    margin: 0;
}
a.ssolink {
    display: block;
    text-align: center;
    font-weight: 600;
}
.footer-link span {
    font-size: 14px;
    text-align: center;
}
.listing a {
    color: #697386;
    font-weight: 600;
    margin: 0 10px;
}

.animationRightLeft {
  animation: animationRightLeft 0s ease-in-out infinite;
}
.animationLeftRight {
  animation: animationLeftRight 0s ease-in-out infinite;
}
.tans3s {
  animation: animationLeftRight 0s ease-in-out infinite;
}
.tans4s {
  animation: animationLeftRight 0s ease-in-out infinite;
}

.field span ,a{
  text-align: center;
  font-size: 17px;
}

@keyframes animationLeftRight {
  0% {
    transform: translateX(0px);
  }
  50% {
    transform: translateX(1000px);
  }
  100% {
    transform: translateX(0px);
  }
} 

@keyframes animationRightLeft {
  0% {
    transform: translateX(0px);
  }
  50% {
    transform: translateX(-1000px);
  }
  100% {
    transform: translateX(0px);
  }
} 
</style>

<!-- Content -->
<html>
<head>
  <meta charset="utf-8">
  <title>Stackfindover: Sign in</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <div class="login-root">
    <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
      <div class="loginbackground box-background--white padding-top--64">
        <div class="loginbackground-gridContainer">
          <div class="box-root flex-flex" style="grid-area: top / start / 8 / end;">
            <div class="box-root" style="background-image: linear-gradient(white 0%, rgb(247, 250, 252) 33%); flex-grow: 1;">
            </div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 4 / 2 / auto / 5;">
            <div class="box-root box-divider--light-all-2 animationLeftRight tans3s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 6 / start / auto / 2;">
            <div class="box-root box-background--blue800" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 7 / start / auto / 4;">
            <div class="box-root box-background--blue animationLeftRight" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 8 / 4 / auto / 6;">
            <div class="box-root box-background--gray100 animationLeftRight tans3s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 2 / 15 / auto / end;">
            <div class="box-root box-background--cyan200 animationRightLeft tans4s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 3 / 14 / auto / end;">
            <div class="box-root box-background--blue animationRightLeft" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 4 / 17 / auto / 20;">
            <div class="box-root box-background--gray100 animationRightLeft tans4s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 5 / 14 / auto / 17;">
            <div class="box-root box-divider--light-all-2 animationRightLeft tans3s" style="flex-grow: 1;"></div>
          </div>
        </div>
      </div>
      <div class="box-root padding-top--24 flex-flex flex-direction--column align-center center-center" style="flex-grow: 1; z-index: 9; max-width: 448px; margin: auto;">
        <div class="formbg-outer">
          <div class="formbg">
        <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
          <h1>Account Login</h1>
        </div>
        <div class="formbg-inner padding-horizontal--48">
          <span class="padding-bottom--15">Sign in to your account</span>
          <!-- FROM LOGIN -->
          <form action="/login/submit" method="post" id="stripe-login">
            <div class="field padding-bottom--24">
              <label for="email">Email</label>
              <input type="email" name="email">
              <?php if (isset($errors["email"])) : ?>
                <div class="error"><?= $_SESSION['errors']['email'] ?></div>
              <?php endif; ?>
            </div>
            <div class="field padding-bottom--24">
          <div class="grid--50-50">
            <label for="password">Password</label>
            <div class="reset-pass">
              <a href="/forgot-password">Forgot your password?</a>
            </div>
          </div>
          <input type="password" name="password">
          <?php if (isset($errors["password"])) : ?>
            <div class="error"><?= $_SESSION['errors']['password'] ?></div>
          <?php endif; ?>
          </div>
            <div class="field field-checkbox padding-bottom--24 flex-flex align-center">
          <label for="checkbox">
            <input type="checkbox" name="checkbox" id="show-pwd"> Show Password
          </label>
            </div>
            <div class="field padding-bottom--24">
          <input type="submit" name="submit" value="Login">
            </div>
            <div class="field">
          <span>Don't have an account? <a href="">Create New Account</a></span>
          <!-- <a class="ssolink" href="#">Use single sign-on (Google) instead</a> -->
            </div>
          </form>
        </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<script>
    document.addEventListener("DOMContentLoaded", function () {
      var navbar = document.getElementById("layout-navbar");
      var sidebar = document.getElementById("layout-menu");
      if (navbar) navbar.style.display = "none"; // Hide navbar if it exists
      if (sidebar) sidebar.style.display = "none"; // Hide sidebar if it exists
    });
    
    const showPwd = document.getElementById("show-pwd");
    const passwordInput = document.querySelector('input[name="password"]');
    showPwd.addEventListener("change", function () {
      if (showPwd.checked) {
        passwordInput.setAttribute("type", "text");
      } else {
        passwordInput.setAttribute("type", "password");
      }
    });
</script>

<?php
unset($_SESSION['errors']);
unset($_SESSION['old_email']);
?>