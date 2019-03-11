<?php

if(!isset($login))
    $login = '';
if(!isset($pwd))
    $pwd = '';

if(isset($error) && !empty($error)){
?>
<div class="alert alert-danger" role="alert">
    <?=$error?>
</div>
<?php } ?>

<form class="form-signin text-center" method="post" action="./index.php?controller=clients&action=connected">
    <h1 class="h3 mb-3 font-weight-normal">Connexion</h1>
    <label for="login" class="sr-only">Login</label>
    <input type="text" name="login" value="<?=$login?>" id="login" class="form-control" placeholder="Login" required autofocus>
    <label for="pwd" class="sr-only">Mot de passe</label>
    <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Mot de passe" required>
    <button class="btn btn-lg btn-secondary btn-block" type="submit" style="margin-top: 25px">Connexion</button>
    <a href="./index.php?controller=clients&action=create" class="mt-5 mb-3 text-muted">Inscription</a>
</form>