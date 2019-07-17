<?php
if (!defined("INTERN_CALL")) die("<p><b>DIRECT ACCESS DENIED!</b></p>");

$Lang['DefaultGuestbookName'] = "My Guestbook";

$Lang['TextCutMark'] = "... (text has been reduced!)";

$Lang['BackToGB'] = "Back to guestbook";

$Lang['PostAddNewTitle'] = "Add new posting";
$Lang['PostAddNewEntry'] = "Add new posting";

$Lang['PostError'] = "Error:";

$Lang['PostErrNoName'] = "Please enter your name.";
$Lang['PostErrInvalidMailAddr'] = "Please enter a valid mail address (e.g.: first.lastname@provider.tld).";
$Lang['PostErrInvalidUrl'] = "Please enter a valid URL for your website (e.g.: http://www.website.tld/).";
$Lang['PostErrNoText'] = "Please enter a text.";
$Lang['PostErrNoCode'] = "Please enter the security code.";
$Lang['PostErrWrongCode'] = "Please enter the correct security code.";

$Lang['RuleTextMatch'] = "The posting text have an unwanted or invalid content (%s1%).";
$Lang['RuleNameMatch'] = "The name have an unwanted or invalid content (%s1%).";
$Lang['RuleMailMatch'] = "The mail address have an unwanted or invalid content (%s1%).";
$Lang['RuleHomeMatch'] = "The homepage URL have an unwanted or invalid content (%s1%).";

$Lang['PostFormName'] = "Your name:";
$Lang['PostFormMail'] = "Your mail address:";
$Lang['PostFormHome'] = "Your website:";
$Lang['PostFormText'] = "Text:";
$Lang['PostFormTextMax'] = "(max. 1.000 chars,<br>no HTML tags)";
$Lang['PostFormCode'] = "Security code:";
$Lang['PostFormCodeQuery'] = "Enter security code:";
$Lang['PostFormCodeQueryInfo'] = "Please enter the 6 characters of the security code.";
$Lang['PostFormCalc'] = "How much is:";
$Lang['PostFormCalcStr'] = "%s1% ?";
$Lang['PostFormCalcQuery'] = "Result:";
$Lang['PostFormCalcQueryInfo'] = "Please enter the result of the addition.";
$Lang['PostFormSmilies'] = "SMILIES:";
$Lang['PostFormEmoticons'] = "EMOTICONS:";
$Lang['PostFormTags'] = "TAGS:";
$Lang['PostFormTagAnd'] = "and";
$Lang['PostFormTagBold'] = "for <b>bold</b>";
$Lang['PostFormTagItalic'] = "for <i>italic</i>";
$Lang['PostFormTagUnderline'] = "for <u>underline</u>";

$Lang['PostFormOptFields'] = " = optional fields";
$Lang['PostFormSubmit'] = "Submit";
$Lang['PostFormReset'] = "Reset";

$Lang['NotifyCharset'] = "iso-8859-1";
$Lang['NotifySubject'] = "New posting in guestbook";
$Lang['NotifyText'] = "New posting at <b>%s1%</b>:<br>\n".
                      "From: <b>%s2%</b> &lt;<a href=\"mailto:%s3%\">%s3%</a>&gt;".
                      " (<a href=\"%s4%\">%s4%</a>)<br>\n<br>\n";

$Lang['PostThankYou'] = "Thank you for your posting!";

$Lang['AdminAuthTitle'] = "Administration";
$Lang['AdminAuthText'] = "Authentification required!";
$Lang['AdminLinkTitle'] = "Administration:";
$Lang['AdminLink'] = "Login";
$Lang['AdminDelete'] = "Delete posting";

$Lang['ViewPostings'] = "Postings:";
$Lang['NavPageLast'] = "Last";
$Lang['NavPageFirst'] = "First";

$Lang['ItemWebsiteVisit'] = "Visit the webseite from %s1%";
$Lang['ItemWebsiteAlt'] = "Webseite";
$Lang['ItemEMailSend'] = "Send an e-mail to %s1%";
$Lang['ItemEMailAlt'] = "E-mail";
$Lang['ItemInfo'] = "Posting #%s1% at %s2%";

?>