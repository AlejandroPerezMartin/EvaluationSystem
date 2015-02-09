
<form class="form-horizontal">

<?php

$i = 1;

foreach ($exam as $exam_question => $question):

    if (!isset($previous_question_id) || $previous_question_id != $question->id):
        if ($i != 1):
            echo "<hr>";
        endif;
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
          </div>
        </div>
<?php

        $i++;
    endif;

    $previous_question_id = $question->id;

endforeach;

?>

</form>
