<?php
    session_start();
    require 'model/Admin.php';
    if(isset($_POST['register'])){
        extract($_POST);
        $admin = new Admin($name, $email, $username, $password);
        $createAccount = $admin->save_account();
        if($createAccount){
            $_SESSION['admin'] = $admin->username;
            header('Location: index.php');
        }
        $error = "username déjà utilisé !";       
    }

    $title = "Auth / Inscription";
    $pageTitle = "Creer mon compte";
    $pageSubTitle = "Entrez vos informations pour créer le compte";
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
        <label for="yourName" class="form-label">Your Name</label>
        <input type="text" name="name" class="form-control" id="yourName" placeholder="My name" value="<?= $_POST['name'] ?? '' ?>" required>
        <div class="invalid-feedback">Please, enter your name!</div>
    </div>

    <div class="col-12">
        <label for="yourEmail" class="form-label">Your Email</label>
        <input type="email" name="email" class="form-control" id="yourEmail" placeholder="user@gmail.com" value="<?= $_POST['email'] ?? '' ?>" required>
        <div class="invalid-feedback">Please enter a valid Email adddress!</div>
    </div>

    <div class="col-12">
        <label for="yourUsername" class="form-label">Username</label>
        <div class="input-group has-validation">
        <span class="input-group-text" id="inputGroupPrepend">@</span>
        <input type="text" name="username" class="form-control" id="yourUsername" value="<?= $_POST['name'] ?? '' ?>" placeholder="user" required>
        <div class="invalid-feedback">Please choose a username.</div>
        </div>
    </div>

    <div class="col-12">
        <label for="yourPassword" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="yourPassword" placeholder="****" required>
        <div class="invalid-feedback">Please enter your password!</div>
    </div>

    <div class="col-12">
        <div class="form-check">
        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
        <label class="form-check-label" for="acceptTerms">J'accepte les <a href="#">termes et conditions</a></label>
        <div class="invalid-feedback">Vous devez accepter les conditions</div>
        </div>
    </div>
    <div class="col-12">
        <button class="btn btn-primary w-100" type="submit" name="register">Creez le compte</button>
    </div>
    <div class="col-12">
        <p class="small mb-0">Avez-vous déjà un compte? <a href="login.php">Log in</a></p>
    </div>
</form>
<?php
    $content = ob_get_clean();
    require 'partials/app_auth.php';
?>