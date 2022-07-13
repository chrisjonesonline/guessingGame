<?php
session_start();

if (!isset($_SESSION['number'])) {
    $_SESSION['number'] = rand(1, 100);
}

if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0;
}

else {
    $_SESSION['attempts']++;
}

$rand = $_SESSION['number'];
$attempts = $_SESSION['attempts'];
$guess = isset($_POST['guess']) ? (int)$_POST['guess'] : false;

if ($guess == $rand) {
    unset($_SESSION['number']);
    unset($_SESSION['attempts']);
}

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

session_destroy();
//todo: redirect using dirname or basename
header("location:../../../index.php");
?>