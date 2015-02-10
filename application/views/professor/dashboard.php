
<?php echo $this->session->flashdata('message'); ?>

<?php if (!empty($exams)): ?>

    <div class="page-header">
        <h1>Created exams</h1>
    </div>

    <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Exam name</th>
              <th>Course</th>
              <th>Start date</th>
              <th>Due date</th>
              <th>State</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

    <?php
        $i = 1;
        foreach ($exams as $exam => $exam_data): ?>

        <tr>
          <th scope="row"><?php echo $i; ?></th>
          <td><?php echo $exam_data->exam_name; ?></td>
          <td><?php echo $exam_data->course_name; ?></td>
          <td><?php echo $exam_data->start_date; ?></td>
          <td><?php echo $exam_data->due_date; ?></td>
          <td><?php echo ($exam_data->enabled == 0) ? 'Disabled' : 'Enabled'; ?></td>
          <td>
            <div class="btn-group">
              <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                Select <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a title="View exam" href="<?php echo base_url() . 'index.php/exams/view/' . $exam_data->exam_template_id ?>">View</a></li>
                <li><a title="Edit exam" href="<?php echo base_url() . 'index.php/exams/edit/' . $exam_data->exam_template_id ?>">Edit</a></li>
                <li><a title="Remove exam" class="remove-exam" href="<?php echo base_url() . 'index.php/exams/remove/' . $exam_data->exam_template_id ?>">Remove</a></li>
              </ul>
            </div><!-- /btn-group -->
          </td>
        </tr>

    <?php
        $i++;
        endforeach; ?>

      </tbody>
    </table>

<?php else: ?>

    <div class="page-header">
        <h1>Dashboard</h1>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Information</h3>
      </div>
      <div class="panel-body">
        You haven't created any exam yet!
      </div>
    </div>

<?php endif; ?>

    <a href="<?php echo base_url() . 'index.php/exams/create' ?>" class="btn btn-primary btn-lg">Create exam <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>

<script>

  $('.remove-exam').on('click', function(evt){
    if (!confirm('Are you sure you want to delete this exam?')){
      evt.preventDefault();
    }
  });

</script>
