<?php $this->load->view('layout/header'); ?>
	<h1>Manage Quizzes</h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?=site_url()?>">Home</a> &raquo; <a href="#">Quizzes</a></p>
		<p>Here you can manage your quizzes</p>

		<?php if(count($quizzes) == 0): ?>
			<p>You have no quizzes</p>
		<?php else: ?>
			<table class="styled">
				<tr>
					<th>Name</th>
					<th>View</th>
					<th>Actions</th>
				</tr>
				<?php foreach($quizzes as $quiz): ?>
					<tr>
						<td><?=$quiz->name?></td>
						<td><a href="<?=site_url('quiz/enter')?>">Quiz</a> | <a href="<?=site_url('quiz/results/' . $quiz->id)?>">Results</a></td>
						<td>
							<a href="<?=site_url('quiz/edit/' . $quiz->id)?>">Edit</a> | 
							<a href="<?=site_url('quiz/delete/' . $quiz->id)?>" onclick="return confirm('Are you sure?')">Delete</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
		<?php endif; ?>

		<p><a href="<?=site_url('quiz/create')?>">[+] Create a Quiz</a></p>
	</div>
<?php $this->load->view('layout/footer'); ?>