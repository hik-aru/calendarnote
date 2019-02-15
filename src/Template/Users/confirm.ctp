<?= $this->AppForm->create('User', ['url'=>['action'=>'newUser']]) ?>
	<tr><th><?= __('Login Name') ?></th>
	<td>
		<?= h($this->request->data('username')) ?>
		&nbsp;
	</td></tr>
	<tr><th><?= __('Fullname') ?></th>
	<td>
		<?= h($this->request->data('fullname')) ?>
		&nbsp;
	</td></tr>
	<tr><th><?= __('Email') ?></th>
	<td>
		<?= h($this->request->data('email')) ?>
		&nbsp;
	</td></tr>
	<tr><th><?= __('Tel') ?></th>
	<td>
		<?= h($this->request->data('tel')) ?>
		&nbsp;
	</td></tr>
	<tr><th><?= __('Memo') ?></th>
	<td>
		<?= nl2br(h($this->request->data('memo'))) ?>
		&nbsp;
	</td></tr>
	<?= $this->AppForm->hidden('mode', ['value' => 'send']) ?>

<?php
foreach ($this->request->data() as $name => $val){
	echo $this->AppForm->hidden($name, ['value'=>$val]);
}
?>
<tr><td colspan="2" class="buttons">
<?= $this->AppForm->submit(__('Save',true), array('div'=>false)) ?>
</td></tr>
<?= $this->AppForm->end() ?>
