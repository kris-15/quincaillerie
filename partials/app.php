<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title><?= $title ?? "Quincaillerie"?></title>
        <link href="../assets/img/favicon.png" rel="icon">
        <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        
        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="../assets/vendor/bootstrap/css/bootstrap.min.css " rel="stylesheet">
        <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css " rel="stylesheet">
        <link href="../assets/vendor/boxicons/css/boxicons.min.css " rel="stylesheet">
        <link href="../assets/vendor/quill/quill.snow.css " rel="stylesheet">
        <link href="../assets/vendor/quill/quill.bubble.css " rel="stylesheet">
        <link href="../assets/vendor/remixicon/remixicon.css " rel="stylesheet">
        <link href="../assets/vendor/simple-datatables/style.css " rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="../assets/css/style.css " rel="stylesheet">
        <link href="../assets/css/bootstrap.min.css " rel="stylesheet">
        <link href="../assets/css/niceAdmin.min.css " rel="stylesheet">
        <script src="../assets/js/jquery.min.js "></script>
        <script src="../assets/js/bootstrap.min.js "></script>
    </head>
    <body class="font-sans antialiased">
        <?php include 'header.php'?>
        <?php include 'sidebar.php'?>
        <main id="main" class="main">
            <!-- <?php include "breadcrumb.php" ?> -->
            <?= $content ?>
        </main>
        <!-- <?php include 'footer.php'?> -->
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center "><i class="bi bi-arrow-up-short "></i></a>

        <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/vendor/quill/quill.min.js "></script>
        <script src="../assets/vendor/simple-datatables/simple-datatables.js "></script>
        <script src="../assets/vendor/tinymce/tinymce.min.js "></script>
        <script src="../assets/vendor/php-email-form/validate.js "></script>

        <!-- Template Main JS File -->
        <script src="../assets/js/main.js "></script>
    </body>
</html>
