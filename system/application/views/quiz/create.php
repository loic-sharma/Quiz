<?php $this->load->view('layout/header'); ?>

	<h1>Create a Quizz</h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?=site_url()?>">Home</a> &raquo; <a href="<?=site_url('quiz')?>">Quizzes</a> &raquo; <a href="#">Create</a></p>

		<?=form_open('quiz/create')?>
			<p style="color:red;font-weight:bold;"><?=$error?></p>

			Name: <?=form_input('name', set_value('name'))?>

			<?=form_submit('create', 'Next')?>
		<?=form_close()?>
	</div>
<?php $this->load->view('layout/footer'); ?>