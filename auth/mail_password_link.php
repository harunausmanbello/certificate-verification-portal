<?php
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

require_once('core/usercore.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
       
$usrmail = filter_input(INPUT_POST,'email');
                

if (isset($usrmail) && !empty($usrmail)) {

  $title = "Reset Your Password";
  $message = "We have received a request to reset the password associated with your account.
  If you didn't make the request, just ignore the message. Otherwise , you can reset your password using the link below.";


    $query = "SELECT * FROM usertbl WHERE email = '$usrmail'";
    $statement = $con->prepare($query);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_OBJ);

    if ($user) {
        $usermail = $user->email;
        $username = $user->username;
        $id = $user->id;
        $userlink = 'http://cvp.test/password/create/new?id='.$id;
       // $fullname = $user->lname . ' ' . $user->fname . ' ' . $user->mname;

        $mail = new PHPMailer(true);

        // Set up PHPMailer configuration
        $mail->SMTPDebug = false;
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'Harunarrasheeed@gmail.com';
        $mail->Password = 'ugnrkiynvmnwuyxz';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('Harunarrasheeed@gmail.com', 'IAEC University Togo');
        $mail->addReplyTo('do-not-reply@iaec.tg', 'IAEC University Togo');
        $mail->addAddress($usermail, $username);

        // Asynchronously send the email
        $mail->isHTML(true);
        $mail->Subject = $title;
        $mail->Body ='
        <!doctype html>
          <html>
            <head>
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
              <title>Email Template</title>
              <style>
                body{
                  font-family: Trebuchet MS;
                }
                @media only screen and (max-width: 620px) {
                table.body h1 {
                  font-size: 28px !important;
                  margin-bottom: 10px !important;
                }
          
            table.body p,
          table.body ul,
          table.body ol,
          table.body td,
          table.body span,
          table.body a {
              font-size: 16px !important;
            }
          
            table.body .wrapper,
          table.body .article {
              padding: 10px !important;
            }
          
            table.body .content {
              padding: 0 !important;
            }
          
            table.body .container {
              padding: 0 !important;
              width: 100% !important;
            }
          
            table.body .main {
              border-left-width: 0 !important;
              border-radius: 0 !important;
              border-right-width: 0 !important;
            }
          
            table.body .btn table {
              width: 100% !important;
            }
          
            table.body .btn a {
              width: 100% !important;
            }
          
            table.body .img-responsive {
              height: auto !important;
              max-width: 100% !important;
              width: auto !important;
            }
          }
          @media all {
            .ExternalClass {
              width: 100%;
            }
          
            .ExternalClass,
          .ExternalClass p,
          .ExternalClass span,
          .ExternalClass font,
          .ExternalClass td,
          .ExternalClass div {
              line-height: 100%;
            }
          
            .apple-link a {
              color: inherit !important;
              font-family: inherit !important;
              font-size: inherit !important;
              font-weight: inherit !important;
              line-height: inherit !important;
              text-decoration: none !important;
            }
          
            #MessageViewBody a {
              color: inherit;
              text-decoration: none;
              font-size: inherit;
              font-family: inherit;
              font-weight: inherit;
              line-height: inherit;
            }
          
            .btn-primary table td:hover {
              background: #0d6efd;
            }
          
            .btn-primary a:hover {
              background-color: #0d6efd !important;
              border-color: #0d6efd !important;
            }
          }
          </style>
            </head>
            <body style="background-color: #f6f6f6; line-height: 1.4; margin: 0; padding: 0; font-family: Trebuchet MS; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" width="100%" bgcolor="#f6f6f6">
                <tr>
                  <td style=" font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
                  <td class="container" style="font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;" width="580" valign="top">
                    <div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
          
                      <!-- START CENTERED WHITE CONTAINER -->
                      <table role="presentation" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; border-radius: 3px; width: 100%;" width="100%">
          
                        <!-- START MAIN CONTENT AREA -->
                        <tr>
                          <td class="wrapper" style="font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;" valign="top">
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                              <tr>
                                <td style="font-size: 14px; vertical-align: top;" valign="top">
                                  <h1 style="font-weight: bold; text-align: center; color:#0649af">IAEC University Togo</h1>
                                  <p style="font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Dear: '.strtoupper($username).'</p>
                                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; width: 100%;" width="100%">
                                    <tbody>
                                      <tr>
                                        <td align="left" style="font-size: 14px; vertical-align: top; padding-bottom: 15px;" valign="top">
                                          '.$message.'
                                        </td>
                                      </tr>
                                      <tr>
                                      <td align="left" style="font-size: 14px; vertical-align: top; padding-bottom: 15px;" valign="top">
                                        <h4> Click this link to create a new password: '.$userlink.'</h4>
                                      </td>
                                    </tr>
                                    </tbody>
                                  </table>
                                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                      <tbody>
                                      <tr>
                                      <p>Thank You!</p>
                                      <p style="margin-top: -10px;">Office: Admission Office.</p>
                                      <p style="margin-top: -10px;"></p>IAEC University Togo.</p>
                                      </tr>
                                      </tbody>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
          
                      <!-- END MAIN CONTENT AREA -->
                      </table>
                      <!-- END CENTERED WHITE CONTAINER -->
          
                      <!-- START FOOTER -->
                      <div class="footer" style="clear: both; margin-top: 10px; text-align: center; width: 100%;">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                          <tr>
                            <td class="content-block powered-by" style="vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #999999; font-size: 12px; text-align: center;" valign="top" align="center">
                              <strong >© <a href="https://iaec-university.tg" class="footer-link" style="color: #0649af; font-size: 12px; text-align: center; text-decoration: none;">IAEC University Togo</a> | All rights
                              reserved 2023 | Design & Developed By <a href="#" class="footer-link" style="color: #0649af; font-size: 12px; text-align: center; text-decoration: none;">AJANGO Technologies LTD.</a></strong>
                            </td>
                          </tr>
                        </table>
                      </div>
                      <!-- END FOOTER -->
          
                    </div>
                  </td>
                  <td style="font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
                </tr>
              </table>
            </body>
          </html>
        ';

        try {
            $mail->send();
            $response = [
                'code' => 200,
                'msg' => 'Email has been sent successfully.',
                'email' =>$usermail,
            ];
        } catch (Exception $e) {
            $response = [
                'code' => 419,
                'msg' => 'Failed to send the email.',
            ];
        }

        echo json_encode($response);
    } else {
        $response = [
            'code' => 419,
            'msg' => 'No user found with the provided email.',
        ];
        echo json_encode($response);
    }
} else {
    $response = [
        'code' => 419,
        'msg' => 'The email field is empty.',
    ];
    echo json_encode($response);
}



                    

?>