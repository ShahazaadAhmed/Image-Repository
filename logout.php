<?php
session_start();
session_unset();
session_destroy();
header("refresh:0.1;url=index.php");
?>
<html>

<body>
  <style>
    html {
      background-color: cornsilk;
    }

    h1 {
      margin-top: 25%;
    }
  </style>
  <center>
    <h1>
      Logging Out...
    </h1>
  </center>
</body>

</html>