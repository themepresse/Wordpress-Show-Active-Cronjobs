<?php

/*
 * Plugin Name: Wordpress Show Active Cronjobs
 * Plugin URI: http://themepresse.com
 * Description: Wordpress Plugin that lists currently active Cronjobs
 * Author: Oliver Sulzer
 * Version: 1.0.0
 * Author URI: http://themepresse.com
 *
 * Text Domain: tp_sac
 * Domain Path: /languages
 * 
 * @package Wordpress_Show_Active_Cronjobs
 *
 */

add_action( 'admin_menu', 'tp_sac_add_admin_menu' );


function tp_sac_add_admin_menu(  ) { 

	add_submenu_page( 'tools.php', 'Show active Cronjobs', 'Active Cronjobs', 'manage_options', 'show-active-cronjobs', 'tp_sac_options_page' );


}

function tp_sac_options_page(  ) { 

	$cron_jobs = get_option( 'cron' );

	?>

	<h2>Active Wordpress Cronjobs:</h2>

	<p><?php _e('This page displays all the currently active cronjobs and the time of their next execution.', 'tp_sac'); ?></p>
	<p><?php _e('Currently active Cronjobs:', 'tp_sac'); ?> <?php echo(count($cron_jobs) - 1); ?></p>

	<table>
		<tbody>

	<?php

		foreach( $cron_jobs as $cronstime => $crons) {

			if( $cronstime != 'version' ) {

				foreach( $crons as $cronID => $cronVal) {

					echo '<tr>';

					echo '<td colspan="2">';

					echo '<h2>' . $cronID . '</h2>';

					echo '</td>';

					echo '</tr>';

					foreach($cronVal as $cats ) {

						echo '<tr>';

						echo '<td><b>' . __('Schedule', 'tp_sac') . '</b></td>';

						echo '<td>';

						if( $cats['schedule'] ) {

							echo $cats['schedule'];

						} else {

							echo 'none';

						}

						echo '</td></tr></tr>';

						echo '<td><b>' . __('Next Run:', 'tp_sac') . '</b></td>';

						echo '<td>';

						$date = new DateTime();

						$date->setTimestamp($cronstime);

						echo $date->format('H:i:s Y.m.d');

						echo '</td></tr>';

					}

					echo '</tr>';

				}

			}

		}

	?>
		</tbody>
	</table>

	<?php } ?>
