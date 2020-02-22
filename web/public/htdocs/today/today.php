<?php
    include $_SERVER['DOCUMENT_ROOT'].'/head.php';
?>
<style type="text/css">
    .horizontalMargin
    {
        margin-left: 16px;
        margin-right: 16px;
    }
    
    .todayViewContentRow
    {
        margin-left: 16px;
        margin-right: 16px;
        
        height: 160px;
    }
    
    .todayViewContentBox
    {
        margin-right: 16px;
        margin-top: 8px;
        margin-bottom: 8px;
        
        width: 256px;
        height: 144px;
        
        border-radius: 4px;
        background-color: #E0E0E0;
        overflow: hidden;
    }
    
    .todayViewContentBox h3
    {
        margin: 16px;
    }
</style>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
<h1 class="horizontalMargin">Today</h1>
<hr>
<h2 class="horizontalMargin">Suggested for you</h2>
<div class="todayViewContentRow">
    <br>
    <p>Suggestions will be generated once you start actions like liking, commenting, or posting. 
    These actions help the system learn about your interest and suggest content that you'll like.</p>
</div>
<hr>
<h2 class="horizontalMargin">What's new</h2>
<div class="todayViewContentRow">
    <div class="todayViewContentBox">
        <h3>How to prepare for the Math HL exam</h3>
    </div>
</div>
<hr>
<h2 class="horizontalMargin">What's trending</h2>
<div class="todayViewContentRow">
    <div class="todayViewContentBox">
        <h3>Romeo and Juliet: an analysis</h3>
        <!-- Do something to hide text that flows over 1 row -->
    </div>
</div>
<hr>
  </body>