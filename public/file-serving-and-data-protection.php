<?php
//include 'config.php';
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require 'sendMailSes.php';
require 'mailchimp_subs.php';
$sendSES_apikey = '60ac71615ce7326cdc51b5851897ca4242ecaa7f47d369b2b2a37f02fe005d1256e4fa0da17d9d82bc767bfed8766095';
$mail = new sendEmail($sendSES_apikey);

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
  $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
  $ip = $_SERVER['REMOTE_ADDR'];
}

$dsn = 'mysql:host=localhost;dbname=healthcare_sabha';
$pwd = 'password';
$uname = 'expresscomputer';

$displayM = 'failure';
$url = '';

try {
  $pdo = new PDO($dsn, $uname, $pwd);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
  echo $e->getMessage();
}

header('Access-Control-Allow-Origin: *');
$data1 = addslashes(htmlspecialchars(json_encode($_POST)));
$data = addslashes(json_encode($_POST));
$forms = addslashes(htmlspecialchars($_POST['forms']));
$email = addslashes(htmlspecialchars($_POST['email']));
$city = addslashes(htmlspecialchars($_POST['event_city']));
//$data = json_encode($_POST['data']);
date_default_timezone_set('Asia/Kolkata');
$currentTimestamp = date('Y-m-d H:i:s');

$milliseconds = round(microtime(true) * 1000);
$message_id = 'IE-'.uniqid()."-$milliseconds-BPD";
$email_headers = array('X-SES-CONFIGURATION-SET' => 'SNS-Email-Opens', 'BPD-MESSAGE-ID' => $message_id, 'BPD-CAMPAIGN-ID' => $forms);

if ($email != null) {
  //Mail
  $subject = 'Raw Data for - '.$forms.' '.$city;
  $headers = 'Raw Data for '.$forms.' '.$city.' are as follows: - <br><br>';
  $headers .= 'Email: - '.$email.'<br><br>';
  $headers .= 'Data : - '.$data1.'<br>';
  $postData = '';
  $emailto = array(
    'viraj.bpd@gmail.com'=>'Viraj Mehta',
    //'bhagya.expressbpd@gmail.com' => 'Bhagya Gawade',
    'sangita.kendre@indianexpress.com' => 'Sangita',
    //'alpesh.bpd@gmail.com' => 'Alpesh',
    'rakesh.expressbpd@gmail.com' => 'rakesh'
  );
  $addReply = array('bhagya.expressbpd@gmail.com' => 'Express Raw Data');
  $setFrom = array('expo@expresscomputeronline.com' => 'Express Raw Data');
  $postData = array(
    'email' => $emailto,
    'addReplyTo' => $addReply,
    'subject' => $subject,
    'body' => $headers,
    'setFromTo' => $setFrom,
  );
  $jsonData = json_encode($postData);
  $response = $mail->sendMail($jsonData);
  $response = str_replace('"', '', $response);
  $sql = "INSERT INTO `tbl_raw_data`(`forms`, `email`, `data`, `ip`, `created_on`) VALUES ('$forms', '$email', '$data', '$ip', '$currentTimestamp')";
  $result = $pdo->prepare($sql);
  $result->execute();
  $responseFlag = false;
  if (isset($response) && $response == 'success') {
    $responseFlag = true;
  }
  if ($responseFlag && $result) {
    $displayM = 'success';
  }
}

if (!empty($_POST['method']) && $_POST['method'] == 'get_states') {
  $sql = 'SELECT `id`, `name` from `states` where `country_id` = '.$_POST['country'];
  $result = $pdo->prepare($sql);
  $result->execute();
  $states = $result->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($states);
  exit;
}

if (!empty($_POST['method']) && $_POST['method'] == 'get_cities') {
  $sql = 'SELECT `id`, `name` from `cities` where `state_id` = '.$_POST['state'];
  $result = $pdo->prepare($sql);
  $result->execute();
  $cities = $result->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($cities);
  exit;
}

