<?php

namespace BlakeJones\MagicForms\Classes;

use Schema;
use BlakeJones\MagicForms\Models\Record;

class UnreadRecords {

    public static function getTotal() {
        if (Schema::hasTable('blakejones_magicforms_records')) {
            $unread = Record::where('unread', 1)->count();
        }

        return (isset($unread) && $unread > 0) ? $unread : null;
    }

}

?>