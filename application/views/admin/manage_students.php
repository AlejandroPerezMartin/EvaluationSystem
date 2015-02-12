
<div class="page-header">
    <h1><?php echo $course_name; ?><br><small>Enroll/Unenroll students</small></h1>
</div>
<div class="row">

  <div class="col-xs-6 col-md-5">
    <h4>Available students:</h4>
    <select name="users_not_enrolled" id="users_not_enrolled" multiple size="10" class="form-control">
        <?php foreach ($users_not_in_course as $key => $user): ?>
            <option value="<?php echo $user->id; ?>"><?php echo '[' . $user->id . '] ' . $user->name; ?></option>
        <? endforeach; ?>
    </select>
  </div>

  <div class="col-xs-4 col-md-2 text-center">
    <br><br><br><br>
    <p>
        <button class="btn btn-primary btn-lg" id="enroll" type="submit">
            Enroll <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        </button>
    </p>
    <p>
        <button class="btn btn-primary btn-lg" id="unenroll" type="submit">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Unenroll
        </button>
    </p>
  </div>

  <div class="col-xs-6 col-md-5">
    <h4>Enrolled students:</h4>
      <select name="users_enrolled" id="users_enrolled" multiple size="10" class="form-control">
      <?php foreach ($users_in_course as $key => $user): ?>
          <option value="<?php echo $user->user_id; ?>"><?php echo '[' . $user->user_id . '] ' . $user->name; ?></option>
      <? endforeach; ?>
      </select>
  </div>

</div>

<script>

    $(document).ready(function(){

        var controller = 'admin/manage/',
            base_url = <?php echo "'" . base_url() . 'index.php/' . "'"; ?>

        $('#enroll').on('click', function(){
            if ($('#users_not_enrolled').val() === null) {
                alert('Please select at least one student');
            }
            else {
                $.ajax({
                    url: base_url + controller + 'enroll',
                    type: 'POST',
                    cache: false,
                    data: { "user_id": $('#users_not_enrolled').val(), "course_id": '<?php echo $course_id; ?>' },
                })
                .done(function(response) {
                    location.reload();
                })
                .fail(function(e) {
                    console.log(e);
                });
            }
        });

        $('#unenroll').on('click', function(){
            if ($('#users_enrolled').val() === null) {
                alert('Please select at least one student');
            }
            else {
                $.ajax({
                    url: base_url + controller + 'unenroll',
                    type: 'POST',
                    cache: false,
                    data: { "user_id": $('#users_enrolled').val(), "course_id": '<?php echo $course_id; ?>' },
                })
                .done(function(response) {
                    location.reload();
                })
                .fail(function(e) {
                    console.log(e);
                });
            }
        });

    });

</script>
