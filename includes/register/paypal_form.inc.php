<form action="<?php echo PAYPAL_URL; ?>/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="KA6BYKH3R2K7Q">
<input type="hidden" name="custom" value="<?php echo $uid ?>">
<input type="hidden" name="email" value="<?php echo $e ?>">
<input type="image" src="<?php echo PAYPAL_URL; ?>/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="<?php echo PAYPAL_URL; ?>/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

