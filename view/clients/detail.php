<div class="form-signin text-center">
    <img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Profil</h1>
    <label for="login" class="sr-only">Login</label>
    <input type="text" value="<?=$client->get('cli_login')?>" disabled id="login"class="form-control">
    <label for="mail" class="sr-only">Email</label>
    <input type="email" value="<?=$client->get('cli_email')?>" disabled id="mail" class="form-control">

    <label for="date" class="sr-only">Date d'inscription</label>
    <input type="date" value="<?=$client->get('cli_ins')?>" disabled id="date" class="form-control">

    <a href="./index.php?controller=clients&action=update" class="btn btn-lg btn-secondary btn-block" type="submit" style="margin-top: 25px">Modifier</a>
</div>