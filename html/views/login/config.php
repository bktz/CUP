<?php
$GLOBALS['title'] = 'Login';
if ($_SESSION['logged'] != true && $_POST != null) {

    if ($_POST['username'] != '') {
        $user = new User();
        if($_POST['password'] != '') {
            if($user->getUser($_POST['username'], $_POST['password']) == false) {
                return;
            }
        }
        else if($_POST['SSID'] != '') {
            if($user->getSingalSignOnUser($_POST['username'], $_POST['SSID']) == false) {
                return;
            }
        }
    } else {
        $user = null;
        return;
    }

    $temp = $user->getUserInfo();
    if ($user != null && $temp != null && $temp['is_verified'] == 1) {
        $_SESSION['logged'] = true;
        $_SESSION['user'] = $user;
        $_SESSION['userInfo'] = $user->getUserInfo();
        $worker = new Worker();
        redirect('/success');
    } else {
        return;
    }
}
?>
