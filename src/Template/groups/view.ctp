<div class="groups view">
<h2><?=  __('Group') ?></h2>
	<table>
		<tr><th><?= __('Group Name') ?></th>
		<td>
			<?= h($group['name']) ?>
			&nbsp;
		</td></tr>
		<tr><th><?= __('Memo'); ?></th>
		<td>
			<?= nl2br(h($group['memo'])) ?>
			&nbsp;
		</td></tr>
	</table>
</div>
