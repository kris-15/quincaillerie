<?php
    session_start();
    require 'model/Admin.php';
    if(isset($_POST['connect'])){
        extract($_POST);
        if(isset($role)){
            if($role === "admin"){
                $admin = new Admin("", "", $login, $password);
                if($admin->login()){
                    $_SESSION['admin'] = $admin->username;
                    header("Location: index.php");
                }
            }
            if($role === "manager"){
                $manager = new Manager("", "", $login, $password, null);
                if($manager->login()){
                    $_SESSION['manager'] = $manager->email;
                    header("Location: index.php");
                }
            } 
        }
        
        $error = "informations incorrectes";
    }

    $title = "Auth / Connexion";
    $pageTitle = "Connexion";
    $pageSubTitle = "Entrez votre username et password";
    ob_start();
?>
<?php if(isset($error)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-octagon me-1"></i><?= $error ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>
<form class="row g-3 needs-validation" method="post" novalidate>
    <div class="col-12">
        <label for="yourUsername" class="form-label">Username / Email / Matricule</label>
        <div class="input-group has-validation">
            <span class="input-group-text" id="inputGroupPrepend">@</span>
            <input type="text" name="login" class="form-control" id="yourUsername" value="<?= $_POST['login']??'' ?>" required>
            <div class="invalid-feedback">Please enter your username.</div>
        </div>
    </div>
    <div class="col-12">
        <label for="yourPassword" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="yourPassword" required>
        <div class="invalid-feedback">Please enter your password!</div>
    </div>
    <div class="col-12">
    <fieldset class="row mb-3">
        <legend class="col-form-label col-sm-4 pt-0">En étant</legend>
        <div class="col-sm-8">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="role" id="gridRadios1" value="admin">
                <label class="form-check-label" for="gridRadios1">
                Administrateur
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="role" id="gridRadios2" value="manager">
                <label class="form-check-label" for="gridRadios2">
                Gestionnaire
                </label>
            </div>
            <div class="form-check disabled">
                <input class="form-check-input" type="radio" name="role" id="gridRadios3" value="dealer" >
                <label class="form-check-label" for="gridRadios3">
                Vendeur
                </label>
            </div>
        </div>
    </fieldset>
    </div>
    <div class="col-12">
        <button class="btn btn-primary w-100" type="submit" name="connect">Login</button>
    </div>
    <div class="col-12">
        <p class="small mb-0 text-center"><a href="register.php">Creez un compte</a></p>
    </div>
</form>
<?php
    $content = ob_get_clean();
    require 'partials/app_auth.php';
?>
