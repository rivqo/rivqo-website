<div class="txt-loading">
<?php
$chars = str_split($page_preloading_text);
foreach($chars as $char) {
?>
    <span data-text-preloader="<?php echo esc_attr($char);?>" class="letters-loading">
        <?php echo esc_html($char);?>
    </span>
<?php
}
?>
</div>
