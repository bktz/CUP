<?php

createApplication($_SESSION['userInfo']['userid'],$_POST['title'],$_POST['project_contact_first'],$_POST['project_contact_last'],$_POST['project_contact_email'],
    $_POST['project_contact_phone'],$_POST['project_contact_phone_ext'],$_POST['description'],$_POST['location'],$_POST['expected_time'],$_POST['motivation'],
    $_POST['resources'],$_POST['constraints']);

?>
