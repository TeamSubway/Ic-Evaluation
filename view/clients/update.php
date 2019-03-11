<?php

if(!isset($login))
    $login = '';
if(!isset($mail))
    $mail = '';
?>

<form class="form-signin text-center" method="post" action="./index.php?controller=clients&action=<?=$action?>">
    <img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Inscription</h1>
    <?php
    if($action == 'created'){ ?>
        <label for="login" class="sr-only">Login</label>
        <input type="text" value="<?=$login?>" id="login" name="login" class="form-control" placeholder="Login" required autofocus>
        <label for="mail" class="sr-only">Email</label>
        <input type="email" value="<?=$mail?>" id="mail" name="mail" class="form-control" placeholder="Email" required>
        <label for="pwd" class="sr-only">Mot de passe</label>
        <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Mot de passe" required>
    <?php }else{ ?>
        <label for="login" class="sr-only">Login</label>
        <input type="text" value="<?=$login?>" id="login" name="login" class="form-control" placeholder="Login" required disabled autofocus>
        <label for="mail" class="sr-only">Email</label>
        <input type="email" value="<?=$mail?>" id="mail" name="mail" class="form-control" placeholder="Email">
        <label for="pwd" class="sr-only">Mot de passe</label>
        <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Mot de passe">
    <?php } ?>
    <?php
    if($action == 'created'){ ?>
        <button class="btn btn-lg btn-secondary btn-block" type="submit" style="margin-top: 25px">Inscription</button>
        <a href="./index.php?controller=clients&action=connect" class="mt-5 mb-3 text-muted">Connexion</a>
    <?php }else{ ?>
        <button class="btn btn-lg btn-secondary btn-block" type="submit" style="margin-top: 25px">Modification</button>
    <?php } ?>
</form>