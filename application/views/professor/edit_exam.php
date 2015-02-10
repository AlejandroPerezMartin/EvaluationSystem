
<?php echo $this->session->flashdata('message'); ?>

<div class="page-header">
    <h1><?php echo $exam[0]->exam_name; ?> <small>Edit exam</small></h1>
</div>

<form class="form-horizontal" id="edit-exam-form">

<h3>Configuration</h3>

<div class="form-group">
  <div class="col-xs-4">
   <label class="sr-only" for="exampleInputAmount">Exam name</label>
   <div class="input-group">
     <div class="input-group-addon">Exam name</div>
     <input type="text" class="form-control" id="exam_name" placeholder="Name" value="<?php echo $exam[0]->exam_name; ?>">
   </div>
  </div>
</div>

<div class="form-group">
  <div class="col-xs-3">
   <label class="sr-only" for="exampleInputAmount">Start date</label>
   <div class="input-group">
     <div class="input-group-addon">Start date</div>
     <input type="date" class="form-control" id="exampleInputAmount" placeholder="YYYY-MM-DD" value="<?php echo $exam[0]->start_date; ?>">
   </div>
  </div>
</div>

<div class="form-group">
  <div class="col-xs-3">
   <label class="sr-only" for="exampleInputAmount">Due date</label>
   <div class="input-group">
     <div class="input-group-addon">Due date</div>
     <input type="date" class="form-control" id="exampleInputAmount" placeholder="YYYY-MM-DD" value="<?php echo $exam[0]->due_date; ?>">
   </div>
   </div>
</div>

<div class="form-group">
  <div class="col-xs-3">
   <label class="sr-only" for="exampleInputAmount">Duration</label>
   <div class="input-group">
     <div class="input-group-addon">Duration</div>
     <input type="number" class="form-control" id="exampleInputAmount" step="1" min="0" max="120" placeholder="10 (minutes)" value="<?php echo $exam[0]->duration; ?>">
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
var_dump($exam);
foreach ($exam as $exam_question => $question):

    if (!isset($previous_question_id) || $previous_question_id != $question->id):
        if ($i != 1): ?>
                <button type="button" class="btn btn-primary btn-xs">Add option +</button>
              </div>
            </div>
        <?php endif; ?>

        <div class="panel panel-default">
          <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left"><?php echo "Question $i"; ?></h3>
            <button type="button" class="btn btn-danger btn-xs pull-right" data-question-id="<?php echo $question->id; ?>">
              <span class="glyphicon glyphicon-remove " aria-hidden="true"></span> Remove
            </button>
          </div>
          <div class="panel-body">
              <div class="form-group">
                <label for="inputPassword" class="col-sm-2 control-label">Statement</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputPassword" placeholder="Question statement" value="<?php echo $question->statement; ?>">
                </div>
              </div>

<?php

        $i++;
    endif;

    ?>

    <div class="form-group">
      <label for="inputPassword" class="col-sm-2 control-label">Option</label>
      <div class="col-sm-10">
        <div class="form-group row">
          <div class="col-md-10">
          <input type="text" class="form-control" name="" value="<?php echo $question->option_name; ?>" placeholder="Question statement">
          </div>
          <div class="col-md-2">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="correct-answer" value="1"> Correct &nbsp;
                <button type="button" class="btn btn-xs btn-default" aria-label="Remove option">
                  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php

    $previous_question_id = $question->id;

endforeach;

?>
    </div></div>

</form>

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


<script>

    $(document).ready(function(){

        var removeOptions = [],
            addOptions = [],
            deletedQuestions = [];

        $('.panel').each(function() {
            var $wrapper = $('.multi-fields', this);
            $(".add-field", $(this)).click(function(e) {
                $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
            });
            $('.multi-field .remove-field', $wrapper).click(function() {
                if ($('.multi-field', $wrapper).length > 1)
                    $(this).parent('.multi-field').remove();
            });
        });

        $('#add-open-question').on('click', function(){
            alert();
        })

        $('#add-closed-question').on('click', function(){
            var questionNumber = $('#edit-exam-form .panel-title').length,

        })

        function removeQuestion(questionId){

        }

    });

</script>
