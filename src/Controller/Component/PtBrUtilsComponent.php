<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\I18n\Time;

class PtBrUtilsComponent extends Component
{
    public function strToUsDate($date=null)
    {
        if (!$date) {
            return null;
        }

        $brDateTime = Time::createFromFormat(
            'd/m/Y',
             $date,
            'America/Sao_Paulo'
        );
        return $brDateTime->i18nFormat('yyyy-MM-dd');
    }
}