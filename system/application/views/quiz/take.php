<?php $this->load->view('layout/header'); ?>

	<h1><?=$name?></h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?=site_url()?>">Home</a> &raquo; <a href="<?=site_url('quiz')?>">Quizzes</a> &raquo; <a href="#">Take Quiz</a></p>

		<?=form_open('quiz/take/' . $id)?>
			<p style="color:red;font-weight:bold;"><?=$error?></p>

			<?php $id = 1; ?>
			<?php foreach($questions as $question): ?>
				<p style="font-weight:bold;"><?=$id?>) <?=$question['question']?></p>

				<?php if($question['type'] == 1): ?>

					<?=form_textarea($question['id'], '', 'style="margin-bottom:30px;"')?>

				<?php elseif($question['type'] == 2): ?>
					<?php $question['answers'] = unserialize($question['answers']); ?>

					<?php foreach($question['answers'] as $choice_id => $choice): ?>
						<input type="radio" name="<?=$question['id']?>" value="<?=$choice_id?>"> <?=$choice?><br />
					<?php endforeach; ?>
					<br />
				<?php endif; ?>

				<hr>
				<?php $id++; ?>
			<?php endforeach; ?>

			<?=form_submit('submit', 'Submit')?>
		<?=form_close()?>
	</div>
<?php $this->load->view('layout/footer'); ?>