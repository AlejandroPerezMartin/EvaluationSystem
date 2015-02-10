
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
   <label class="sr-only" for="exampleInputAmount">Exam name</label>
   <div class="input-group">
     <div class="input-group-addon">Exam name</div>
     <input type="text" class="form-control" id="exam_name" placeholder="Name" value="<?php echo $exam_template->name; ?>">
   </div>
  </div>
</div>

<div class="form-group">
  <div class="col-xs-3">
   <label class="sr-only" for="exampleInputAmount">Start date</label>
   <div class="input-group">
     <div class="input-group-addon">Start date</div>
     <input type="date" class="form-control" id="exampleInputAmount" placeholder="YYYY-MM-DD" value="<?php echo $exam_template->start_date; ?>">
   </div>
  </div>
</div>

<div class="form-group">
  <div class="col-xs-3">
   <label class="sr-only" for="exampleInputAmount">Due date</label>
   <div class="input-group">
     <div class="input-group-addon">Due date</div>
     <input type="date" class="form-control" id="exampleInputAmount" placeholder="YYYY-MM-DD" value="<?php echo $exam_template->due_date; ?>">
   </div>
   </div>
</div>

<div class="form-group">
  <div class="col-xs-3">
   <label class="sr-only" for="exampleInputAmount">Duration</label>
   <div class="input-group">
     <div class="input-group-addon">Duration</div>
     <input type="number" class="form-control" id="exampleInputAmount" step="1" min="0" max="120" placeholder="eg. 10 (minutes)" value="<?php echo $exam_template->duration; ?>">
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

<?php if (!empty($exam_questions)): ?>

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
          <div class="options-wrapper">
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
        </div>
          <button type="button" class="btn btn-primary btn-xs add-option" data-question-id="<?php echo $question_id ?>">Add option +</button>
        </div>
      </div>

<?php $i++;
      endforeach;
    ?>

<?php endif; ?>

<?php echo form_close()?>

<br>

    <!-- Split button -->
    <div class="btn-group">
      <button type="button" class="btn btn-lg btn-primary">Add +</button>
      <button type="button" class="btn btn-lg btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
      </button>
      <ul class="dropdown-menu" role="menu">
        <li><a id="add-open-question" href="#">Open question</a></li>
        <li><a id="add-closed-question" href="#">Closed question</a></li>
      </ul>
    </div>
    <a href="<?php echo base_url(); ?>" class="btn btn-default btn-lg">Cancel</a>
    <button type="submit" class="btn btn-success btn-lg">Save changes</button>

<script>

    $(document).ready(function(){

      var item = $('<div class="panel panel-default"> <div class="panel-heading clearfix"> <h3 class="panel-title pull-left">Question 1</h3> <button type="button" class="btn btn-danger btn-xs pull-right remove-question" data-question-id="2"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Remove </button> </div> <div class="panel-body"> <div class="form-group"> <label for="inputPassword" class="col-sm-2 control-label">Statement</label> <div class="col-sm-10"> <input type="text" class="form-control" id="inputPassword" placeholder="Question statement" value="pregunta 2"> </div> </div> <div class="form-group"> <label for="inputPassword" class="col-sm-2 control-label">Option</label> <div class="col-sm-10"> <div class="form-group row"> <div class="col-md-10"> <input type="text" class="form-control" name="" value="respuesta 1" placeholder="Question statement"> </div> <div class="col-md-2"> <div class="checkbox"> <label> <input type="checkbox" name="correct-answer" value="1"> Correct &nbsp; <button type="button" class="btn btn-xs btn-default" aria-label="Remove option"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </button> </label> </div> </div> </div> </div> </div> </div></div>');

        $('#add-closed-question').on('click', function(evt){
            $('#edit-exam-form').append(item);
            addListeners();
        });

        addListeners();
        addOptionsListeners();
        addOptionsListeners2();

        var controller = 'exams/action/';
        base_url = <?php echo "'" . base_url() . 'index.php/' . "'"; ?>

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
                  console.log(response);
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
                  console.log(response);
                    self.closest('.option-wrapper').hide('slow', function(){
                      $(this).remove();
                    });
                })
                .fail(function(e) {
                    console.log(e);
                });
              }
          });
        }

        var newOptionTemplate = $('<div class="form-group option-wrapper"><label for="" class="col-sm-2 control-label">Option</label> <div class="col-sm-10"> <div class="form-group row"> <div class="col-md-10"> <input type="text" class="form-control" name="" value="" placeholder="Option name"> </div> <div class="col-md-2"> <div class="checkbox"> <label> <input type="checkbox" name="op-<?php echo $option_id; ?>-correct" value="1"> Correct &nbsp; </label> <button type="button" class="btn btn-xs btn-default remove-option" aria-label="Remove option" data-option-id=""> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </button> </div> </div> </div> </div> </div>');

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
                  console.log(response);
                  self.prev('.options-wrapper').append(newOptionTemplate);
                })
                .fail(function(e) {
                    console.log(e);
                });
          });
        }

    });

</script>
