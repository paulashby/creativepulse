<?php namespace ProcessWire;

$site_settings_page = $pages->get(1349);
$to = $site_settings_page->contact_email;
$confirmation_message = $site_settings_page->confirmation_message;

if ( ! $config->ajax) {
	// We shouldn't be here...
	throw new Wire404Exception();
}

$honeypot = $input->post->text("name");

if ($honeypot) {
    // Bot submission - reject!
    return json_encode(array("success"=>false, "data"=>"There was an error in the form"));
}
$subject = "CONTACT FORM SUBMISSION: ";
$fname = $input->post->text("fname");
$lname = $input->post->text("lname");
$from = $input->post->email("email");
$subject .= $input->post->text("subject");
$message = $input->post->textarea("message");

$body = "Message submitted by $fname $lname\n\n$message";

// Email message to address provided in site settings
$mail->send($to, $from, $subject, $body);

return json_encode(array("success"=>true, "data"=>$confirmation_message));
