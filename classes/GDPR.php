<?php

namespace Martin\Forms\Classes;

use Request;
use Martin\Forms\Models\Record;
use Martin\Forms\Models\Settings;
use Carbon\Carbon;

class GDPR {

    public static function cleanRecords() {
        $gdpr = Settings::get('gdpr', false);
        $days = Carbon::now()->subDays($gdpr);
        $rows = Record::whereDate('created_at', '<', $days)->forceDelete();
        return $rows;
    }

}

?>