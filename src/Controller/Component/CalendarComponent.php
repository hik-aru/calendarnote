<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Calendar component
 */
class CalendarComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    function scopeToTimes($scope){
        $time = mktime(0,0,0);
        switch($scope){
            case 'month' :
                $firstday = mktime(0,0,0,date('n'),1);
                $from_time = mktime(0,0,0,date('n'),1 - date('w', $firstday), $year);
                $days = ceil((date('t', $time) + date('w', $firstday)) / 7) * 7;
                break;
            case 'day' :
                $from_time = $time;
                $days = 1;
                break;
            case 'week' :
            default :
                $from_time = $time;
                $days = 7;
                $scope = 'week';
                break;
        }
        $to_time = $from_time + $days * DAY -1;

        return compact('from_time', 'to_time');
    }
}
