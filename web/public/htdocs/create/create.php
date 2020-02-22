<body>
  <?php include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
  <div class='container'>
    <main class='content-wrapper'>
    <?php if (isset($_SESSION['u_id'])) {?>
    <div>
      <p style="font-size:30pt;">Create a note</p>
      <br>
      <form action="upload.php" method="POST" enctype="multipart/form-data" >
        Title:
        <p></p>
        <input type="text" style="color:black;" name="title" placeholder="title...">
        <br>
        <br>
        Select a class:
        <p></p>
        <select name="subject">
          <option value="select" >Select a class</option>
          <optgroup label="Core IB">
            <option value="TOK">Theory of Knowledge</option>
            <option value="EE">Extended Essay</option>
            <option value="CAS">CAS</option>
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
            <option value="English Lang Lit">English A Lang & Lit</option>
            <option value="English Lit">English A Literature</option>
            <option value="Chinese Lang Lit">Chinese A Lang & Lit</option>
          </optgroup>
          <optgroup label="Group 2: Language Acquisition">
            <option value="Chinese B">Chinese B</option>
            <option value="French B">French B</option>
            <option value="Spanish B">Spanish B</option>
            <option value="English B">English B</option>
            <option value="Chinese AB">Chinese AB initio</option>
            <option value="French AB">French AB initio</option>
            <option value="Spanish AB">Spanish AB initio</option>
          </optgroup>
          <optgroup label="Group 3: Individuals and Societies">
            <option value="Economics">Economics</option>
            <option value="Geography">Geography</option>
            <option value="Global Politics">Global Politics</option>
            <option value="History">History</option>
            <option value="Psychology">Psychology</option>
            <option value="ITGS">ITGS</option>
            <option value="Business and Mgmt">Business and Management</option>
            <option>Philosophy</option>
          </optgroup>
          <optgroup label="Group 4: Sciences">
            <option value="Physics">Physics</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Biology">Biology</option>
            <option value="ESS">Environmental Science</option>
            <option value="Sports Science">Sports Science</option>
          </optgroup>
          <optgroup label="Group 5: Mathematics">
            <option value="Math">Math</option>
            <option value="Computer Science">Computer Science</option>
            <option value="Math Studies">Math Studies</option>
          </optgroup>
          <optgroup label="Group 6: Arts">
            <option value="Film">Film</option>
            <option value="Music">Music</option>
            <option value="Theatre">Theatre</option>
            <option value="Visual Arts">Visual Arts</option>
          </optgroup>
          <optgroup label="Other">
            <option value="Other">Other</option>
          </optgroup>
        </select>
        <br>

        <br>
        Description:
        <p></p>
        <input name="description" type="text" name="description" placeholder="my note is about..." style="color: black">
        <br>

        <br>
        Choose a file (max size 8MB per upload):
        <p></p>
        <input type="file" style="color:black;" name="noteUpload" id="noteUpload">
        <br>

        <br>
        <button type="submit" name="submit-add" class='mdc-button mdc-button--unelevated'>Go!</button>

      </form>
    </div>
  <?php } else {?>
    <center><h1>You must be logged in to view this page!</h1></center>
  <?php } ?>
  </main>
</div>
