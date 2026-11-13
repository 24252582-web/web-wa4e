<?php
// Егер name параметрі берілмесе, кіруге тыйым салу
if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1 ) {
    die('Name parameter missing');
}

// Егер Logout батырмасы басылса, басты бетке қайтару
if ( isset($_POST['logout']) ) {
    header('Location: index.php');
    return;
}

// Ойын нұсқалары: 0 = Rock, 1 = Paper, 2 = Scissors
$names = array('Rock', 'Paper', 'Scissors');
$human = isset($_POST["human"]) ? $_POST['human']+0 : -1;

// Компьютердің кездейсоқ таңдауы
$computer = rand(0, 2);

// Жеңімпазды анықтау функциясы
function check($computer, $human) {
    if ( $human == $computer ) {
        return "Tie";
    } else if ( ($human == 0 && $computer == 2) || 
                ($human == 1 && $computer == 0) || 
                ($human == 2 && $computer == 1) ) {
        return "You Win";
    } else {
        return "You Lose";
    }
}

$result = false;
if ( $human != -1 ) {
    $result = check($computer, $human);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Олжас Нұран - Игра 2bdf63f3</title>
</head>
<body style="font-family: sans-serif;">
    <h1>Камень-ножницы-бумага (Rock Paper Scissors)</h1>
    <?php
    if ( isset($_REQUEST['name']) ) {
        echo "<p>Добро пожаловать: ";
        echo htmlentities($_REQUEST['name']);
        echo "</p>\n";
    }
    ?>
    <form method="post">
        <select name="human">
            <option value="-1">Select</option>
            <option value="0">Rock</option>
            <option value="1">Paper</option>
            <option value="2">Scissors</option>
            <option value="3">Test</option>
        </select>
        <input type="submit" value="Play">
        <input type="submit" name="logout" value="Logout">
    </form>

    <pre>
<?php
if ( $human == -1 ) {
    print "Please select a strategy and press Play.\n";
} else if ( $human == 3 ) {
    // Автогрейдердің барлық комбинацияны бірден тексеру режимі (Test)
    for($c=0; $c<3; $c++) {
        for($h=0; $h<3; $h++) {
            $r = check($c, $h);
            print "Human=$names[$h] Computer=$names[$c] Result=$r\n";
        }
    }
} else {
    print "Your Play=$names[$human] Computer Play=$names[$computer] Result=$result\n";
}
?>
    </pre>
</body>
</html>