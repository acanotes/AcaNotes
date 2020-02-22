<?php
session_start();
if(isset($_SESSION['u_id'])) {
  header("Location: ../today/");
  exit();
}
include $_SERVER['DOCUMENT_ROOT'].'/head.php';
   
?>
<link rel="stylesheet" href="/styles/registration/index.css">
</head>

<body>
  <?php include $_SERVER['DOCUMENT_ROOT'].'/header.php';?>
  <div class='container'>
    <main class='content-wrapper'>
      <h1>Register</h1>
      <form method='POST' action='../includes/signup.inc.php' boxed class='register-form'>
        <label>First Name</label>
        <input class='' type='text' name='first' style='color:black;'>
        <br/>
        <br/>
        <label>Last Name</label>
        <input class='' type='text' name='last' style='color:black;'>
        <br/>
        <br/>
        <label>Email</label>
        <input class='inputtext' type='text' name='email' style='color:black;'>
        <br/>
        <label>Username</label>
        <input class='inputtext' type='text' name='uid' style='color:black;'>
        <br/>
        <label>Password (at least 8 characters)</label>
        <input class='inputtext' type='password' name='pwd' style='color:black;'>
        <br/>
        <label>Confirm Password</label>
        <input class='inputtext' type='password' name='confirm_pwd' style='color:black;'>
        <br/>
        <button type='submit' name='submit' class='mdc-button'>Submit</button>
      </form>
    </main>
  </div>
</body>
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>