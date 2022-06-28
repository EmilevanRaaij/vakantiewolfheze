<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Bedankt</title>
    <style>
        html{
            overflow:hidden;
            color:#fff;
        }
        #err-content{
            text-align:left;
            height:100vh;
            width:90%;
        }
        #center{
            margin: 0;
            position: absolute;
            width: 90%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .backbtnwrap{
            text-align: center;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="content" id="err-content">
        <div id="center">
            <h3>Beste <?php echo($_GET['name']) ?>,<br>Bedankt voor je boeking bij Chalet Bosrust. Hieronder vind je een overzicht van je reservering. <br><br>Periode van reservering: <?php echo($_GET['period']) ?> <br>Aantal personen: <?php echo($_GET['guests']) ?> <br>Totaalprijs: <?php echo($_GET['price']) ?>
            <br><br>Binnen 7 dagen ontvang je een verzoek tot betaling via e-mail. We ontvangen je graag van harte in Wolfheze.</h3>
            <div class="backbtnwrap"><a href="index.php" class="btn">Terug naar de site</a></div>
        </div>
    </div>
</body>
</html>