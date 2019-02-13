<div class="users index">
<h2><?= __('Users');?></h2>
<p>
<?=
$this->Paginator->counter(
	'ページ( {{page}} / {{pages}} ), 表示件数 {{current}}件, 全件数 {{count}}, {{start}} ~ {{end}} 件目まで表示中'
)
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?= $this->Paginator->sort('id') ?></th>
	<th><?= $this->Paginator->sort(__('Login Name',true)) ?></th>
	<th><?= $this->Paginator->sort('fullname') ?></th>
	<th><?= $this->Paginator->sort('email') ?></th>
	<th><?= $this->Paginator->sort('tel') ?></th>
	<th class="actions"><?= __('Actions') ?></th>
</tr>
<?php
$i = 0;
foreach ($users as $user):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?= h($user['id']) ?>
		</td>
		<td>
			<?= h($user['username']) ?>
		</td>
		<td>
			<?= h($user['fullname']) ?>
		</td>
		<td>
			<?= h($user['email']) ?>
		</td>
		<td>
			<?= h($user['tel']) ?>
		</td>
		<td class="actions">
			<?= $this->Html->link(__('View', true), array('action'=>'view', $user['id'])) ?>
			<?= $this->Html->link(__('Edit', true), array('action'=>'edit', $user['id'])) ?>
			<?= $this->Html->link(__('Delete', true), ['action'=>'delete', $user['id']], ['confirm' => sprintf(__('Are you sure you want to delete # %s?', true), $user['id'])]) ?>
		</td>
<?php endforeach; ?>
</table>
<div class="paging">
	<?= $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled')) ?>
 | 	<?= $this->Paginator->numbers() ?>
	<?= $this->Paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled')) ?>
</div>
<div class="actions">
	<ul>
		<li><?= $this->Html->link(__('New User', true), array('action'=>'add')) ?></li>
	</ul>
</div>
</div>
