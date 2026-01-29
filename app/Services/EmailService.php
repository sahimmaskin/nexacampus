<?php
namespace App\Services;

use App\Models\MailTemplatesModel;

class EmailService 
{
	public function sendMail($data='')
	{
		$sendTo = $data['sendTo'];
		$subject = $data['subject'];
		$text = $data['message'];
		$attachment = (isset($data['attachment'])) ? $data['attachment'] : null;		

		$mailTemplatesModel = new MailTemplatesModel(); 

		$mailTemplate = $mailTemplatesModel->find('1');

		$mailBody = $mailTemplate['mail_header'].$text.$mailTemplate['mail_footer'];  

		$email = \Config\Services::email();
        $email->setTo($sendTo);
        $email->setCC(CC_MAIL); // Only once
        $email->setSubject($subject);
        $email->setMessage($mailBody);
        $email->setCRLF("\r\n");
        $email->setNewLine("\r\n");   

        if (!empty($attachment)) {
        	// Attach the generated PDF
            $email->attach($attachment);
        }

        $email->send(); 

        if ($email->send()) {
        	return $arr = [
        		'status' => 'Success',
        		'message' => 'Email sent!',
        	];
		} else {
			return $arr = [
        		'status' => 'Failed',
        		'message' => $email->printDebugger(),
        	];
		}
	}
}
?>