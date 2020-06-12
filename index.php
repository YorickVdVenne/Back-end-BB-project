<?php
require "header.php";
?>



<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="utf-8">
    <title>Homepage</title>
</head>
<body>
    <main>
        <div class="container">
            <h1 class="row justify-content-center">Welcome to my back-end BB website</h1>

            <p class="row justify-content-center"><strong>Check out the Employee list to see the usage of an external webservice.</strong></p>
            <p class="row justify-content-center">Or log in and get acces to the CRUD connected to the Database. You can even send us a email on the contact page which uses swiftmailer (library).</p>
            <?php
                if (isset($_SESSION['userId'])) {
                    echo '<p class="row justify-content-center login-status">You are logged in!</p>';
                    echo '<p class="row justify-content-center"><a href="secure.php">Go to secure page</a></p>';
                }
                else {
                    echo '<p class="row justify-content-center login-status">You are currently logged out!</p>';
                }
            ?>
        </div>

    </main>
</body>
</html>
    

<?php 
require "footer.php";
?>