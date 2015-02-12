
<?php echo $this->session->flashdata('message'); ?>

<div class="page-header">
    <h1><?php echo $exam_template->name; ?> <small>Edit exam</small></h1>
</div>

<?php
    $attributes = array('class' => 'form-horizontal', 'role' => 'form', 'id' => 'edit-exam-form');

    echo form_open('exams/edit', $attributes);
?>

<h3>Configuration</h3>

<div class="form-group">
  <div class="col-xs-4">
   <label class="sr-only" for="exam_name">Exam name</label>
   <div class="input-group">
     <div class="input-group-addon">Exam name</div>
     <input type="text" class="form-control" name="exam_name" placeholder="Name" value="<?php echo $exam_template->name; ?>">
   </div>
  </div>
</div>

<div class="form-group">
  <div class="col-xs-3">
   <label class="sr-only" for="start_date">Start date</label>
   <div class="input-group">
     <div class="input-group-addon">Start date</div>
     <input type="date" class="form-control" name="start_date" placeholder="YYYY-MM-DD" value="<?php echo $exam_template->start_date; ?>">
   </div>
  </div>
</div>

<div class="form-group">
  <div class="col-xs-3">
   <label class="sr-only" for="due_date">Due date</label>
   <div class="input-group">
     <div class="input-group-addon">Due date</div>
     <input type="date" class="form-control" name="due_date" placeholder="YYYY-MM-DD" value="<?php echo $exam_template->due_date; ?>">
   </div>
   </div>
</div>

<div class="form-group">
  <div class="col-xs-3">
   <label class="sr-only" for="duration">Duration</label>
   <div class="input-group">
     <div class="input-group-addon">Duration</div>
     <input type="number" class="form-control" name="duration" step="1" min="0" max="120" placeholder="eg. 10 (minutes)" value="<?php echo $exam_template->duration; ?>">
   </div>
   </div>
</div>

<div class="form-group">
  <div class="col-xs-4">
   <div class="checkbox">
     <label>
       <input type="checkbox" id="exam_enabled"> Enable exam
     </label>
   </div>
   </div>
</div>

<hr>

<h3>Questions</h3>

<?php
  $i = 1;
  foreach ($exam_questions as $question_id => $question): ?>

      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h3 class="panel-title pull-left"><?php echo 'Question ' . $i; ?></h3>
          <button type="button" class="btn btn-danger btn-xs pull-right remove-question" data-question-id="<?php echo $question_id; ?>">
            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Remove</button>
        </div>
        <div class="panel-body">

          <div class="form-group option-wrapper">
                <label for="statement-<?php echo $question_id; ?>" class="col-sm-2 control-label">Statement</label>
                <div class="col-sm-10">
                  <div class="form-group row">
                    <div class="col-md-10">
                    <input type="text" class="form-control" name="statement-<?php echo $question_id; ?>" value="<?php echo $question['statement']; ?>" placeholder="Statement">
                    </div>
                  </div>
                </div>
          </div>
          <div class="options-wrapper">

      <?php if ($question['type'] == 0): ?>
      <?php foreach ($question['options'] as $option_id => $option_name): ?>
          <div class="form-group option-wrapper">
                <label for="op-<?php echo $option_id; ?>-name" class="col-sm-2 control-label">Option</label>
                <div class="col-sm-10">
                  <div class="form-group row">
                    <div class="col-md-10">
                    <input type="text" class="form-control" name="op-<?php echo $option_id; ?>-name" value="<?php echo $option_name; ?>" placeholder="Option name">
                    </div>
                    <div class="col-md-2">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="op-<?php echo $option_id; ?>-correct" value="1"> Correct &nbsp;
                        </label>
                        <button type="button" class="btn btn-xs btn-default remove-option" aria-label="Remove option" data-option-id="<?php echo $option_id; ?>">
                          <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
          </div>

      <?php endforeach ?>
      <?php else: ?>
        <?php foreach ($question['options'] as $option_id => $option_name): ?>
        <div class="form-group option-wrapper">
              <label for="op-<?php echo $option_id; ?>-name" class="col-sm-2 control-label">Criteria</label>
              <div class="col-sm-10">
                <div class="form-group row">
                  <div class="col-md-10">
                  <input type="text" class="form-control" name="op-<?php echo $option_id; ?>-criteria-name" value="<?php echo $option_name; ?>" placeholder="Criteria name">
                  </div>
                  <div class="col-md-2">
                      <input type="number" step="0.25" min="0" class="form-control" name="op-<?php echo $option_id; ?>-criteria-points" placeholder="Number">
                  </div>
                </div>
              </div>
        </div>
        <?php endforeach ?>
      <?php endif ?>

        </div>
          <button type="button" class="btn btn-primary btn-xs add-option" data-question-id="<?php echo $question_id ?>">Add option +</button>
        </div>
      </div>

