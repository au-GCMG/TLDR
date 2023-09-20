<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Shansong Huang" />
    <meta name="description" content="TLDR student" />
    <link rel = "stylesheet", type="text/css", href="styles/signup.css">
    <script src="scripts/script.js" defer></script>
    <title>Student</title>
  </head>
  <body>
    <?php
        $email = $_SESSION['email'];
        echo $email;
    ?>

  </body>
</html>