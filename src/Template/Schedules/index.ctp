<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Schedule[]|\Cake\Collection\CollectionInterface $schedules
 */
?>
<div id="schedule">
    <div class="title"><?php __('Schedule'); ?></div>
    <div class="navi"><?php e(date(__('F j, Y', true), $times['from_time'])); ?></div>
    <div class="main">
        <?php echo $html->link(__('Add new schedule', true), ['controller'=> 'schedules', 'action' => 'add']); ?>
        <?php echo $schedulesTable->$scope($schedules, $times); ?>
    </div>
    <div class="scope">
        <ul>
            <li><?php echo $html->link(__('Weekly', true), ['controller'=> 'schedules', 'action' => 'index', 'id' => 'week']); ?></li>
            <li><?php echo $html->link(__('Monthly', true), ['controller'=> 'schedules', 'action' => 'index', 'id' => 'month']); ?></li>
            <li><?php echo $html->link(__('Daily', true), ['controller'=> 'schedules', 'action' => 'index', 'id' => 'day']); ?></li>
        </ul>
    </div>
</div>
