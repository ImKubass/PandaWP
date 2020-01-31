<?php

namespace Layouts\Contact;

/**
 * Class ContactFactory
 * @package Layouts\Contact
 */
class ContactFactory
{

    public static function create(): ContactModel
    {
        global $post;
        return new ContactModel($post);
    }
}
