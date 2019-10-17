<script type="text/javascript" src="<?= template_uri() ?>js/gritter/js/jquery.gritter.js"></script>
<?php if($this->session->userdata('message')): ?>
<?php
	$type = $this->session->userdata('message_type');
	$msg  = $this->session->userdata('message');
	if ($type == 'error') {
		$img   = images_uri() . 'error_icon.png';
		$title = 'Oh snap!';
		$class = 'class_name: \'gritter-red\',';
	} elseif ($type == 'success') {
		$img = images_uri() . 'success_icon.png';
		$title = 'Success!';
		$class = 'class_name: \'gritter-blue\',';
	} elseif ($type == 'warning') {
		$img = images_uri() . 'warning_icon.png';
		$title = 'Heads up!';
		$class = '';
	} elseif ($type == 'info') {
		$img = images_uri() . 'info_icon.png';
		$title = 'Well done!';
		$class = '';
	}

	$this->session->unset_userdata('message_type');
	$this->session->unset_userdata('message');
?>

<script type="text/javascript">
    $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: '<?= $title ?>',
        // (string | mandatory) the text inside the notification
        text: '<?= $msg ?>',
        // (string | optional) the image to display on the left
        image: '<?= $img ?>',
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: false,
        // (int | optional) the time you want it to be alive for before fading out
        <?= $class ?> 
        time: '5000'
    });
</script>

<?php endif; ?>