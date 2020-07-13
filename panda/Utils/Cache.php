<?php

namespace Utils;

class Cache
{
    public static function deletePandaCache()
    {
        $Files = [
            PANDA_REQUIRED_FILES_PATH,
            PANDA_CLASSES_CONFIGABLE_PATH
        ];

        foreach ($Files as $File) {
            if (is_File($File))
                unlink($File);
        }
    }
}
