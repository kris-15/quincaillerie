<?php
    $breadcrumbTitle = "Home";
    ob_start();
?>
<h1>Hello</h1>
<?php
    $content = ob_get_clean();
    include './partials/app.php';
?>