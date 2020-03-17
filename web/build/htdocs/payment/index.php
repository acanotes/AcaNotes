<?php
  include $_SERVER['DOCUMENT_ROOT'] . '/head.php';
  include $_SERVER['DOCUMENT_ROOT']. '/includes/user_access.inc.php';
$buyingNotes = false;
$price = 10;
  if (isset($_GET['id'])) {
    $buyingNotes = true;
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM notes WHERE a_id = '$id'";
    $result = mysqli_query($conn, $sql);
    $queryResults = mysqli_num_rows($result);
    if ($queryResults > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
          $title = $row['a_title'];
          $subject = $row['a_subject'];
          $user = $row['a_author'];
          $date = $row['a_date'];
          $note_id = $row['a_id'];
          $extension = 'pdf';
          $price = 25;//$row['a_price'];
      }
    }
  }
?>
<script>
  var price = <?php echo $price; ?>;
  $(document).ready(function() {
    $("#amount").val(price.toFixed(2));
  });
</script>
<script src="https://js.stripe.com/v3/"></script>
<script src="/scripts/payment/index.js"></script>
<link rel="stylesheet" href="/styles/payment/index.css">
</head>

<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
  <div class='container'>
    <main class='content-wrapper'>
      <h1>Deposit Into Account</h1>

<form method="post" id="payment-form">
  <div class="form-row">
    <label for="charge-element">
      Deposit Money to Account
    </label>
    <div id='details'>
      <div style='position:absolute;line-height:41.5px;margin-left:15px;color:#aab7c4'>¥</div><div><input placeholder="Deposit Amount" id='amount'></div>
    </div>
    <label for="card-element">
      Credit or debit card
    </label>
    <div id="card-element">
      <!-- A Stripe Element will be inserted here. -->
    </div>

    <!-- Used to display form errors. -->
    <div id="card-errors" role="alert"></div>
  </div>

  <button class='mdc-button' style='margin-top:10px;' type='submit'>Submit Payment</button>
</form>
    </main>
  </div>
</body>
</html>