<?php
    # FIX: Replace this email with recipient email
    $mail_to = "morshusmarket@gmail.com"; 
    
    # Sender Data
    $subject = trim($_POST["subject"]);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($subject) || empty($message)) {
        # Set a 400 (bad request) response code and exit.
        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }
    
    # Mail Content
    $content = "Email: $email\n\n";
    $content .= "Message:\n$message\n";
    

    # email headers.
    $headers = "From:<$email>";

    # Send the email.
    $success = mail($mail_to, $subject, $content, $headers);
    if ($success) {
        # Set a 200 (okay) response code.
        http_response_code(200);
        echo '<script type="text/javascript">alert("Thank You! Your message has been sent.")</script>';
    } else {
        # Set a 500 (internal server error) response code.
        http_response_code(500);
        echo 'alert("Oops! Something went wrong, we could not send your message.")';
    }
?>