<!DOCTYPE html>
<html>
  <head>
    <title>
      Contapp | Register
    </title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
    <link rel="stylesheet" href="font-awesome-4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/style.css"/>
  </head>
  <body>
    <div id="content">
      <div>
        <a class="pure-button signin" href="login.php">
        <i class="fa fa-sign-in fa-2x">
        </i>
        <span>
        Sign in
        </span>
        </a>
        <h1>
          Register
        </h1>
      </div>
      <div class="clearer">
      </div>
      <form id="register" class="pure-form pure-form-aligned" action="register.php" method="post" >
        <fieldset>
          <div class="pure-control-group">
            <label for="username">
            Username
            </label>
            <input id="username" name="username" type="text" placeholder="Username" autofocus>
          </div>
          <div class="pure-control-group">
            <label for="password">
            Password
            </label>
            <input id="password" name="password" type="password" placeholder="Password">
          </div>
          <div class="pure-control-group">
            <label for="password2">
            Password again
            </label>
            <input id="password2" name="password2" type="password" placeholder="Password">
          </div>
          <div class="pure-controls">
            <div class="errormsg">
              <?php if(isset($results['message'])) echo $results['message'] ?>
            </div>
          </div>
          <div class="pure-controls">
            <button type="submit" class="pure-button pure-button-primary" value="Register" name="register">
            Submit
            </button>
          </div>
        </fieldset>
      </form>
    </div>
  </body>
</html>