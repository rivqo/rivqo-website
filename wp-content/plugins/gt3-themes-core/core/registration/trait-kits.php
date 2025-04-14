<?php

namespace GT3\ThemesCore\Registration;

use DateTime;
use GT3\ThemesCore\Logs;
use WP_Error;

trait Kits_Trait {
	private $kits_url     = 'https://gt3accounts.com/update/kit.php';

	private $default = array(
		'categories' => array(),
		'tags' => array(),
		'posts' => array(),
		'selected' => '',
	);

	protected function get_kits_url(){
		return $this->kits_url;
	}

	public function get_kits_update() {
		$url = $this->get_kits_url();

		$response = $this->fetch(
			$url, array(
				'action' => 'update'
			)
		);

		if (is_array($response)) {
			$response = array_merge(array(
				'error' => false
			), $response);

			if ($response['error']) {
				return new WP_Error('error_nf',$this->default);
			}

			$response = $response['content'];
		}

		return $response;
	}

	public function get_kit($id) {
		$url = $this->get_kits_url();

		if (!$this->is_active()) {
			return array(
				'error' => true,
				'msg' => 'code_not_found'
			);
		} /*else if($this->get_support_time_left()['expired']) {
			return array(
				'error' => true,
				'msg' => 'support_expired'
			);
		}*/

		$response = $this->fetch(
			$url, array(
				'action' => 'get',
				'kit_id' => $id
			)
		);

		if (is_array($response)) {
			$response = array_merge(array(
				'error' => false
			), $response);

			if ($response['error']) {
				return $response;
			}

			$response = $response['content'];
		}


		return $response;
	}
}
