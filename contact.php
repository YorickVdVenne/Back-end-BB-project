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
            <h1 class="row justify-content-center">Contact page</h1>
            <?php
                if (isset($_SESSION['userId'])) {
                    echo '<p class="row justify-content-center login-status">You are logged in!</p>';
                    echo '<p class="row justify-content-center"><a href="secure.php">Go to secure page</a></p>';
                }
                else {
                    echo '<p class="row justify-content-center login-status">You are currently logged out!</p>';
                }
            ?>
            <?php
                if(isset($_POST['sendmail'])) {
                    require_once 'vendor/autoload.php';
                    require_once 'credential.php';

                    // Create the Transport
                    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
                    ->setUsername(EMAIL)
                    ->setPassword(PASS)
                    ;

                    // Create the Mailer using your created Transport
                    $mailer = new Swift_Mailer($transport);

                    // Create a message
                    $message = (new Swift_Message($_POST['subject']))
                    ->setFrom([EMAIL => 'Back-end BB'])
                    ->setTo([$_POST['email']])
                    ->setBody('And here is the message')
                    ;

                    // Send the message
                    if ($mailer->send($message)) {
                        echo '<p class="row justify-content-center">Mail send!</p>';
                    } else {
                        echo "Failed to send mail!";
                    }
                }
            ?>
            <div class="row justify-content-center">
                <form role="form" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control"  placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" class="form-control"  placeholder="Enter your subject">
                    </div>
                    <div class="form-group">
                        <label for="bodyMessage">Message</label>
                        <textarea type="text" name="bodyMessage" class="form-control"  placeholder="Enter your message"></textarea>
                    </div>
                    <div class="form-group">
                    <button type="submit" name="sendmail" class="btn btn-primary">Send Mail</button>
                    </div>
                </form>
            </div>
        </div>

    </main>
</body>
</html>
    

<?php 
require "footer.php";
?>