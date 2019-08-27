<?php
//TODO : instead of writing in same file for 2 different action make it like the structure in readme.md file
// Include config file
require_once "common/config.php";
 
// Define variables and initialize with empty values
$name = $address = $email = "";
$name_err = $address_err = $email_err = $phone_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    //TODO : same validation is repeate so make a single function for validation
    //TODO : also to sanitize input make seprate function
    //TODO : you have put the string size in DB but hasn't checked it in validation
    //TODO : always keep in mind that we can't show the DB error to the user so add the length validation here also
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        //TODO : filter_var method take long to process so use php preg_match for this kind of validation
        //For email it's absolutely fine
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }
    
    // Validate email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter the email amount.";     
    } elseif(!filter_var($input_email, FILTER_VALIDATE_EMAIL)){
        $email_err = "Please enter valid email";
    } else{
        $email = $input_email;
    }

    // Validate phone
    $input_phone = trim($_POST["phone"]);
    if(empty($input_phone)){
        $phone_err = "Please enter the phone number.";     
    } elseif(!ctype_digit($input_phone) ){
        //this will generate false if some one enter +977 or 01-4444444
        $phone_err = "Please enter a positive integer value.";
    } else{
        $phone = $input_phone;
    }
    
    // Check input errors before inserting in database
    //TODO we can add error in array with key of input rather than using multiple variable
    //this will be reduce once you implement the single validation methods
    if(empty($name_err) && empty($address_err) && empty($email_err)&& empty($phone_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO users (name, address, email) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($connect, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_address, $param_salary);
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_salary = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($connect);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Core PHP CURD</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Create Record</h2>
            </div>
            <p>Please fill this form and submit to add employee record to the database.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                    <span class="help-block"><?php echo $name_err;?></span>
                </div>
                <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                    <label>Address</label>
                    <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
                    <span class="help-block"><?php echo $address_err;?></span>
                </div>
                <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                    <span class="help-block"><?php echo $email_err;?></span>
                </div>

                <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                    <label>Phone</label>
                    <input type="number" name="phone" class="form-control" value="<?php echo $phone; ?>">
                    <span class="help-block"><?php echo $phone_err;?></span>
                </div>
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="index.php" class="btn btn-default">Cancel</a>
            </form>
        </div>
    </div>        
</div>

</body>
</html>