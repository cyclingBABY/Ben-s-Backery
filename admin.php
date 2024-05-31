<?php include 'header.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>admin</title>
</head>
<body class="STUART">
    
          <div class="notice-container">
        <img src="images/oh.png" alt="">
    </div>
</div>
    </div>
    
<style>
    .notice-container img{
        width: 100%;
        height: 101%;
    }
</style>

    <?php if (isset($_SESSION['user'])) : ?>
                <strong><?php echo $_SESSION['user']['username']; ?></strong>
                <small>
                    <i><?php echo ucfirst($_SESSION['user']['user_type']); ?></i> <br>
                    <a href="index.php?logout='1'">logout</a>
                </small>
            <?php endif ?>
        </div>
        </section>               
 </div>
        </div>
    </section>
  

</body>
<?php include 'footer.php' ?>
</html>