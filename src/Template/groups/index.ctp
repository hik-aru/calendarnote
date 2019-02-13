<div class="groups index">
<h2><?= __('Groups');?></h2>
<p>
<?=
$this->Paginator->counter(
	'ページ( {{page}} / {{pages}} ), 表示件数 {{current}}件, 全件数 {{count}}, {{start}} ~ {{end}} 件目まで表示中'
)
?></p>

<table cellpadding="0" cellspacing="0">
<tr>
	<th><?= $this->Paginator->sort('id') ?></th>
	<th><?= $this->Paginator->sort(__('Group Name',true), 'name') ?></th>
	<th class="actions"><?= __('Actions') ?></th>
</tr>
<?php
$i = 0;
foreach ($groups as $group):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?= h($group['id']) ?>
		</td>
		<td>
			<?= h($group['name']) ?>
		</td>
		<td class="actions">
			<?= $this->Html->link(__('View', true), array('action'=>'view', $group['id'])) ?>
			<?= $this->Html->link(__('Edit', true), array('action'=>'edit', $group['id'])) ?>
			<?= $this->Html->link(__('Delete', true), array('action'=>'delete', $group['id']), ['confirm' => sprintf(__('Are you sure you want to delete # %s?', true), $group['id'])]) ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<div class="paging">
	<?= $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled')) ?>
 | 	<?= $this->Paginator->numbers() ?>
	<?= $this->Paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled')) ?>
</div>
<div class="actions">
	<ul>
		<li><?= $this->Html->link(__('New Group', true), array('action'=>'add')) ?></li>
	</ul>
</div>
</div>
