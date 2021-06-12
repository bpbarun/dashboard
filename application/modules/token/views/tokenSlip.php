<html>

<head>
  <title>Generate PDF using Dompdf</title>
  <style>
    th,
    td,
    p,
    div,
    b {
      margin: 0;
      padding: 0;
    }

    html,
    body {
      height: 100%;
      vertical-align: middle;
      margin: 0 5px;
      padding: 0;
    }
  </style>
</head>

<body>
  <div style="text-align:center">
      <h2>AIIMS Hospital Kothipura, Bilaspur</h2>
      <hr>
      <?php
      echo "Token Number: <br> <b style=\"font-size:35px\">$token</b><br>";
      if (isset($room_no)) {
        echo "<b>$room_no</b><br>";
      }
      if (isset($subcounter_name)) {
        echo "$subcounter_name<br>";
      }
      if (isset($time)) {
        echo "<hr>$time<br>";
      }
      ?>
      <p>Please wait for you turn...</p>
  </div>
</body>

</html>