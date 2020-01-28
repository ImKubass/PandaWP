<?php

namespace Layouts\Contact;

class ContactFactory
{

    /** @return ContactModel */
    public static function create()
    {
        global $post;
        return new ContactModel($post);
    }
}
