<?php
require('./includes/form_functions.inc.php');

echo "<h1>$page_title</h1>";
display_form_element('self', '', array('enctype' => 'multipart/form-data'));
echo "<input type='hidden' name='MAX_FILE_SIZE' value='5242880'>";
echo "<fieldset><legend>Fill out the form to add a PDF to the site:</legend>";

create_form_input('title', 'text', 'Title', $add_pdf_errors);
create_form_input('description', 'textarea', 'Description', $add_pdf_errors);
create_form_input('pdf', 'file', 'PDF', $add_pdf_errors, null, null,
                  "<span class='help-block'>PDF only, 5MB limit</span>");
create_submit_btn("Add This PDF");
?>
  </fieldset>
</form>
