
<?php echo $this->session->flashdata('message'); ?>

<h1>Exam name <small>Edit exam</small></h1>

<h2>NOT FINISHED</h2>
<form class="form-horizontal" id="edit-exam-form">

<?php

$i = 1;

foreach ($exam as $exam_question => $question):

    if (!isset($previous_question_id) || $previous_question_id != $question->id):
        if ($i != 1) {
            echo '<button type="button" class="btn btn-primary btn-xs">Add option</button>';
            echo '<button type="button" class="btn btn-danger btn-xs pull-right" data-question-id="' . $question->id . '">Delete question</button>';
            echo '</div></div>';
        }
?>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><?php echo "Question $i"; ?></h3>
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
          <input type="text" class="form-control" name="" value="<?php echo $question->option_name; ?>" placeholder="Question statement">
          <input type="checkbox" name="correct-answer" value="1"> Correct
          <a href="#" title="Delete option" class="delete-option text-danger">Delete</a>
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
