<?php
    include 'head.php'; //Includes universal header.
?>
<link rel='stylesheet' href='styles/index.css'>
<?php
if(isset($_SESSION['u_id']))
{
    echo "<script>location.href='../today/';</script>";
}
//we can redirect faster than this method
?>
</head>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
  <div class="container">
    <main class='content-wrapper'>
      <section class='hero-wrapper fullwidth'>
        <div class='hero'>
          <h1 id='title'>AcaNotes</h1>
        <p>The ultimate online note-sharing platform designed specifically for IB students. </p>
        </div>
        <br/>
        <br/>
        <br/>
        <center>
          <div>
              <img src="/images/topics/topic-0.png" style = "width: 150pt; height: 150pt;">
              <img src="/images/topics/topic-1.png" style = "width: 150pt; height: 150pt;">
              <img src="/images/topics/topic-2.png" style = "width: 150pt; height: 150pt;">
              <img src="/images/topics/topic-3.png" style = "width: 150pt; height: 150pt;">
          </div>
          <div>
              <img src="/images/topics/topic-4.png" style = "width: 150pt; height: 150pt;">
              <img src="/images/topics/topic-5.png" style = "width: 150pt; height: 150pt;">
              <img src="/images/topics/topic-6.png" style = "width: 150pt; height: 150pt;">
              <img src="/images/topics/topic-7.png" style = "width: 150pt; height: 150pt;">
          </div>
        </center>
      </section>
      <section class='point'>
        <h2 class='title'>Students for students.</h2>
        <p> AcaNotes is a resource that provides IB students with course notes from credible sources. Dedicated to help you achieve optimal results, we value your success over anything else. Here at AcaNotes, every student is a priority.
        </p>
        <center>
          <img src='images/mascot.png' style = 'width:250pt; height:250pt;'/>
        </center>
      </section>
      <section class='point'>
        <h2 class='title'>We are directed at IB</h2>
        <p>Unlike Gradesaver or Litcharts, we are directed at the IB curriculum, with our resources coming straight from IB students who have exceled under the IB curriculum.
        </p>
      </section>
      <section class='fullwidth'>
        <div id='signupSection'>
          <h2 id='signup-title'>What are you waiting for?</h2>
        <a href='/registration/' clear id='signup-button-link'><button id='signup-button' class='btn-filled mdc-button mdc-button--unelevated'>Sign up now</button></a>
          <svg data-v-29945dff="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 317" class="bottom-background"><path data-v-29945dff="" fill="#E6F2F2" fill-rule="evenodd" d="M1901 317H.641c.292-54.578.292-93.755 0-117.53-.337-27.454-1.257-87.015 0-113.696.376-7.976-1.449-13.052 0-13.406 55.706-13.617 219.471 29.378 325.028 29.378 65.455 0 121.96-27.993 233.27-43.43 65.649-9.105 147.517 13.754 206.073 0 46.854-11.006 114.3-35.962 165.944-47.187 51.644-11.226 96.947 8.556 178.729 8.556 44.786 0 125.568-40.685 234.339-40.685 108.77 0 207.207 101.184 293.34 79.316 54.998-13.964 142.877-9.28 263.636 14.052V317z"></path></svg>
        </div>
      </section>
    </main>
  </div>
<?php 
    include 'footer.php'; //Includes universal footer.
?>


<!-- DB -->
<!--?php
    session_start();
  // $connect = mysql_connect("","","");  
?-->