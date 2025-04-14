<!-- Training Block Style1 -->
<div class="award-block-current-item-style1">
  <div class="inner-box">
    <div class="count-box">
      <span class="count"><?php echo esc_html( $award_item['count'] );?></span>
    </div>
    <div class="content-box">
      <?php mascot_core_amiso_get_shortcode_template_part( 'sub-title', null, 'award-block/tpl', $award_item, false );?>
      <?php mascot_core_amiso_get_shortcode_template_part( 'title', null, 'award-block/tpl', $award_item, false );?>
      <span class="year"><?php echo esc_html( $award_item['year'] );?></span>
    </div>
  </div>
</div>