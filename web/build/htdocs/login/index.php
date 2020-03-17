<?php
    include $_SERVER['DOCUMENT_ROOT'].'/head.php';
?>
<link rel="stylesheet" href="/styles/login/index.css">
</head>
<body>
  <?php
    include $_SERVER['DOCUMENT_ROOT'].'/header.php';
?>
<div class='container'>
  <main class='content-wrapper'>
    <div>
      
   <?php if ($_GET['user'] == 'true') { ?>
   <br/>
   <br/>
   <br/>
   <center>
    <p style='color:#fa755a;'>Sorry, you need to log in to view this page.</p>
   </center>

   
    <?php } ?>
      <form method='POST' action='/includes/login.inc.php' boxed class='login-form'>
        <h1 style='margin-bottom:25px;'>Login</h1>
         
        <input type='text' name='redirect' style='display:block;width:100%;margin-bottom:10px;display:none;' value='<?php echo $_GET['ref']; ?>'>
        <div>
          <label>Username</label>
        <input type='text' name='uid' style='display:block;width:100%;margin-bottom:10px;'>
        </div>
        <label>Password</label>
        <input class='inputtext' type='password' name='pwd' style='display:block;width:100%;margin-bottom:10px;'>
        <button type='submit' name='submit' class='mdc-button'>Submit</button>
      </form>
    </div>
  </main>
</div>
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>
</body>
</html