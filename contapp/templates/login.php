<!DOCTYPE html>
<html lang=en>
  <head>
    <title>Contacts</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
    <link rel="stylesheet" href="font-awesome-4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/style.css">
  </head>
  <body>
    <div id="content">
      <div>
        <a class="pure-button register" href="register.php">
        <i class="fa fa-paper-plane fa-2x" data-reactid=".0.0.0.0">
        </i>
        <span>
        Register
        </span>
        </a>
        <h1>
          Log in
        </h1>
      </div>
      <div class="clearer"></div>
      <form id="login" class="pure-form pure-form-aligned" action="login.php" method="post" >
        <fieldset>
          <div class="pure-control-group">
            <label for="username">Username</label>
            <input id="username" name="username" type="text" placeholder="Username" autofocus>
          </div>
          <div class="pure-control-group">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" placeholder="Password">
          </div>
          <div class="pure-controls">
            <div class="errormsg"><?php if(isset($results['message'])) echo $results['message'] ?></div>
          </div>
          <div class="pure-controls">
            <button type="submit" class="pure-button pure-button-primary" value="Login" name="login">Submit</button>
          </div>
        </fieldset>
      </form>
    </div>
  </body>
</html>