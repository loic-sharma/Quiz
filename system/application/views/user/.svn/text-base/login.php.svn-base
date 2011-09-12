<?php $this->load->view('layout/header'); ?>
	<h1>Login</h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?=site_url()?>">Home</a> &raquo; <a href="#">Login</a></p>
		<p style="color:red;font-weight:bold;"><?=$error?></p>

		<?=form_open('user/login')?>
			<table>
				<tr>
					<td>Email: </td>
					<td><?=form_input('email', set_value('email'))?></td>
				</tr>
				<tr>
					<td>Password: </td>
					<td><?=form_password('password', set_value('password'))?></td>
				</tr>
			</table>

			<?=form_submit('login', 'Login')?>

		<?=form_close()?>

		<p>Don't have an account? <a href="<?=site_url('user/register')?>">Register</a></div>
<?php $this->load->view('layout/footer'); ?>