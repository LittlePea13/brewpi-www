<?php
//ini_set('display_errors', 1);
session_start();
$config = parse_ini_file('private/config.ini');
if(!empty($_POST["login"])) {
    $conn = mysqli_connect("localhost", $config['username'], $config['password'], $config['dbname']);
    if (!$conn) {
    die('Could not connect: ' . mysql_error());
}

    $sql = "Select * from members where member_name = '" . $_POST["member_name"] . "' and member_password = '" . md5($_POST["member_password"]) . "'";
    $result = mysqli_query($conn,$sql);
    $user = mysqli_fetch_array($result);
    if($user) {
            $_SESSION["member_id"] = $user["member_id"];
            
            if(!empty($_POST["remember"])) {
                setcookie ("member_login",$_POST["member_name"],time()+ (10 * 365 * 24 * 60 * 60));
                setcookie ("member_password",$_POST["member_password"],time()+ (10 * 365 * 24 * 60 * 60));
            } else {
                if(isset($_COOKIE["member_login"])) {
                    setcookie ("member_login","");
                }
                if(isset($_COOKIE["member_password"])) {
                    setcookie ("member_password","");
                }
            }
    } else {
        $message = "Invalid Login";
    }
}
?>
<style>
    #frmLogin {
        height: 110%;
        border: 5px solid #f1f1f1;    }
    .field-group {
        margin-top:15px;
    }

    h1{
        text-align: center;
    }

    .input-field {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
    .form-submit-button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }
    .form-submit-button:hover {
        opacity: 0.8;
    }
    .member-dashboard {
        background: #D2EDD5;
        color: #555;
        border-radius: 4px;
        display: inline-block;
        width: 100%;
        text-align: end;
    }
    .member-dashboard a {
        color: #09F;
        text-decoration:none;
    }
    .error-message {
        text-align:center;
        color:#FF0000;
    }
    .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
    }

    img.avatar {
        width: 30%;
        border-radius: 50%;
    }
    .container {
        padding: 16px;
    }
    a.button {
        background-color: #af4e4c!important;
        color: white!important;
        padding: 14px 20px!important;
        margin: 8px 0!important;
        cursor: pointer!important;
        width: 100%!important;
        text-align: center!important;
        display: inline-block!important;
        box-sizing: border-box!important;
        text-decoration: unset!important;
        font: 11px system-ui!important;
    }

    a.button:hover {
        opacity: 0.8;
    }

</style>

<?php if(empty($_SESSION["member_id"])) { ?>
<form action="" method="post" id="frmLogin">
    <title>Peace&Hops</title>
    <h1>Welcome to Peace&Hops!</h1>
    <div class="imgcontainer">
        <img src="img_avatar2.png" alt="Avatar" class="avatar">
    </div>
<div class="container">
    <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>    
    <div class="field-group">
        <div><label for="login">Username</label></div>
        <div><input name="member_name" type="text" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" class="input-field">
    </div>
    <div class="field-group">
        <div><label for="password">Password</label></div>
        <div><input name="member_password" type="password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" class="input-field"> 
    </div>
    <div class="field-group">
        <div><input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />
        <label for="remember-me">Remember me</label>
    </div>
    <div class="field-group">
        <div><input type="submit" name="login" value="Login" class="form-submit-button"></span></div>
    </div> 
    <a href="public.php" class="button" >Public Page</a>
</div>     
</form>
<?php } else { ?>
<div class="member-dashboard">You have Successfully logged in!.<a href="logout.php">Logout</a></div>
<?php    
    include "protected.php";
} ?>