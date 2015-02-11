
<?php if (!empty($courses)): ?>

    <div class="page-header">
        <h1>List of courses</h1>
    </div>

    <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Code</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

    <?php
        $i = 1;
        foreach ($courses as $key => $course): ?>

        <tr>
          <th scope="row"><?php echo $i; ?></th>
          <td><?php echo $course->name; ?></td>
          <td><?php echo $course->acronym; ?></td>
          <td><?php echo $course->description; ?></td>
          <td>
            <div class="btn-group">
                <a href="<?php echo base_url() . 'index.php/admin/manage/students/' . $course->id; ?>" class="btn btn-default btn-xs">Manage students</a>
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
        There are no courses in our database
      </div>
    </div>

<?php endif; ?>

<script>

  $('.remove-exam').on('click', function(evt){
    if (!confirm('Are you sure you want to delete this exam?')){
      evt.preventDefault();
    }
  });

</script>
