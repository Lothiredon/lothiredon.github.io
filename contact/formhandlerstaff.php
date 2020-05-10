<?PHP
  // form handler
  function validateFeedbackForm($arr)
  {
    extract($arr);

    if(!isset($name, $email, $subject, $message)) return;

    if(!$name) {
      return "Please enter your Name";
    }
    if(!preg_match("/^\S+@\S+$/", $email)) {
      return "Please enter a valid Email address";
    }
    if(!$subject) $subject = "Contact from website";
    if(!$message) {
      return "Please enter your comment in the Message box";
    }

    // send email and redirect
    $to = "feedback@example.com";
    $headers = "From: webmaster@example.com" . "\r\n";
    mail($to, $subject, $message, $headers);
    header("Location: http://www.example.com/thankyou.html");
    exit;
  }

  // execution starts here
  if(isset($_POST['sendfeedback'])) {
    // call form handler
    $errorMsg = validateFeedbackForm($_POST);
  }
?>