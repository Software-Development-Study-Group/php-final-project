<?php 
include_once __DIR__ . '\..\functions\game-functions.php';
include_once __DIR__ . '\..\..\db\Insert.php';

session_start();

if(isset($_POST["send"])){

    $currentLevel = $_SESSION['level'];
    $currentLives = $_SESSION['lives'];
    $correctAnswer = $_SESSION['generatedSequence'];

    $userAnswer = [];
    for($i=1; $i<=6 ; $i++) {
        if(isset($_POST["l".$i])){
            array_push($userAnswer, $_POST["l".$i]);
        } else {
            array_push($userAnswer, "");
        }
    }
    
    //generate the correct answer for each level
    if ($currentLevel == 1 || $currentLevel == 3) {
        // Ascending order for numbers or letters
        sort($correctAnswer);
    } elseif ($currentLevel == 2 || $currentLevel == 4) {
        // Descending order for numbers or letters
        rsort($correctAnswer);
    } elseif ($currentLevel == 5 || $currentLevel == 6) {
        // Identify the smallest and largest number
        sort($correctAnswer);
        $correctAnswer = [min($correctAnswer), max($correctAnswer), "", "", "", ""];
    }

    //compare the correct answer with the user answer and treats it
    var_dump($correctAnswer);
    echo "<br>";
    var_dump($userAnswer);
    if (arraysEqual($correctAnswer, $userAnswer)) {
        $currentLevel++;
        echo "Correct!";

        if ($currentLevel <= 6) {
            //startGame();
            $_SESSION['level'] = $currentLevel;
            $_SESSION['generatedSequence'] = generateSequence($currentLevel);
            $_SESSION['gameInstruction'] = generateInstruction($currentLevel);
            $_SESSION['gameMessage'] = "That's correct! You've reached the next level!!";
            header("Location: /php-final-project/public/form/game-form.php");
            exit();
        } else {
            echo "You completed all levels! Congratulations.";
            createScore("win",$_SESSION['lives'] ,$_SESSION['user']['registrationOrder']);
            header("Location: /php-final-project/public/message/game-won.php");
            exit();
        }
    } 
    else {
        $currentLives--;
        echo "Incorrect!";

        if ($currentLives > 0) {
            
            $_SESSION['level'] = $currentLevel;
            $_SESSION['generatedSequence'] = generateSequence($currentLevel);
            $_SESSION['lives'] = $currentLives;
            $_SESSION['gameInstruction'] = generateInstruction($currentLevel);
            $_SESSION['gameMessage'] = incorrectAnswer($correctAnswer, $userAnswer, $currentLevel);
            //"Incorrect!!! But you still have ".$currentLives." lives! Try again!";
            header("Location: /php-final-project/public/form/game-form.php");
            exit();
        } else {
            echo "You've spent all your lives. Game over.";
            createScore("gameover", 6,$_SESSION['user']['registrationOrder']);
            header("Location: /php-final-project/public/message/game-over.php");
            exit();
        }
    }


} 
else {

    $currentLevel = 1;
    $currentLives = 6;

    $_SESSION['level'] = $currentLevel;
    $_SESSION['generatedSequence'] = generateSequence($currentLevel);
    $_SESSION['lives'] = $currentLives;
    $_SESSION['gameInstruction'] = generateInstruction($currentLevel);
    $_SESSION['gameMessage'] = "Let's play!!! You have ".$currentLives." lives!";


    header("Location: /php-final-project/public/form/game-form.php");
    exit();

}




?>