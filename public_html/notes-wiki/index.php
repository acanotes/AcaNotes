<?php
    include $_SERVER['DOCUMENT_ROOT'].'/notes-wiki/header-notes-wiki.php';
    
    if(isset($_SESSION['u_id'])){
      
    }
    else
    {
      
    }
?>
<style>
  .button-topic img
  {
    max-width: 200px;
    width: 20%;
  }
</style>
<center>
  <br>
  <h1>Notes Wiki</h1>
  <br>
  <div>
    <a class="button-topic">
      <img src="/images/topics/topic-0.png"></img>
    </a>
    <a class="button-topic">
      <img src="/images/topics/topic-1.png"></img>
    </a>
    <a class="button-topic">
      <img src="/images/topics/topic-2.png"></img>
    </a>
    <a class="button-topic">
      <img src="/images/topics/topic-3.png"></img>
    </a>
  </div>
  <div>
    <a class="button-topic">
      <img src="/images/topics/topic-4.png"></img>
    </a>
    <a class="button-topic">
      <img src="/images/topics/topic-5.png"></img>
    </a>
    <a class="button-topic">
      <img src="/images/topics/topic-6.png"></img>
    </a>
    <a class="button-topic">
      <img src="/images/topics/topic-7.png"></img>
    </a>
  </div>
</center>

<div>
  <p style="font-size:30pt;">Create a note</p>
  <br>
  <form method="POST" action="/notes-wiki/upload.php">
    Title:
    <p></p>
    <input type="text" style="color:black;">
    <br>
    <br>
    Select a class:
    <p></p>
    <select>
      <option value="select">Select a class</option>
      <optgroup label="Core IB">
        <option>Theory of knowledge</option>
      </optgroup>
      <!--
      <optgroup label="Non IB">
        <option>Codelympians/Computer Science</option>
        <option>Band and Orchestra</option>
        <option>Service Groups</option>
        <option>None-Computer-Science STEM Clubs</option>
        <option>Time Management and Wellness</option>
      </optgroup>
      -->
      <optgroup label="Group 1: Language and Literature">
        <option>English A Lang & Lit</option>
        <option>English A Literature</option>
        <option>Chinese A Lang & Lit</option>
      </optgroup>
      <optgroup label="Group 2: Language Acquisition">
        <option>Chinese B</option>
        <option>French B</option>
        <option>Spanish B</option>
        <option>English B</option>
        <option>Chinese AB initio</option>
        <option>French AB initio</option>
        <option>Spanish AB initio</option>
      </optgroup>
      <optgroup label="Group 3: Individuals and Societies">
        <option>Economics</option>
        <option>Geography</option>
        <option>Global Politics</option>
        <option>History</option>
        <option>Psychology</option>
        <option>ITGS</option>
        <option>Business and Management</option>
        <option>Philosophy</option>
      </optgroup>
      <optgroup label="Group 4: Sciences">
        <option>Physics</option>
        <option>Chemistry</option>
        <option>Biology</option>
        <option>Environmental Science</option>
        <option>Sports Science</option>
      </optgroup>
      <optgroup label="Group 5: Mathematics">
        <option>Math</option>
        <option>Math Studies</option>
      </optgroup>
      <optgroup label="Group 6: Arts">
        <option>Film</option>
        <option>Music</option>
        <option>Theatre</option>
        <option>Visual Arts</option>
      </optgroup>
      <optgroup label="Other">
        <option>Other</option>
      </optgroup>
    </select>
    <br>
    
    <br>
    Choose a file:
    <p></p>
      <input type="file" style="color:black;" name="fileToUpload" id="fileToUpload">
    <br>
    
    <br>
      <input type="submit" style="color:black;" value="Next" name="submit">

  </form>
</div>

<?php

    include $_SERVER['DOCUMENT_ROOT'].'/footer.php';
    
?>