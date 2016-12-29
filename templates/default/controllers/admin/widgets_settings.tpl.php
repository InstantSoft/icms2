<?php
    $options_js_file = $this->getJavascriptFileName('widgets_options/'.$widget['controller'].'_'.$widget['name']);
    if($options_js_file){
        $this->addJSFromContext($options_js_file);
    }
?>
<div class="modal_form" style="">
	<div style="padding: 10px 0 0 20px;">
		<h2><?php echo $widget['type']; ?></h2>
	</div>
<?php
    $this->renderForm($form, $widget, array(
        'action' => $this->href_to('widgets_update'),
        'method' => 'ajax',
        'toolbar' => false
    ), $errors);
?>
</div>
<div class="widget_modal_help_link">
    <a href="<?php echo LANG_HELP_URL_WIDGETS_CFG; ?>" target="_blank"><?php echo LANG_HELP; ?></a>
</div>