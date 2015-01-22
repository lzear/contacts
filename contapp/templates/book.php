<!DOCTYPE html>
<html>
  <head>
    <title>Contapp | Your contacts</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
    <link rel="stylesheet" href="font-awesome-4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/style.css">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/react/0.12.1/react.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/react/0.12.1/JSXTransformer.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/showdown/0.3.1/showdown.min.js"></script>
  </head>
  <body>
    <div id="content">
      <a class="pure-button signout" href="login.php">
      <i class="fa fa-sign-out fa-2x">
      </i>
      <span>
      Sign out
      </span>
      </a>
      <h1>
        Contact List
      </h1>
      <div class="clearer"></div>
      <div id="contactBox"></div>
    </div>
  </body>
  <script type="text/jsx;harmony=true" src="scripts/contacts.js"></script>
  <script type="text/jsx;harmony=true">
    React.render(
     <ContactBox url="actions.php"  />,
     document.getElementById('contactBox')
    );
  </script>
</html>