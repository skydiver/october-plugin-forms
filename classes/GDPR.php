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
        $gdpr_days   = Settings::get('gdpr_days'  , false);

        if (!$gdpr_enable) {
            Flash::error(e(trans('martin.forms::lang.classes.GDPR.alert_gdpr_disabled')));
            return;
        }

        if ($gdpr_enable && is_numeric($gdpr_days)) {
            $days = Carbon::now()->subDays($gdpr_days);
            $rows = Record::whereDate('created_at', '<', $days)->forceDelete();
            return $rows;
        }

        Flash::error(e(trans('martin.forms::lang.classes.GDPR.alert_invalid_gdpr')));

    }

}

?>