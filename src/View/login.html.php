<!--//$loginService->loginform("loginformname", "loginformid", "src/Service/LoginService/form_action.php");-->

<form name="loginform" method="post" id="loginform" class="loginform"
      enctype="application/x-www-form-urlencoded" action="src/Service/LoginService/form_action.php">
<div><label for="username">Username</label>
<input name="username" id="username" type="text"></div>
<div><label for="password">Password</label>
<input name="password" id="password" type="password"></div>
<input name="action" id="action" value="login" type="hidden">
<div>
<input name="submit" id="submit" value="login" type="submit"></div>
</form>