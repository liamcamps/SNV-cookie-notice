<?php
function cookie_notice_form() {
	if (isset($_COOKIE['cookie_notice_accepted'])) {
		$active = $_COOKIE['cookie_notice_accepted'] == 1 ? 'tracking' : 'functional';
	} else {
		$active = 'tracking';
	}
	$output = '<form class="cookie-form mb-4">';
		$output .= '<div class="row">';
			$output .= '<div class="col-md-6 mb-0">';
				$output .= '<div class="card cookies h-100"><label for="cookie_tool_level_0" class="w-100 h-100 card-body">';
				if (get_field('cookie_notice_functional', 'option') && is_array(get_field('cookie_notice_functional', 'option'))){
					if (isset(get_field('cookie_notice_functional', 'option')['title'])) {
						$output .= '<div class="custom-control custom-radio mb-3">';
						if ($active == 'functional') {
							$output .= '<input type="radio" value="0" id="cookie_tool_level_0" name="cookie_tool_level" checked class="custom-control-input">';
						} else {
							$output .= '<input type="radio" value="0" id="cookie_tool_level_0" name="cookie_tool_level" class="custom-control-input">';
						}
						$output .= '<div class="custom-control-label">'.get_field('cookie_notice_functional', 'option')['title'].'</div>';
						$output .= '</div>';
					}
					if (isset(get_field('cookie_notice_functional', 'option')['content'])) {
						$output .= get_field('cookie_notice_functional', 'option')['content'];
					}
				}
				$output .= '</label></div>';
			$output .= '</div>';
			$output .= '<div class="col-md-6 mb-0">';
				$output .= '<div class="card cookies h-100"><label for="cookie_tool_level_1" class="w-100 h-100 card-body">';
				if (get_field('cookie_notice_tracking', 'option') && is_array(get_field('cookie_notice_tracking', 'option'))){
					if (isset(get_field('cookie_notice_tracking', 'option')['title'])) {
						$output .= '<div class="custom-control custom-radio mb-3">';
						if ($active == 'tracking') {
							$output .= '<input type="radio" value="1" id="cookie_tool_level_1" name="cookie_tool_level" checked class="custom-control-input">';
						} else {
							$output .= '<input type="radio" value="1" id="cookie_tool_level_1" name="cookie_tool_level" class="custom-control-input">';
						}
						$output .= '<div class="custom-control-label" for="cookie_tool_level_1">'.get_field('cookie_notice_tracking', 'option')['title'].'</div>';
						$output .= '</div>';
					}
					if (isset(get_field('cookie_notice_tracking', 'option')['content'])) {
						$output .= get_field('cookie_notice_tracking', 'option')['content'];
					}
				}
				$output .= '</label></div>';
			$output .= '</div>';
		$output .= '</div>';
		$output .= '<div class="row justify-content-end">';
			$output .= '<div class="col-auto"><a href="#" data-cookie-notice="save" class="mt-4 btn btn-primary">Opslaan</a></div>';
		$output .= '</div>';
	$output .= '</form>';
	return $output;
}