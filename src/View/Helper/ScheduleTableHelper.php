<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\Error\Debugger;

/**
 * ScheduleTable helper
 */
class ScheduleTableHelper extends Helper
{

	public $helpers = ['Html'];

   function week($schedules, $times) {
		$out = '';
		$out = '<table class="week">';
		$out .= '<thead>';
		$out .= '<tr>';
		for($time = $times['from_time']; $time < $times['to_time']; $time +=  DAY) {
			$out .= '<td class="'.strftime('%a', $time).'">';
			$out .= $this->dayLink($time);
			$out .= '</td>';
		}
		$out .= '</tr>';
		$out .= '</thead>';
		$out .= '<tbody>';
		$out .= '<tr>';
		for($time = $times['from_time']; $time < $times['to_time']; $time +=  DAY) {
			$schedule_data = '';
			foreach($schedules as $schedule) {
				if(date('Ymd', $time) >= date('Ymd', strtotime($schedule['StartDate']))
				&& date('Ymd', $time) <= date('Ymd', strtotime($schedule['EndDate']))) {
					$schedule_data .= $this->daySchedule($time, $schedule);
					$schedule_data .= '<br />';
				}
			}
			$out .= '<td class="'.strftime('%a', $time).'">';
			$out .= $schedule_data;
			if(empty($schedule_data)) {
				$out .= '&nbsp;';
			}
			$out .= '</td>';
		}
		$out .= '</tr>';
		$out .= '</tbody>';
		$out .= '</table>';

		return $out;
	}

    function month($schedules, $times) {
		$out = '';
		$out = '<table class="month">';
		$out .= '<tbody>';
		for($time = $times['from_time']; $time < $times['to_time']; $time +=  DAY) {
			$schedule_data = '';
			foreach($schedules as $schedule) {
				if(date('Ymd', $time) >= date('Ymd', strtotime($schedule['StartDate']))
				&& date('Ymd', $time) <= date('Ymd', strtotime($schedule['EndDate']))) {
					$schedule_data .= $this->daySchedule($time, $schedule);
					$schedule_data .= '<br />';
				}
			}
			if(date('w', $time)==0) { // sun
				$out .= '<tr>'; //日曜日なら新しい行を開始する
			}
			$out .= '<td class="'.strftime('%a', $time).'">';
			$out .= '<table class="day_in_month">';
			$out .= '<tr>';
			$out .= '<th>';
			$out .= $this->dayLink($time);
			$out .= '</th>';
			$out .= '</tr>';
			$out .= '<tr>';
			$out .= '<td>';
			$out .= $schedule_data;
			if(empty($schedule_data)) {
				$out .= '&nbsp;';
			}
			$out .= '</td>';
			$out .= '</tr>';
			$out .= '</table>';
			$out .= '</td>';
			if(date('w', $time)==6) { // sat
				$out .= '</tr>'; //土曜日なら行を終了する
			}
		}
		$out .= '</tbody>';
		$out .= '</table>';

		return $out;
	}

	function day($schedules, $times) {
		$out = '';
		$out = '<table class="day">';
		$out .= '<thead>';
        $out .= '<tr>';
        //指定された日付の開始時刻から終了時刻まで1時間おきに時刻を表示する
		for($time = $times['from_time']; $time < $times['to_time']; $time +=  HOUR) {
			$out .= '<th colspan="6">'.date('G',$time).'</th>';
		}
		$out .= '</tr>';
        $out .= '<tr>';
        //指定された日付の開始時刻から終了時刻まで10分おきにレーンを表示する
		$maxcol = ceil(($times['to_time']-$times['from_time']) / HOUR) * 6;
		for($i = 0; $i < $maxcol; $i++) {
			$out .= '<td>&nbsp;</td>';
		}
		$out .= '</tr>';
		$out .= '</thead>';
		$out .= '<tbody>';
		$out .= '<tr>';
		$schedule_data = '';
		$time = $times['from_time'];
		foreach($schedules as $schedule) {
            //表示する予定がある場合は、予定内容をschedule_dateに追加
			if(date('YmdHi', $time) < date('YmdHi', strtotime($schedule['StartDate']))) {
				$schedule_data .= $this->emptyTime($time, strtotime($schedule['StartDate']));
            }
            //スケジュールが始まるまでの時間分、空のレーンを前に追加する
			$schedule_data .= $this->timeSchedule($schedule, $times['from_time'], $times['to_time']);
			$time = strtotime($schedule['EndDate']);
		}
		$out .= $schedule_data;
		if($time < $times['to_time']) {
			$out .= $this->emptyTime($time, $times['to_time']+1);
		}
		$out .= '</tr>';
		$out .= '</tbody>';
		$out .= '</table>';

		return $out;
    }
    
