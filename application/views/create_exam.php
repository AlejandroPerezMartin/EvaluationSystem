        <?php
            $attributes = array('class' => 'form-horizontal', 'role' => 'form');

            echo form_open('exams/create', $attributes);
        ?>

            <?php if (isset($message)) echo $message; ?>

            <?php if (validation_errors()) echo '<div class="alert alert-danger" role="alert"><p><strong>Please correct the errors below:</strong></p>' . validation_errors() . '</div>' ?>

            <fieldset>
                <legend>Create exam</legend>

                <div class="form-group">
                    <div class="col-xs-4">
                        <label for="exam-name">Name:</label>
                        <input id="exam-name" type="text" name="exam-name" value="<?php echo set_value('exam-name') ?>" placeholder="Name" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-4">
                        <label for="user-courses">Course:</label>
                        <select id="user-courses" class="form-control" name="user-courses">
                        <option value="">-- Select course --</option>
                        <?php foreach ($user_courses as $course):
                            echo '<option value="' . $course->id . '" ' . set_select('user-courses', $course->id) . '>' . $course->name . ' (' . $course->acronym . ')</option>';
                        endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-4">
                        <label for="start-date">Start date:</label>
                        <input id="start-date" type="date" name="start-date" value="<?php echo set_value('start-date') ?>" placeholder="YYYY-MM-DD" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-4">
                        <label for="due-date">Due date:</label>
                        <input id="due-date" type="date" name="due-date" value="<?php echo set_value('due-date') ?>" placeholder="YYYY-MM-DD" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-3">
                        <input type="submit" value="Create exam" name="submit_create_exam" class="btn btn-lg btn-success" />
                    </div>
                </div>

            </fieldset>

        <?php echo form_close()?>

        <script>
            var todayDate = new Date();
            document.getElementById('startDate').value = todayDate.getFullYear() + "-" + ("0" + (todayDate.getMonth() + 1)).slice(-2) + "-" + ("0" + (todayDate.getDate())).slice(-2);
        </script>
<!--
        <script>

            $(document).ready(function(){

                var controller = 'exams/create/create_exam';
                base_url = <?php echo "'" . base_url() . 'index.php/' . "'"; ?>

                $('#ajax_create_exam').on('submit', function(evt){
                    evt.preventDefault();

                    $.ajax({
                        url: base_url + controller,
                        type: 'POST',
                        cache: false,
                        data: { "param": "algo" },
                    })
                    .done(function(response) {
                        $('body').html(response);
                    })
                    .fail(function(e) {
                        console.log(e);
                    });
                });

            });
        </script>
 -->
