<?php
//echo "<pre>\$_GET";
// print_r($_GET);
//echo "</pre>";


// check if submit button is clicked
//by checking if $_GET ["submit-data"] has value

//isset($variable_to_be_checked);
    //if the value of the variable $variable_to_be_checked is null
    // isset() returns false. In every other case isset() returns true.
    
    if(isset($_GET["submit-data"])) {
        
        
        /*// print entire $GET array
        echo "<pre>\$_GET";
        print_r($_GET);
        echo "</pre>";*/
        $errors = NULL;
        $valid = false;
        
        //validate the fullname
        if (trim($_GET["fullname"])) {
            $fn = filter_var($_GET["fullname"], FILTER_SANITIZE_STRING);
        } else {
            $errors = "<p>Please enter yor full name.</p>";
        }
        
        //here thesame thing for your email;
        
        if (trim($_GET["email"])) {
            if (filter_var($_GET["email"], FILTER_VALIDATE_EMAIL)) {
                $em = $_GET["email"];
               //if you get there, it means there is some value.
            } else {
                
                $_GET["email"] = NULL; 
                
                $errors .= "<p>Invalid email</p>";
            }
        } else {
                
            $errors .= "<p>Please enter your email!</p>";
        }
        
        // the same thing for the message
        
        if (trim($_GET["mess"])) {
            $msg = filter_var($_GET["mess"], FILTER_SANITIZE_STRING);
        } else {
            $errors .= "<p>Please enter any message.</p>";
        }
        
        
        //create a feedback
        
        if (isset($fn) && isset($em) && isset($msg)) {
            
            $valid = true;
            $feedback = "<p>Hello {$fn}! Thank you for your message: <br> {$msg} <br> We are going to contact you at {$em}.</p>";
        }
        
        
    }

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Example Form</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <form action="index.php" method="get">
           
            <fieldset>
                <legend>Example Form</legend>
                <div class="box">
                    <label for="">Full name</label>
                    <input type="text" name="fullname" id="fullname" value="<?php if (isset($valid) && !$valid) { echo $_GET["fullname"];} ?>">
                </div>
                <div class="box">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php if (isset($valid) && !$valid) { echo $_GET["email"];} ?>">
                </div>
                <div class="form-group">
                    <label for="msg">Message</label><br>
                    <input type="text" name="mess" id="mess" value="<?php if (isset($valid) && !$valid) { echo $_GET["message"];} ?>">
                </div>
                
                <div class="box">
                    <input type="submit" value="SUBMIT DATA" name="submit-data">
                </div>
            </fieldset>
            <?php
            
            //printing here
            
            if (isset($feedback )) {
                echo $feedback;
            }
            
            if (isset($errors)) {
                echo $errors;
            }
            
            ?>
        </form>
    </body>
</html>