    private function daySchedule($target, $schedule) {
		$out = sprintf('%s-%s %s',
			$this->dateOrTime($target, $schedule['StartDate']),
			$this->dateOrTime($target, $schedule['EndDate']),
			$schedule['title']
		);
		$out = $this->Html->link($out, ['action'=>'edit', $schedule['id']]);
		return $out;
	}
	
	private function dateOrTime($target, $scheduleTime) {
		if(date('Ymd', $target) == date('Ymd', strtotime($scheduleTime))) {
			$out = date('G:i', strtotime($scheduleTime));
		} else {
			$out = date('m/d', strtotime($scheduleTime));
		}
		return $out;
	}
	private function emptyTime($from, $to) {
		$colspan = intval(($to - $from) / (MINUTE*10));
		$out = sprintf('<td colspan="%s" class="empty">&nbsp;</td>', $colspan);
		return $out;
	}

	private function timeSchedule($schedule, $mintime, $maxtime) {
		$from = max(strtotime($schedule['StartDate']), $mintime);
		$to = min(strtotime($schedule['EndDate']), $maxtime);
		$colspan = ceil(($to - $from) / (MINUTE*10));
		$out = sprintf('<td colspan="%d">', $colspan);
		$out .= sprintf('%s-%s %s',
			$this->dateOrTime($maxtime, $schedule['StartDate']),
			$this->dateOrTime($maxtime, $schedule['EndDate']),
			$schedule['title']
		);
		$out .= '</td>';
		return $out;
	}

	private function dayLink($time){
		$out = strftime('%m/%d', $time).__(strftime('(%a)', $time), true);
		$out = $this->Html->link($out, ['action'=>'index/day', date('Y/m/d', $time)]);
		return $out;
	}

	//***************************************************************
	// Menu Navigations 
	//***************************************************************
	function navi($controller, $scope, $current) {
		$method = $scope.'_navi';
		return $this->$method($controller, $current);
	}
	function month_navi($controller, $current) {
		$out = '<ul>';
		list($year, $month, $day) = explode('/', $current);
		$out .= sprintf('<li><a href="/calendarnote/%s/index/month/%s">%s</a></li>',
				$controller,
				date('Y/m', mktime(0,0,0,$month-1,1,$year)),
				__('Last month', true));
		$out .= sprintf('<li><a href="/calendarnote/%s/index/month/%s">%s</a></li>',
				$controller,
				date('Y/m'),
				__('This month', true));
		$out .= sprintf('<li><a href="/calendarnote/%s/index/month/%s">%s</a></li>',
				$controller,
				date('Y/m', mktime(0,0,0,$month+1,1,$year)),
				__('Next month', true));
		$out .= '</ul>';
		return $out;
	}
	function week_navi($controller, $current) {
		$out = '<ul>';
		list($year, $month, $day) = explode('/', $current);
		$out .= sprintf('<li><a href="/calendarnote/%s/index/week/%s">%s</a></li>',
				$controller,
				date('Y/m/d', mktime(0,0,0,$month,$day-7,$year)),
				__('Last week', true));
		$out .= sprintf('<li><a href="/calendarnote/%s/index/week/%s">%s</a></li>',
				$controller,
				date('Y/m/d', mktime(0,0,0,$month,$day-1,$year)),
				__('Previous day', true));
		$out .= sprintf('<li><a href="/calendarnote/%s/index/week/%s">%s</a></li>',
				$controller,
				date('Y/m/d'),
				__('This week', true));
		$out .= sprintf('<li><a href="/calendarnote/%s/index/week/%s">%s</a></li>',
				$controller,
				date('Y/m/d', mktime(0,0,0,$month,$day+1,$year)),
				__('Next day', true));
		$out .= sprintf('<li><a href="/calendarnote/%s/index/week/%s">%s</a></li>',
				$controller,
				date('Y/m/d', mktime(0,0,0,$month,$day+7,$year)),
				__('Next week', true));
		$out .= '</ul>';
		return $out;
	}
	function day_navi($controller, $current) {
		$out = '<ul>';
		list($year, $month, $day) = explode('/', $current);
		$out .= sprintf('<li><a href="/calendarnote/%s/index/day/%s">%s</a></li>',
				$controller,
				date('Y/m/d', mktime(0,0,0,$month,$day-1,$year)),
				__('Previous day', true));
		$out .= sprintf('<li><a href="/calendarnote/%s/index/day/%s">%s</a></li>',
				$controller,
				date('Y/m/d'),
				__('Today', true));
		$out .= sprintf('<li><a href="/calendarnote/%s/index/day/%s">%s</a></li>',
				$controller,
				date('Y/m/d', mktime(0,0,0,$month,$day+1,$year)),
				__('Next day', true));
		$out .= '</ul>';
		return $out;
	}


}
