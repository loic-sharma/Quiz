<?php $this->load->view('layout/header'); ?>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript">
		var type = '<?=set_value('type')?>';
		
		function add_fields()
		{
			if($('.type').val() == '0')
			{
				return;
			}
			
			$('#type-' + type).slideUp('fast');

			type = $('.type').val();

			$('#type-' + type).slideDown('slow');
		}
	</script>

	<h1>Add a Question</h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?=site_url()?>">Home</a> &raquo; <a href="<?=site_url('quiz')?>">Quizzes</a> &raquo; <a href="#">Add a Question</a></p>

		<?=form_open('quiz/add_question/' . $id)?>
			<p style="color:red;font-weight:bold;"><?=$error?></p>

			<table>
				<tr>
					<td>Question:</td>
					<td><?=form_input('question', set_value('question'))?></td>
				</tr>
				<tr>
					<td>Type: </td>
					<td><?=form_dropdown('type', $types, set_value('type'), 'onchange="add_fields()" class="type"')?></td>
				</tr>
			</table>

			<hr style="margin-top:30px;">

			<div <?=question_type('1')?>>
				<p>Answer:</p>
				
				<?=form_textarea('free_response_answer', _value('free_response_answer'))?>
				
				<p style="font-style:italic;">If no answer is given, the students' answers will need to be manually checked.</p>
			</div>
			<div <?=question_type('2')?>>
				<p>Answers:</p>

				<?=form_textarea('multiple_choice_answers', _value('multiple_choice_answers'))?>

				<p style="font-style:italic;">Put each answer on a new line. The first answer is the correct answer.</p>
			</div>

			<br />

			<?=form_submit('add', 'Add')?>
		<?=form_close()?>
	</div>
<?php $this->load->view('layout/footer'); ?>