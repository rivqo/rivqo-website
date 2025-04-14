<?php

namespace GT3\ThemesCore\Customizer\Controls;

use GT3\ThemesCore\Assets;
use GT3\ThemesCore\Assets\Script;
use GT3\ThemesCore\Assets\Style;
use WP_Customize_Control;

class Custom_Font extends WP_Customize_Control {
	public $type = 'gt3-custom-font';
	public $option_type = 'theme_mod';

	public $setting = array();

	public function enqueue() {
		Script::enqueue_core_asset('customizer/custom-fonts');
		Style::enqueue_core_asset('customizer/custom-fonts');
	}
	protected function content_template(){
		?>
		<label class="toggle">
			<div class="toggle--wrapper">

				<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
				<# } #>

				<label for="toggle-{{ data.id }}" class="toggle--label"></label>
			</div>

			<# if ( data.description ) { #>
			<span class="description customize-control-description">{{ data.description }}</span>
			<# } #>
		</label>
		<div class="font_wrapper"></div>
		<?php
	}

}
