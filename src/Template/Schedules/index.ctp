<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Schedule[]|\Cake\Collection\CollectionInterface $schedules
 */
?>
<div id="schedule">
    <div class="title"><?php __('Schedule'); ?></div>
    <div class="navi">
        <table><tr>
            <td class="date"><?php echo(date(__('F j, Y', true), $times['from_time'])); ?></td>
            <td class="menu"><?php echo $this->ScheduleTable->navi('schedules', $scope, $current); ?></td>
        </tr></table>
    </div>
    <div class="main">
        <?php echo $this->html->link(__('Add new schedule', true), ['controller'=> 'schedules', 'action' => 'add']); ?>
        <?php echo $this->ScheduleTable->$scope($schedules, $times); ?>
    </div>
    <div class="scope">
        <ul>
            <li><?php echo $this->html->link(__('Weekly', true), ['controller'=> 'schedules', 'action' => 'index/week', date('Y/m/d', $times['from_time'])]); ?></li>
            <li><?php echo $this->html->link(__('Monthly', true), ['controller'=> 'schedules', 'action' => 'index/month', date('Y/m/d', $times['from_time'])]); ?></li>
            <li><?php echo $this->html->link(__('Daily', true), ['controller'=> 'schedules', 'action' => 'index/day', date('Y/m/d', $times['from_time'])]); ?></li>
        </ul>
    </div>
</div>
