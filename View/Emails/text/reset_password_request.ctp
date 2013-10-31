Forgot your password, <?php echo $username; ?>?

<?php echo $entityName; ?> received a request to reset the password. If you didn't make this request, or 
no longer need to reset your password, take no action and this link will expire within 24 hours.

To reset your password, copy and paste the URL into your browser:
<?php echo $serverName; ?>/users/users/reset_password/<?php echo $username; ?>/<?php echo $confirmation; ?>