<?php
use Components\ContactForm\ContactFormFactory;

$FormPresenter = ContactFormFactory::create();
$Form = $FormPresenter->getForm();
$Form->addAttrClass("contact-form");
$fieldset = $FormPresenter->getFieldset();


$NameField = $fieldset[KT_Contact_Form_Base_Config::NAME];

$PhoneField = $fieldset[KT_Contact_Form_Base_Config::PHONE];

$EmailField = $fieldset[KT_Contact_Form_Base_Config::EMAIL];

$MessageField = $fieldset[KT_Contact_Form_Base_Config::MESSAGE]; ?>

<?= $Form->getFormHeader(); ?>
<div class="contact-form-top">
    <div>
        <?= $NameField->getField(); ?>

        <span class="fake-placeholder"><?php _e("Jméno a příjmení*", "RLG_DOMAIN"); ?></span>
        <span class="required-notice"><?php _e("Povinné", "RLG_DOMAIN"); ?></span>
    </div>

    <div>
        <?= $PhoneField->getField(); ?>

        <span class="fake-placeholder"><?php _e("Telefon*", "RLG_DOMAIN"); ?></span>
        <span class="required-notice"><?php _e("Povinné", "RLG_DOMAIN"); ?></span>
    </div>

    <div>
        <?= $EmailField->getField(); ?>

        <span class="fake-placeholder"><?php _e("Email*", "RLG_DOMAIN"); ?></span>
        <span class="required-notice"><?php _e("Povinné", "RLG_DOMAIN"); ?></span>
    </div>
</div>

<?= $MessageField->getField(); ?>

<div class="contact-form-bottom">
    <span class="consent-notice"><?php _e("Souhlasím se zpracováním", "RLG_DOMAIN"); ?> <a href="#"><?php _e("osobních údajů", "RLG_DOMAIN"); ?></a></span>

    <span class="btn btn-paperplane submitButton">
        <span><?php _e("Odeslat dotaz", "RLG_DOMAIN"); ?></span>
    </span>
</div>

<div class="d-none">
    <?= $fieldset[KT_Contact_Form_Base_Config::FAVOURITE]->getControlHtml(); ?>
    <?= $fieldset[KT_Contact_Form_Base_Config::NONCE]->getField(); ?>
</div>


<?= $Form->getFormFooter(); ?>