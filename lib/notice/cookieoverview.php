<?php
function cookie_notice_overview() {
	$output = '<div class="cookies-overview">';
	if (have_rows('cookie_notice_functional_cookies', 'option')) {
		$output .= '<div class="list-group cookie-list mt-4">';
			$output .= '<div class="list-group-item cookie-item main-cookie-item">';
				$output .= '<h2>'.get_field('cookie_notice_functional_cookie_title','option').'</h2>';
				$output .= get_field('cookie_notice_functional_cookie_content','option');
			$output .= '</div>';
			while (have_rows('cookie_notice_functional_cookies', 'option')) { the_row();
				$output .= '<div class="list-group-item cookie-item">';
					$output .= '<h3 class="h4 mb-4">'.get_sub_field('title').'</h3>';
					$output .= '<div class="row">';
						$output .= '<div class="col-12">';
							$output .= '<h4 class="h5">Doel</h4>';
							$output .= get_sub_field('target');
						$output .= '</div>';
						$output .= '<div class="col-12 col-md-4">';
							$output .= '<h4 class="h5">Eigenschappen</h4>';
							$output .= get_sub_field('properties');
						$output .= '</div>';
						$output .= '<div class="col-12 col-md-4">';
							$output .= '<h4 class="h5">Naam</h4>';
							$output .= get_sub_field('name');
						$output .= '</div>';
						$output .= '<div class="col-12 col-md-4">';
							$output .= '<h4 class="h5">Delen</h4>';
							$output .= get_sub_field('sharing');
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';
			}
		$output .= '</div>';
	}
	if (have_rows('cookie_notice_analysing_cookies', 'option')) {
		$output .= '<div class="list-group cookie-list mt-4">';
			$output .= '<div class="list-group-item cookie-item main-cookie-item">';
				$output .= '<h2>'.get_field('cookie_notice_analysing_cookie_title','option').'</h2>';
				$output .= get_field('cookie_notice_analysing_cookie_content','option');
			$output .= '</div>';
			while (have_rows('cookie_notice_analysing_cookies', 'option')) { the_row();
				$output .= '<div class="list-group-item cookie-item">';
					$output .= '<h3 class="h4 mb-4">'.get_sub_field('title').'</h3>';
					$output .= '<div class="row">';
						$output .= '<div class="col-12">';
							$output .= '<h4 class="h5">Doel</h4>';
							$output .= get_sub_field('target');
						$output .= '</div>';
						$output .= '<div class="col-12 col-md-4">';
							$output .= '<h4 class="h5">Eigenschappen</h4>';
							$output .= get_sub_field('properties');
						$output .= '</div>';
						$output .= '<div class="col-12 col-md-4">';
							$output .= '<h4 class="h5">Naam</h4>';
							$output .= get_sub_field('name');
						$output .= '</div>';
						$output .= '<div class="col-12 col-md-4">';
							$output .= '<h4 class="h5">Delen</h4>';
							$output .= get_sub_field('sharing');
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';
			}
		$output .= '</div>';
	}
	if (have_rows('cookie_notice_marketing_cookies', 'option')) {
		$output .= '<div class="list-group cookie-list mt-4">';
			$output .= '<div class="list-group-item cookie-item main-cookie-item">';
				$output .= '<h2>'.get_field('cookie_notice_marketing_cookie_title','option').'</h2>';
				$output .= get_field('cookie_notice_marketing_cookie_content','option');
			$output .= '</div>';
			while (have_rows('cookie_notice_marketing_cookies', 'option')) { the_row();
				$output .= '<div class="list-group-item cookie-item">';
					$output .= '<h3 class="h4 mb-4">'.get_sub_field('title').'</h3>';
					$output .= '<div class="row">';
						$output .= '<div class="col-12">';
							$output .= '<h4 class="h5">Doel</h4>';
							$output .= get_sub_field('target');
						$output .= '</div>';
						$output .= '<div class="col-12 col-md-4">';
							$output .= '<h4 class="h5">Eigenschappen</h4>';
							$output .= get_sub_field('properties');
						$output .= '</div>';
						$output .= '<div class="col-12 col-md-4">';
							$output .= '<h4 class="h5">Naam</h4>';
							$output .= get_sub_field('name');
						$output .= '</div>';
						$output .= '<div class="col-12 col-md-4">';
							$output .= '<h4 class="h5">Delen</h4>';
							$output .= get_sub_field('sharing');
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';
			}
		$output .= '</div>';
	}
	$output .= '</div>';
	return $output;
}