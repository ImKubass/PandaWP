<?php
namespace Components\ContactForm;

class ContactFormFactory
{

    private static $ContactFormPresenter;

    /** @return ContactFormPresenter */
    public static function create()
    {

        if (isset(self::$ContactFormPresenter)) {
            return self::$ContactFormPresenter;
        }
        return self::$ContactFormPresenter = new ContactFormPresenter(true);
    }
}
