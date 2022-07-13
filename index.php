<?php
session_start();

if (!isset($_SESSION['number'])) {
	$_SESSION['number'] = rand(1, 100);
}

if (!isset($_SESSION['attempts'])) {
	$_SESSION['attempts'] = 0;
} else {
    $_SESSION['attempts']++;
}

$rand = $_SESSION['number'];
$attempts = $_SESSION['attempts'];
$guess = isset($_POST['guess']) ? (int)$_POST['guess'] : false;

if ($guess == $rand) {
	unset($_SESSION['number']);
	unset($_SESSION['attempts']);
}
?>
<!DOCTYPE html>
<html lang="en" >
   <head>
      <title>guessingGame</title>
      <link rel="stylesheet" href="assets/css/style.css">
   </head>
   <body>
      <h1>Pick a number between 1-100...</h1>
      <?php
		if ($guess != false) {
			print "<hr />";
			print "You guessed $guess. <br />";
				if ($guess == $rand) {
					print "Congratulations, you guessed correctly! <br />";
					print "It took you " . $attempts . " attempt(s)!";
				} else if ($guess != $rand) {
				if ($guess > $rand) {
					print "You guessed too high... <br />";
					print "Try again!";
				} else if ($guess < $rand) {
					print "You guessed too low... <br />";
					print "Try again!";
					}
				}
			}
		?>
      <hr />
      <?php if ($guess != $rand): ?>
      <form action="" method="post">
         <label>Enter a number: </label>
         <input type="number" name="guess" /><br />
         <br />
         <button type="submit">Submit</button>
         <br />
         <br />
         <a href="assets/php/logout.php">Start Over</a>
         <br />
         <br />
         <details>
            <summary>Give Up?</summary>
            <br />
            Answer: <?php echo $rand; ?>
            <br />
            Attempt(s): <?php echo $attempts; ?>
            <br />
            Your Last Guess: <?php echo htmlspecialchars($guess); ?>
            <br />
         </details>
      </form>
      <br />
      <br />
      <?php else: ?>
      <a href="index.php">Start Over</a></p>
      <?php endif; ?>
   </body>
</html>