<?php $this->load->view('layout/header'); ?>

	<h1><?=$name?></h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?=site_url()?>">Home</a> &raquo; <a href="<?=site_url('quiz')?>">Quizzes</a> &raquo; <a href="#">Edit Quiz</a></p>

		<h2>Settings</h2>

		<?=form_open('quiz/edit/' . $id)?>
			<p style="color:red;font-weight:bold;"><?=$error?></p>

			<table>
				<tr>
					<td>Name: </td>
					<td><?=form_input('name', $name)?></td>
				</tr>
				<tr>
					<td>Password: </td>
					<td><?=form_input('password', $password)?>
				<tr>
					<td>Max Displayed Questions: </td>
					<td><?=form_dropdown('max_questions', $options, $max_questions)?></td>
				</tr>
			</table>
			<p style="font-style:italic;">If there are more questions than the allowed amount, questions will be randomly selected.</p>


			<?=form_submit('edit', 'Save')?>
		<?=form_close()?>

		<hr style="margin-top:20px;">

		<h2>Questions</h2>

		<?php if(count($questions) > 0): ?>
			<table class="styled">
				<tr>
					<th>Question</th>
					<th>Type</th>
					<th>Action</th>
				</tr>


				<?php foreach($questions as $q): ?>
					<tr>
						<td><?=$q['question']?></td>
						<td><?=type($q)?></td>
						<td><a href="<?=site_url('quiz/edit_question/' . $q['id'])?>">Edit</a> | <a href="<?=site_url('quiz/delete_question/' . $id . '/' . $q['id'])?>" onclick="return confirm('Are you sure?')">Delete</a></td>
					</tr>
				<?php endforeach; ?>

			</table>
		<?php else: ?>
			<i>This quiz has no questions yet.</i>
		<?php endif; ?>

		<p><a href="<?=site_url('quiz/add_question/' . $id)?>">[+] Add a Question</a></p>

	</div>
<?php $this->load->view('layout/footer'); ?>