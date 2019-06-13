<?php

namespace Components\ContactForm;

use Utils\Util;

class ContactFormPresenter extends \KT_Contact_Form_Base_Presenter
{
    public function __construct($withProcessing = true)
    {
        parent::__construct($withProcessing);
    }

    // --- veřejné funkce ------------------------------

    // --- neveřejné funkce ------------------------------

    protected function processMail(array $values)
    {
        if (count($values) > 0) {
            $name = htmlspecialchars(Util::arrayTryGetValue($values, \KT_Contact_Form_Base_Config::NAME));
            $email = htmlspecialchars(Util::arrayTryGetValue($values, \KT_Contact_Form_Base_Config::EMAIL));
            $phone = htmlspecialchars(Util::arrayTryGetValue($values, \KT_Contact_Form_Base_Config::PHONE));
            $message = htmlspecialchars(Util::arrayTryGetValue($values, \KT_Contact_Form_Base_Config::MESSAGE));


            if (Util::issetAndNotEmpty($name) && Util::issetAndNotEmpty($email) && is_email($email)) {
                $ktWpInfo = new \KT_WP_Info();
                $requestUrl = Util::getRequestUrl();
                $requestLink = "<a href=\"$requestUrl\">$requestUrl</a>";

                $content = sprintf(__("Jméno a Příjmení: %s", "RLG_DOMAIN"), $name) . "<br>";
                $content .= sprintf(__("E-mail: %s", "RLG_DOMAIN"), $email) . "<br>";
                $content .= sprintf(__("Telefon: %s", "RLG_DOMAIN"), $phone) . "<br>";
                $content .= __("Zpráva:", "BT_DOMAIN") . "<br><br>$message<br><br>";
                $content .= sprintf(__("Done by URL: %s", "KT_CORE_DOMAIN"), $requestLink) . "<br><br>---<br>";


                $content .= sprintf($this->getEmailSignature(), $ktWpInfo->getUrl());

                $contactFormEmail = $this->getFormEmail();

                $mailer = new \KT_Mailer($contactFormEmail, $ktWpInfo->getName(), sprintf($this->getEmailTitle(), $ktWpInfo->getName()));
                // $mailer->setIsWpMail(true);

                $mailer->setReplyToEmail($email);
                $mailer->setContent($content);
                $mailer->setRecipient($contactFormEmail);

                $sendResult = $mailer->send();
                $this->logMailProcessed($sendResult, sprintf(__("E-mail for %s <%s> from URL %s done by: %s.", "KT_CORE_DOMAIN"), $name, $email, $requestUrl, $sendResult));
                return $sendResult;
            }
        }
        return false;
    }

    protected function initForm()
    {
        /* @var $form KT_Form */
        $form = parent::initForm();
        $form->setAction(Util::getRequestUrl());
        $form->setAttrId("contact-form");
        return $form;
    }
}
