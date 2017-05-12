<form action="<?php echo PAYPAL_URL; ?>/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="KA6BYKH3R2K7Q">
<input type="hidden" name="custom" value="<?php echo $uid; ?>">
<input type="hidden" name="email" value="<?php echo $e ?>">
<input type="submit" name="submit_button" value="Renew &rarr;" id="submit_button" class="btn btn-default" />
</form>
