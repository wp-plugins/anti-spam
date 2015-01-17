<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function antispam_log_stats() {
	$antispam_stats = get_option('antispam_stats', array());
	if (array_key_exists('blocked_total', $antispam_stats)){
		$antispam_stats['blocked_total']++;
	} else {
		$antispam_stats['blocked_total'] = 1;
	}
	update_option('antispam_stats', $antispam_stats);
}