<div class="users view">
<h2><?=  __('User') ?></h2>
	<table>
		<tr><th><?= __('Login Name') ?></th>
		<td>
			<?= h($user['username']) ?>
			&nbsp;
		</td></tr>
		<tr><th><?= __('Fullname') ?></th>
		<td>
			<?= h($user['fullname']) ?>
			&nbsp;
		</td></tr>
		<tr><th><?= __('Email') ?></th>
		<td>
			<?= h($user['email']) ?>
			&nbsp;
		</td></tr>
		<tr><th><?= __('Tel') ?></th>
		<td>
			<?= h($user['tel']) ?>
			&nbsp;
		</td></tr>
		<tr><th><?= __('Memo') ?></th>
		<td>
			<?= nl2br(h($user['memo'])) ?>
			&nbsp;
		</td></tr>
	</table>
</div>
