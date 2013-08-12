<?php
$GLOBALS['title'] = 'Sign Up';

if ($_SESSION['logged'] == true) { //<-index 'logged' apparently doesn't exist? See error.log
    redirect('/login');
}
else if ($_POST != null) {

    $user = new User();

    $sql = "SELECT * FROM User u WHERE u.email = '" . $_POST['email'] . "' LIMIT 1";

    $rs = Data::DB()->Execute($sql);
    if (!$rs->EOF) {
        redirect('signup/taken');
    } else {
        $user->createUser($_POST['userType'], $_POST['email'], $_POST['password'], $_POST['firstName'], $_POST['lastName'],$_POST['organization'], $_POST['phoneNo'], $_POST['phoneNoExt']. $_POST['address'], $_POST['city'], $_POST['postalCode'], $_POST['province'],$_POST['SSID']);
        //Generate a RANDOM MD5 Hash for a password
        $random_password = md5(uniqid(rand()));

        $sql = 'UPDATE User SET password_recovery_timestamp=now(), verification_key="'.$random_password.'" WHERE email="'.$_POST['email'].'"';
        $rs = Data::DB()->Execute($sql);

        $message = '<h3>LEF Database</h3><p>Follow the link below to verify your email address.<br><a href="http://'.$_SERVER['HTTP_HOST'].'/verify/'.$random_password.'">http://'.$_SERVER['HTTP_HOST'].'/verify/'.$random_password.'</a><p>';
        Send_Mail($_POST['email'], 'LEF Database Verify Email Address', $message);

        redirect('signup/verify');
    }
}
?>
