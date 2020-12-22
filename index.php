<?php

require "autoload.php";


$battle = new Battle();
$carl = $battle->getCarl();
$beast = $battle->getBeast();


$carlStatus = $battle->playerOneInitialization();
$beastStatus = $battle->playerTwoInitialization();
$isCarlTurn = Succession::initialTurnPlay($carl, $beast);
$firstTurn = Succession::showFirstAttacker($carl, $beast);
$battleConduct = $battle->play();
$damage = $battle->getDamage();

$winner = Winner::showWinner($carl, $beast);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>Here is Carl :</p>
    <?php echo $carlStatus; ?>
    <p>Here is Beast :</p>
    <?php echo $beastStatus; ?>
    <p>3...2...1...Start new Game</p>
    <p><?php echo $firstTurn; ?> attacks first</p>
    <?php $i = 1 ?>
    <?php foreach ($battleConduct as $value) : ?>
        <p>Round : <?php echo $i; ?>
            <p>Damage : <?php echo $value[0] ?></p>
            <p><?php echo $value[1]; ?></p>
            <p><?php echo $value[2]; ?></p>
            <?php $i++; ?>
            <hr>
        <?php endforeach; ?>

        <p>End game</p>
        <p>Winner is : <?php echo $winner ?>


</body>

</html>