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
<body style="padding-top: 5rem;">
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="./">IC Evaluation</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if(static::$object == "albums") {?> active <?php } ?>">
                <a class="nav-link" href="./index.php?controller=albums&action=readAll">Albums</span></a>
            </li>
            <li class="nav-item <?php if(static::$object == "artistes") {?> active <?php } ?>">
                <a class="nav-link" href="./index.php?controller=artistes&action=readAll">Artistes</span></a>
            </li>
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
            <?php if (Session::is_connected()){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="./index.php?controller=clients&action=read">Profil</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./index.php?controller=clients&action=deconnect">Déconnexion</span></a>
                </li>
            <?php }else{ ?>
            <li class="nav-item">
                <a class="nav-link" href="./index.php?controller=clients&action=connect">Connexion</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./index.php?controller=clients&action=create">Inscription</span></a>
            </li>
            <?php } ?>
        </ul>
    </div>
</nav>
<main role="main" class="container">
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
