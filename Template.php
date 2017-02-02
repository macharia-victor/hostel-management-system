<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="Styles/Stylesheet.css" />
    </head>
    <body>
        <div id="wrapper">
            <div id="banner">             
            </div>
            
            <nav id="navigation">
                <ul id="nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="houses.php">Rentals</a></li>
                    <li><a href="Images.php">Images</a></li>
                    <li><a href="management.php">Management</a></li>
                    <li><a href="about.php">About</a></li>
                </ul>
            </nav>
            
            <div id="content_area">
                <?php echo $content; ?>
            </div>
            
            <div id="sidebar">
                
                    <form  action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="submit">
                    Your name:<br>
                    <input name="name" type="text" value="" size="30"/><br>
                    Your email:<br>
                    <input name="email" type="text" value="" size="30"/><br>
                    Your message:<br>
                    <textarea name="mess" rows="7" cols="30"></textarea><br>
                    <input type="submit" name="submit" value="Send"/>
                    </form>
                    
      
            </div>
            
            <footer>
                
            </footer>
        </div>
    </body>
</html>

           <?php  if($_POST["submit"]) {
               
                     require_once('AfricasTalkingGateway.php');
                     
// Specify your login credentials
$username   = "SCARLA";
$apikey     = "fe5c935a74c96b92d801a92ff6832f67c195313c4f3cfa7fe43164c2a04883e6";
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
$recipients = "+254701687707";
// And of course we want our recipients to know what we really do
$message    = $_POST["name"]."\n".$_POST["email"]."\n".$_POST["mess"];

// Create a new instance of our awesome gateway class
$gateway    = new AfricasTalkingGateway($username, $apikey);
// Any gateway error will be captured by our custom Exception class below, 
// so wrap the call in a try-catch block
try 
{ 
  // Thats it, hit send and we'll take care of the rest. 
  $results = $gateway->sendMessage($recipients, $message);
            
  foreach($results as $result) {
    // status is either "Success" or "error message"
    echo " Number: " .$result->number;
    echo " Status: " .$result->status;
    echo " MessageId: " .$result->messageId;
    echo " Cost: "   .$result->cost."\n";
  }
}
catch ( AfricasTalkingGatewayException $e )
{
  echo "Encountered an error while sending: ".$e->getMessage();
}
                 } ?>