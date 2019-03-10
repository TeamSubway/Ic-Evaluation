<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $pagetitle; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js" defer></script>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">IC Evaluation</a>
    </div>
    <div class="container-fluid">
        <ul class="nav navbar-nav">
        </ul>
    </div>
</nav>
<div class="container-fluid" style="margin-top: 15px">
    <main class="col-md-8">
        <?php
        if(isset($view)){
            require File::build_path(array("view", static::$object, "$view.php"));
        }else{
            ?>
            <div class="jumbotron">
                <h1>Erreur 404<small> La page que vous demandez n'existe pas</small></h1>
            </div>
            <?php
        }
        ?>
    </main>
</div>

<footer class="footer">
    <div class="container-fluid">
        <span class="text-muted">  IC-Evaluation - Maxime BARRY, Floran NICOLETTI, Mathias UGHETTO</span>
    </div>
</footer>
</body>
<!--
Yes it's a cat !
    /\__/\
   /`    '\
 === 0  0 ===
   \  --  /
  /        \
 /          \
|            |
 \  ||  ||  /
  \_oo__oo_/#######o
-->
</html>
