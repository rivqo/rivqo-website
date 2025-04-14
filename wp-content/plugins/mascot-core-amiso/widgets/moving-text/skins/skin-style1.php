<?php
namespace MascotCoreAmiso\Widgets\MovingText\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style1 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-moving-text/general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style1';
	}


	public function get_title() {
		return __( 'Skin Style1', 'mascot-core-amiso' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;
	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		//enqueue css
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-moving-text-current-item-style1', MASCOT_CORE_AMISO_URL_PATH . 'assets/css/shortcodes/moving-text/moving-text-current-item-style1' . $direction_suffix . '.css' );

		if ( 'mascot_wave' === $settings['path'] ) {
			$path_svg = '
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1080">
					<g>
						<path d="M-724.4,671.5c47.9,17.5,93.6,25.9,139.6,25.9c105.3,0,186.5-43.2,272.5-88.9
							c86.4-45.9,175.7-93.4,290.1-93.4s203.8,47.5,290.1,93.4c86,45.7,167.2,88.9,272.5,88.9c105.3,0,186.5-43.2,272.5-88.9
							c86.4-45.9,175.7-93.4,290.1-93.4c114.4,0,203.7,47.5,290.1,93.4c86,45.7,167.2,88.9,272.5,88.9c105.3,0,186.5-43.2,272.5-88.9
							c86.4-45.9,175.7-93.4,290.1-93.4c114.4,0,203.8,47.5,290.1,93.4c86,45.7,167.2,88.9,272.5,88.9c46,0,91.6-8.5,139.6-25.9"/>
					</g>
				</svg>';
		}elseif ( 'mascot_line_simple' === $settings['path'] ) {
			$path_svg = '<div class="simple_line"></div>';
		}
		elseif ( 'custom' !== $settings['path'] ) {
			$path_svg = method_exists('Elementor\Modules\Shapes\Module', 'get_path_url') ? Shapes_Module::get_path_url( $settings['path'] ) : '';
			$path_svg = file_get_contents( $path_svg );
		} else {
			$url = $settings['custom_path']['url'];
			$path_svg = ( 'svg' === pathinfo( $url, PATHINFO_EXTENSION ) ) ? file_get_contents( $url ) : '';
		}

		$this->parent->add_render_attribute(
            'text_path',
            [
                'class' => [
                    'tm-moving-text',
                    'none' !== $settings[ 'svg_animation' ] ? $settings[ 'svg_animation' ] . '_animation' : '',
					!empty($settings['hover_animation']) ? 'elementor-animation-' . $settings['hover_animation'] : '',
					!empty($settings['clone_text']) ? 'clone_text' : '',
					!empty($settings['divider_text']) ? 'add_divider' : '',
					'loop' === $settings[ 'svg_animation' ] && !empty($settings['stop_hover']) ? 'stop_on_hover' : '',
                ],
            ]
		);

		if ( ! empty( $settings['clone_text'] ) ) {
			$this->parent->add_render_attribute( 'text_path', 'data-backspace-count', $settings['backspace_count'] );
		}

		if ( ! empty( $settings['divider_text'] ) ) {
			$this->parent->add_render_attribute( 'text_path', 'data-d-type', $settings['divider_type'] );
			if ( 'custom' === $settings['divider_type'] ) {
				$this->parent->add_render_attribute( 'text_path', 'data-d-custom', !empty($settings['divider_custom']) ? $settings['divider_custom'] : '.');
			}
		}
		?>
		<div <?php echo $this->parent->get_render_attribute_string( 'text_path' ); ?> data-type-svg="<?php echo $settings['path']; ?>" data-text="<?php echo $settings['text']; ?>">
			<?php echo $path_svg; ?>
		</div>
		<?php
	}
}