if (count(array_count_values($_POST)) <= 2) {
  header('Location: '.$_SERVER['HTTP_REFERER']);
  exit;
}
if (!empty($_POST) || empty($_POST)) {
  $chk_mailchimp = addslashes(htmlspecialchars($_POST['chk_mailchimp']));
  $eventname = addslashes(htmlspecialchars($_POST['eventname']));
  $source = addslashes(htmlspecialchars($_POST['source']));
  $forms = addslashes(htmlspecialchars($_POST['forms']));
  $fname = addslashes(htmlspecialchars($_POST['fname']));
  $lname = addslashes(htmlspecialchars($_POST['lname']));
  $name = "$fname $lname";
  $cname = addslashes(htmlspecialchars($_POST['organization']));
  $department = addslashes(htmlspecialchars($_POST['department']));
  $designation = addslashes(htmlspecialchars($_POST['job_title']));
//   if ($designation == '') {
//     $designation = addslashes(htmlspecialchars($_POST['job_title']));
//   }
  $email = addslashes(htmlspecialchars($_POST['email']));
  $phone = addslashes(htmlspecialchars($_POST['phone']));
  $mobile = addslashes(htmlspecialchars($_POST['mobile']));
  $address = addslashes(htmlspecialchars($_POST['address']));
  $city = addslashes(htmlspecialchars($_POST['city']));
  $state = addslashes(htmlspecialchars($_POST['state']));
  $attendeetype = addslashes(htmlspecialchars($_POST['attendee-type']));
  $privacy = addslashes(htmlspecialchars($_POST['privacy']));
  $title = addslashes(htmlspecialchars($_POST['title']));
  $country = addslashes(htmlspecialchars($_POST['country']));
  $job_function = addslashes(htmlspecialchars($_POST['job_function']));
  $zipCode = addslashes(htmlspecialchars($_POST['zipCode']));
  $functional_area = addslashes(htmlspecialchars($_POST['functional_area']));
  $interest = addslashes(htmlspecialchars($_POST['interest']));
  if(empty($interest))
  {
    $interest='No';
  }
  //$country = "";

  //for Awards
  $event = addslashes(htmlspecialchars($_POST['event']));
  $event_name = addslashes(htmlspecialchars($_POST['event_name']));
  $organization = addslashes(htmlspecialchars($_POST['organization']));
  $privacy = addslashes(htmlspecialchars($_POST['privacy']));
  // $webinarId =  addslashes(htmlspecialchars($_POST['webinarId']));
  // $webinarKey= addslashes(htmlspecialchars($_POST['webinarKey']));
  $apiKey = '';

  $javascript_status = 'Disabled';
  $sql1 = "SELECT `e_name`,`e_admin_mails`,`e_vertical`,`e_type`,`e_type_banner`,`e_award`,`e_webinar_id`,`e_webinar_key`, `e_thank_you_link` from `tbl_event_list` where `e_form` = '$forms' ORDER BY `e_id` DESC LIMIT 1";
  $result1 = $pdo->prepare($sql1);
  $result1->execute();
  $res = $result1->fetch(PDO::FETCH_ASSOC);
  $ename = $res['e_name'];
  $event = $res['e_vertical'];
  $emails = $res['e_admin_mails'];
  $thank_you_link = $res['e_thank_you_link'];
  $etype = $res['e_type'];
  $emails = explode(',', $emails);
  $webinarId = $res['e_webinar_id'];
  $webinarKey = $res['e_webinar_key'];



  if ($event == 'EC') {
    $verticalName = 'Express Computer';
    $fromEmail = 'events@expresscomputeronline.com';
    $listId = '3ac24afd38';
    $url = 'www.expresscomputer.in';
    $banner = 'https://forms.expressbpd.in/register/images/ec-banner.gif';
  } elseif ($event == 'EP') {
    $verticalName = 'Express Pharma';
    $fromEmail = 'events@expresspharmaonline.com';
    $listId = '95a5be0a77';
    $url = 'www.expresspharma.in';
    $banner = 'https://forms.expressbpd.in/register/images/ep-banner.gif';
  } elseif ($event == 'EH') {
    $verticalName = 'Express Healthcare';
    $fromEmail = 'events@expresshealthcare.co.in';
    $listId = 'd8042aa76d';
    $url = 'www.expresshealthcare.in';
    $banner = 'https://forms.expressbpd.in/register/images/eh-banner.gif';
  } elseif ($event == 'CRN') {
    $verticalName = 'CRN';
    $fromEmail = 'events@crn.in ';
    $listId = 'c18ad45528';
    $url = 'www.crn.in';
    $banner = 'https://forms.expressbpd.in/register/images/crn-banner.gif';
  }
  $fromName = $verticalName.'  Events';

  $emails = array_filter($emails);
  $emailto = array();
  foreach ($emails as  $value) {
    $emailto[$value] = stripcslashes('');
  }

  if (!isset($ename)) {
    $eventname = $forms;
  } else {
    $eventname = $ename;
  }

  $sel = "SELECT `ia_email` from tbl_webinar_on24 where `ia_email` = '$email' and `ia_forms` = '$forms'";

  $q = $pdo->prepare($sel);
  $q->execute();
  $record = $q->fetch(PDO::FETCH_ASSOC);

  if (!empty($record)) {

    $reg = 'Yes';
      header("Location:$thank_you_link?reg=".$reg);
      sendUserEmail($email, $mail, $name, $fromName, $fromEmail, $url, $banner, $verticalName, $eventname, '' , $email_headers);
    exit;
  }

  if ((isset($etype) && $etype != '')) {
    $sql = "SELECT `e_thank_you_link`,`e_type_banner` from `tbl_event_list` where `e_form` = '$forms' ORDER BY `e_id` DESC LIMIT 1";
    $result = $pdo->prepare($sql);
    $result->execute();
    $res1 = $result->fetch(PDO::FETCH_ASSOC);
    $thank_you_link = $res1['e_thank_you_link'];
    //$banner =  $res1['e_type_banner'];
  }

  if ($checkinfo == 'Y') {
    $sql2 = "SELECT `e_mail_content`,`e_mail_footer_image_url`,
    `e_mail_subject`,`e_date_from`,`e_date_to`,`e_name` from `tbl_event_list` where `e_form` = '$forms' ORDER BY `e_id` DESC LIMIT 1";
    $result = $pdo->prepare($sql2);
    $result->execute();
    $res2 = $result->fetch(PDO::FETCH_ASSOC);

    //$banner = $res2['e_banner_image_url'];
    $mail_content = $res2['e_mail_content'];
    $mail_footer_image_url = $res2['e_mail_footer_image_url'];
    $mail_subject = $res2['e_mail_subject'];
    $e_date_from = $res2['e_date_from'];
    $e_date_to = $res2['e_date_to'];
    $e_name = $res2['e_name'];

    $susbriber_html = file_get_contents('mail.html');
    $mail_content = str_replace(array('[name]', '[event_name]', '[start_date]', '[end_date]', '[location]'), array($name, $e_name, $e_date_from, $e_date_to, $event_city), $mail_content);
    $susbriber_html =
    str_replace(array('[banner]', '[content]', '[footer_image]'), array($banner, $mail_content, $mail_footer_image_url), $susbriber_html);

    $postData1 = '';
    $subject = $mail_subject;
    $emailto1 = array(
      $email => stripcslashes(''),
    );

    $addReply1 = array($fromEmail => $fromName);
    $setFrom1 = array($fromEmail => $fromName);

    $postData1 = array(
      'email' => $emailto1,
      'addReplyTo' => $addReply1,
      'subject' => $subject,
      'body' => $susbriber_html,
      'setFromTo' => $setFrom1,
    );
    $jsonData1 = json_encode(utf8ize($postData1));
    $error = json_last_error();

    $response1 = $mail->sendMail($jsonData1);
  }

  date_default_timezone_set('Asia/Kolkata');
  $currentTimestamp = date('Y-m-d H:i:s');



  if ($email != null) {
    $sql = "INSERT INTO tbl_webinar_on24(`ia_status`,`ia_forms`, `ia_source`, `ia_fname`, `ia_lname`, `ia_title`, `ia_cname`, `ia_country`, `ia_phone`, `ia_email`, `ia_attendee_type`, `ia_privacy`, `ia_ip`, `ia_webinar_id`, `ia_address`, `ia_city`,`ia_state`,`ia_zipcode`,`ia_created_on`,`ia_message_id`) values('Approved','$forms', '$source', '$fname','$lname','$designation','$cname','$country','$phone','$email','$attendeetype','$privacy', '$ip', '$webinarId', '$address','$city','$state','$zipCode','$currentTimestamp','$message_id')";

    $result = $pdo->prepare($sql);
    $result->execute();

    sendUserEmail($email, $mail, $name, $fromName, $fromEmail, $url, $banner, $verticalName, $eventname, '' ,$email_headers);

    $post = [
     'email' => $email,
     'form' => $forms,
    ];

     $ch = curl_init('https://dashboard.expressbpd.in/gtm_registration.php');
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

    // // execute!
    $response = curl_exec($ch);

    // // close the connection, release resources used
    curl_close($ch);

    $email_content = array('Source' => $source, 'First Name' => $fname, 'Last Name' => $lname, 'Title' => $designation, 'Company Name' => $cname,  'Phone No' => $phone, 'Email' => $email, 'Address' => $address, 'City' => $city, 'Pin' => $zipCode);

    $mail_body = format_mail_content($eventname, $email_content);
    //Mail
    $subject = "Registration for $ename";
    $message = email_template('', $mail_body, $url, $banner, $verticalName);

    $postData = '';

    $addReply = array($fromEmail => $fromName);
    $setFrom = array($fromEmail => $fromName);

    $postData = array(
      'email' => $emailto,
      'addReplyTo' => $addReply,
      'subject' => $subject,
      'body' => $message,
      'setFromTo' => $setFrom,
    );

    $jsonData = json_encode($postData);
    $response = $mail->sendMail($jsonData);
    $response = str_replace('"', '', $response);

    $responseFlag = false;
    if (isset($response) && $response == 'success') {
      $responseFlag = true;
    }
    //$responseFlag = true;
    if ($responseFlag && $result) {
      header("Location:$thank_you_link");
      exit;
    } else {
      header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    if ($chk_mailchimp == 'Y') {
      subsMailChimp($apiKey, $listId, $email, $fname, $lname);
    }
  }

  //echo $displayM;
  exit();
} else {
  echo 'Unauthorized Access';
  exit(); //Stop running the script
}

function format_mail_content($eventName, $content)
{
  $headers = '<p style="font-weight: normal; color: #000; font-size: 13px;font-family: Verdana, \'sans-serif\', Calibri, Arial; margin: 10px 7px 0 3px;word-spacing:0px;padding:8px 0;font-weight:600;">Registration for '.$eventName.' as follows: - </p><br>';

  if (!empty($content)) {
    foreach ($content as $key => $value) {
      $headers .= '<p style="color:#000;margin:0 auto;padding:8px 0 0; margin: 0 7px 0 5px;font-family: Verdana, \'sans-serif\', Calibri, Arial; font-size: 13px;font-weight:normal;">'.$key.': - '.$value.'</p>';
    }
  }

  return $headers;
}

function sendUserEmail($email, $mail, $name, $fromName, $fromEmail, $url, $banner, $verticalName, $eventname, $e_award, $email_headers)
{
  $postData = $subject = $headers = $addReply = $setFrom = '';

  $subject = 'Registration for File-serving and data protection essentials for business confronting the new normal.';

  $headers = '<p style="font-weight: normal; color: #000; font-size: 13px;font-family: Verdana, \'sans-serif\', Calibri, Arial; margin: 0 7px 0 3px;word-spacing:0px;padding:8px 0;line-height:25px;font-weight:600;">Thank you for showing interest in the upcoming webinar on:File-serving and data protection essentials for business confronting the new normal. </p>

  <p style="color:#000;margin:0 auto;padding:8px 0; margin: 0 7px 0 5px;line-height:24px;font-family: Verdana, \'sans-serif\', Calibri, Arial; font-size: 13px;font-weight:normal;">Webinar login information will be sent to you shortly. </p>';

  $message = email_template($name, $headers, $url, $banner, $verticalName);

  $postData1 = '';
  $emailto1 = array(
    $email => stripcslashes(''),
  );
 // $attachment = file_get_contents("Enabling_the_digital_future_of_healthcare_and_pharma.ics");


  $addReply1 = array($fromEmail => $fromName);
  $setFrom1 = array($fromEmail => $fromName);

  $postData1 = array(
    'email' => $emailto1,
    'addReplyTo' => $addReply1,
    'subject' => $subject,
    'body' => $message,
    'setFromTo' => $setFrom1,
    'header' => $email_headers,
   // 'attachment' => $attachment,
  );
  //print_r($postData1);
  $jsonData1 = json_encode($postData1);
  // echo $jsonData1;
  $response1 = $mail->sendMail($jsonData1);

  //echo $response1;
}

function email_template($name, $content, $url, $banner, $verticalName)
{
  $html = '<!doctype html>
  <html>
  <head>
  <meta charset="utf-8">
  <title>Oracle</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0, minimal-ui" />
  </head>
  <body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">

  <table width="90%" align="center" border="0" cellspacing="0" cellpadding="0" style="max-width:650px; width: 90%; border: 1px solid #d4d4d4;">
  <tbody>

  <tr>
  <td align="center">
  <a href="'.$url.'" target="_blank" style="color:#000;text-decoration:none;"><img src="'.$banner.'" alt="" width="100%" style="display: table;" ></a>
  </td>
  </tr>

  <tr align="left">
  <td style="font-family: Verdana, \'sans-serif\', Calibri, Arial; font-size: 12px; line-height: 22px; color:#000;padding: 0 25px 25px 25px;" valign="top">';
  if ($name) {
    $html .= '<h6 style="color:#000;margin:0 auto;padding:8px 0;line-height:24px;font-family: Verdana, \'sans-serif\', Calibri, Arial; font-size: 15px; width:80%; margin: 25px 5px 0 5px;">Dear '.$name.', </h6>';
  }

  $html .= $content.'<br> <p style="color:#000;margin: 0 7px 0 5px;padding:8px 0; font-family: Verdana, \'sans-serif\', Calibri, Arial; font-size: 13px;font-weight:bold;"><span style="color:#007eca; font-size: 14px;">Thanks,</span> <br/>
  Team '.$verticalName.'<br/>
  <a href="https://'.$url.'" target="_blank" style="color:#000;text-decoration:none;">'.$url.'</a></p>

  </td>
  </tr>
  <tr bgcolor="#252525">
  <td style="height:5px;">
  <p style="color: #fff; font-size: 12px;font-family: Verdana, \'sans-serif\', Calibri, Arial;margin: 0 5px 0 5px;word-spacing:1px;padding:15px;text-align:center;">© The Indian Express (P) Ltd. Event managed by Business Publications Division.</p>
  </td>
  </tr>
  </tbody>
  </table>
  </body>
  </html>';

  return $html;
}

function utf8ize($d)
{
  if (is_array($d) || is_object($d)) {
    foreach ($d as &$v) {
      $v = utf8ize($v);
    }
  } else {
    return utf8_encode($d);
  }

  return $d;
}
