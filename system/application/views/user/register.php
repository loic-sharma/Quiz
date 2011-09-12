<?php $this->load->view('layout/header'); ?>
	<h1>Register</h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?=site_url()?>">Home</a> &raquo; <a href="#">Register</a></p>

		<p style="color:red;font-weight:bold;"><?=$error?></p>

		<?=form_open('user/register')?>
			<table>
				<tr>
					<td>Email: </td>
					<td><?=form_input('email', set_value('email'))?></td>
				</tr>
				<tr>
					<td>Password: </td>
					<td><?=form_password('password', set_value('password'))?></td>
				</tr>
				<tr>
					<td>Confirm: </td>
					<td><?=form_password('confirm', set_value('confirm'))?></td>
				</tr>
			</table>

			<?=form_submit('register', 'Register')?>

		<?=form_close()?>

		<p>Already have an account? <a href="<?=site_url('user/login')?>">Login</a></div>
<?php $this->load->view('layout/footer'); ?>