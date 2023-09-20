<?php
    session_start();
    require 'model/Admin.php';
    if(isset($_POST['login'])){
        extract($_POST);
        $admin = new Admin("", "", $username, $password);
        if($admin->login()){
            $_SESSION['admin'] = $admin->username;
            header("Location: index.php");
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
        <label for="yourUsername" class="form-label">Username</label>
        <div class="input-group has-validation">
            <span class="input-group-text" id="inputGroupPrepend">@</span>
            <input type="text" name="username" class="form-control" id="yourUsername" value="<?= $_POST['username']??'' ?>" required>
            <div class="invalid-feedback">Please enter your username.</div>
        </div>
    </div>
    <div class="col-12">
        <label for="yourPassword" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="yourPassword" required>
        <div class="invalid-feedback">Please enter your password!</div>
    </div>
    <div class="col-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
            <label class="form-check-label" for="rememberMe">Remember me</label>
        </div>
    </div>
    <div class="col-12">
        <button class="btn btn-primary w-100" type="submit" name="login">Login</button>
    </div>
    <div class="col-12">
        <p class="small mb-0 text-center"><a href="register.php">Creez un compte</a></p>
    </div>
</form>
<?php
    $content = ob_get_clean();
    require 'partials/app_auth.php';
?>
