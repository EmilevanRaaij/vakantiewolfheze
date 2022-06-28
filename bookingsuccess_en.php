<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Thank you</title>
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
            <h3>Dear <?php echo($_GET['name']) ?>, <br>Thank you for you reservation at Chalet Bosrust. Below you can find an overview of your booking. <br><br>Period of reservation: <?php echo($_GET['period']) ?> <br>Number of guests: <?php echo($_GET['guests']) ?> <br>Total price: <?php echo($_GET['price']) ?>
            <br><br>Within 7 days you will receive an invoice via e-mail. We hope you have a great stay at Chalet Bosrust.
            </h3>
            <div class="backbtnwrap"><a href="index.php" class="btn">Back to the site</a></div>
        </div>
    </div>
</body>
</html>