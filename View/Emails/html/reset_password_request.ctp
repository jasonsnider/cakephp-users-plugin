<h1>Forgot your password, <?php echo $username; ?>?</h1>

<p><?php echo $entityName; ?> received a request to reset the password. If you didn't make this request, or 
    no longer need to reset your password, take no action and this link will expire within 24 hours.</p>

<p>To reset your password, click on the link below (or copy and paste the URL into your browser):
    <?php echo $serverName; ?>/users/reset_password/<?php echo $username; ?>/<?php echo $confirmation; ?></p>