
<?php echo $this->session->flashdata('message'); ?>

<div class="page-header">
    <h1><?php echo $exam->name; ?></h1>
</div>

<dl class="dl-horizontal">
  <dt>Start date</dt>
  <dd><?php echo $exam->start_date; ?></dd>
  <dt>Due date</dt>
  <dd><?php echo $exam->due_date; ?></dd>
  <dt>Duration</dt>
  <dd><?php if (!isset($exam->duration)) echo 'Not defined'; ?></dd>
  <dt>Enabled</dt>
  <dd><?php echo ($exam->enabled == 0) ? 'No' : 'Yes'; ?></dd>
</dl>
