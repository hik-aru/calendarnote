
<?= $this->AppForm->create($schedule) ?>
<?= $this->AppForm->input('StartDate', ['type'=>'datetime']) ?>
<?= $this->AppForm->input('EndDate', ['type'=>'datetime']) ?>
<?= $this->AppForm->input('title') ?>
<?= $this->AppForm->input('contents', ['rows'=>'3']) ?>

<tr><td colspan="2">
<?= $this->AppForm->submit(__('Save', true), ['div'=>false]) ?>

<input type="button" onclick="location.href='../delete/<?= $schedule['id'] ?>'" value="Delete">

</td></tr>

<?= $this->AppForm->end() ?>

