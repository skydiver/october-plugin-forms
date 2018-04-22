<?php

namespace Martin\Forms\Classes;

use Flash;
use Request;
use Martin\Forms\Models\Record;
use Martin\Forms\Models\Settings;
use Carbon\Carbon;
use October\Rain\Exception\ApplicationException;
use October\Rain\Exception\ValidationException;

class GDPR {

    public static function cleanRecords() {

        $gdpr_enable = Settings::get('gdpr_enable', false);
        $gdpr = Settings::get('gdpr', false);

        if (!$gdpr_enable) {
            Flash::error(e(trans('martin.forms::lang.classes.GDPR.alert_gdpr_disabled')));
            return;
        }

        if ($gdpr_enable && is_numeric($gdpr)) {
            $days = Carbon::now()->subDays($gdpr);
            $rows = Record::whereDate('created_at', '<', $days)->forceDelete();
            return $rows;
        }

        Flash::error(e(trans('martin.forms::lang.classes.GDPR.alert_invalid_gdpr')));

    }

}

?>