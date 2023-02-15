<html>
    <?php
        include_once "classes/MailSender.php";

        if (isset($_GET["email"]) && isset($_GET["message"]) && isset($_GET["subject"])) {
            $mailSender = new MailSender();

            $Result = $mailSender->SendMail($_GET["email"], $_GET["subject"], $_GET["message"], isset($_GET["html"]));
            echo $Result;
        }
    ?>

    <form action="index.php" method="get">
        Send To <input type="email" name="email" id="email" placeholder="Email address"><br><br>

        Subject <input type="text" name="subject" id="subject" placeholder="Subject"><br><br>
        <textarea name="message" id="message" cols="70" rows="25"></textarea><br><br>

        Message is HTML? <input type="checkbox" name="html" id="html"><br><br>
        Number of messages <input type="number" value="1" min="1" max="5" name="count" id="count"><br><br>

        <input type="submit" name="send" id="send" value="Send">
    </form>
</html>