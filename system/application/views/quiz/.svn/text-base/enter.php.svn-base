<?php $this->load->view('layout/header'); ?>

	<h1>Take Quizz</h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?=site_url()?>">Home</a> &raquo; <a href="<?=site_url('quiz')?>">Quizzes</a> &raquo; <a href="#">Take Quiz</a></p>

		<?=form_open('quiz/enter')?>
			<p style="color:red;font-weight:bold;"><?=$error?></p>

			<table>
				<tr>
					<td>Quiz ID: </td>
					<td><?=form_input('id', set_value('id'))?></td>
				</tr>
				<tr>
					<td>Password: </td>
					<td><?=form_password('password', set_value('password'))?></td>
				</tr>
			</table>

			<?=form_submit('enter', 'Enter')?>
		<?=form_close()?>
	</div>
<?php $this->load->view('layout/footer'); ?>