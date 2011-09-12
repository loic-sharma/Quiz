<?php $this->load->view('layout/header'); ?>
	<h1>Welcome to the HPISD Quiz Site!</h1>

	<div id="body">
		<p>Welcome to the <strong>HPISD Quiz Site</strong> built by <strong>Loic Sharma</strong>.</p>

		<p>Yes, I know - an incredibly creative name... The website that is.</p>

		<?php if( ! $this->account->logged_in()):?>
			<p><a href="<?=site_url('user/register')?>">Register</a> | <a href="<?=site_url('user/login')?>">Login</a></p>
		<?php else: ?>
			<p><a href="<?=site_url('user')?>">My Account</a> | <a href="<?=site_url('user/logout')?>">Logout</a></p>
		<?php endif; ?>
	</div>
<?php $this->load->view('layout/footer'); ?>