<?php $i++;
      endforeach;
    ?>


<?php echo form_close()?>

<br>

    <!-- Split button -->
    <div class="btn-group">
      <button type="button" class="btn btn-lg btn-primary">Add <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
      <button type="button" class="btn btn-lg btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
      </button>
      <ul class="dropdown-menu" role="menu">
        <li><a id="add-open-question" href="#">Open question</a></li>
        <li><a id="add-closed-question" href="#" data-exam-template-id="<?php echo $exam_template->id ?>">Closed question</a></li>
      </ul>
    </div>
    <a href="<?php echo base_url(); ?>" class="btn btn-default btn-lg">Cancel</a>
    <button type="submit" class="btn btn-success btn-lg">Save changes <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>

<script>

    $(document).ready(function(){

      var item = $('<div class="panel panel-default"> <div class="panel-heading clearfix"> <h3 class="panel-title pull-left">Question 1</h3> <button type="button" class="btn btn-danger btn-xs pull-right remove-question" data-question-id=""> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Remove</button> </div> <div class="panel-body"> <div class="form-group option-wrapper"> <label for="" class="col-sm-2 control-label">Statement</label> <div class="col-sm-10"> <div class="form-group row"> <div class="col-md-10"> <input type="text" class="form-control" name="" value="" placeholder="Statement"> </div> </div> </div> </div> <div class="options-wrapper"> </div> <button type="button" class="btn btn-primary btn-xs add-option" data-question-id="">Add option +</button> </div> </div>');

      var controller = 'exams/action/',
          base_url = <?php echo "'" . base_url() . 'index.php/' . "'"; ?>

      addListeners();
      addOptionsListeners();
      addOptionsListeners2();

        $('#add-closed-question').on('click', function(evt){
            $.ajax({
                url: base_url + controller + 'add_closed_question',
                type: 'POST',
                cache: false,
                data: { "exam_template_id": $(this).data('exam-template-id') },
            })
            .done(function(response) {
                $('#edit-exam-form').append(item);
                addListeners();
                addOptionsListeners();
                addOptionsListeners2();
            })
            .fail(function(e) {
                console.log(e);
            });
            addListeners();
        });

        function addListeners(){
          $('.remove-question').on('click', function(evt){
              var self = $(this);
              if (confirm('Are you sure you want to delete this question')) {
                $.ajax({
                    url: base_url + controller + 'remove_question',
                    type: 'POST',
                    cache: false,
                    data: { "question_id": $(this).data('question-id') },
                })
                .done(function(response) {
                    self.closest('.panel').hide('slow', function(){
                      $(this).remove();
                    });
                })
                .fail(function(e) {
                    console.log(e);
                });
              }
          });
        }

        function addOptionsListeners(){
          $('.remove-option').on('click', function(evt){
              // console.log($('.remove-option').closest('.form-wrapper'));
              var self = $(this);
              if (confirm('Are you sure you want to delete this option')) {
                $.ajax({
                    url: base_url + controller + 'remove_option',
                    type: 'POST',
                    cache: false,
                    data: { "option_id": $(this).data('option-id') },
                })
                .done(function(response) {
                    self.closest('.option-wrapper').hide('fast', function(){
                      $(this).remove();
                    });
                })
                .fail(function(e) {
                    console.log(e);
                });
              }
          });
        }

        var newOptionTemplate = $('<div class="form-group option-wrapper"><label for="" class="col-sm-2 control-label">Option</label> <div class="col-sm-10"> <div class="form-group row"> <div class="col-md-10"> <input type="text" class="form-control" name="" value="" placeholder="Option name"> </div> <div class="col-md-2"> <div class="checkbox"> <label> <input type="checkbox" name="" value="1"> Correct &nbsp; </label> <button type="button" class="btn btn-xs btn-default remove-option" aria-label="Remove option" data-option-id=""> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </button> </div> </div> </div> </div> </div>');

        function addOptionsListeners2(){
          $('.add-option').on('click', function(evt){
              var self = $(this);
                $.ajax({
                    url: base_url + controller + 'add_option',
                    type: 'POST',
                    cache: false,
                    data: { 'question_id' : $(this).data('question-id') },
                })
                .done(function(response) {
                    self.prev('.options-wrapper').append(newOptionTemplate);
                })
                .fail(function(e) {
                    console.log(e);
                });
          });
        }

    });

</script>
