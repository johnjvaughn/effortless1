<?php
require('./includes/form_functions.inc.php');

echo "<h1>$page_title</h1>";
display_form_element();
echo "<fieldset><legend>Fill out the form to add a page of content:</legend>";

create_form_input('title', 'text', 'Title', $add_page_errors);
$cat_query = "SELECT id, category FROM categories ORDER BY category ASC";
create_form_input('category', 'select', 'Category', $add_page_errors, array(), $dbc, $cat_query);
create_form_input('new_category', 'text', 'or Add a New Category', $add_page_errors, 'maxlength=45');
create_form_input('description', 'textarea', 'Description', $add_page_errors);
create_form_input('content', 'textarea', 'Content', $add_page_errors);
create_submit_btn("Add This Page");
?>
  </fieldset>
</form>
<script type='text/javascript' src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
<script src="https://cloud.tinymce.com/stable/plugins.min.js?apiKey=uovpp9wa1807fd5jhbpc53wfwn0fru7ygc9p00j1it90tzdq"></script>
<script type="text/javascript">
  tinyMCE.init({
    selector : "#content",
    width : 800,
    height : 400,
    browser_spellcheck : true,
    plugins: "paste,searchreplace,fullscreen,hr,link,anchor,image,charmap,media,autoresize,autosave,contextmenu,wordcount",
    toolbar1: "cut,copy,paste,|,undo,redo,removeformat,|hr,|,link,unlink,anchor,image,|,charmap,media,|,search,replace,|,fullscreen",
    toolbar2: "bold,italic,underline,strikethrough,|,alignleft,aligncenter,alignright,alignjustify,|,formatselect,|,bullist,numlist,|,outdent,indent,blockquote,",
    content_css: "css/bootstrap.min.css",
  })
</script>