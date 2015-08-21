<?php
namespace AJAXQueue;

/**
 * Class Core
 *
 * @package AJAXQueue
 */
class Core {

	/**
	 * Default name of the AJAX action to handle the queue
	 */
	const ACTION = 'AJAXQueue';

	/**
	 * Instance of our main Queue Handler
	 *
	 * @var QueueHandler
	 */
	static $queue_handler = null;

	/**
	 * Instance of our Resources handler
	 *
	 * @var Resources
	 */
	static $resources = null;

	/**
	 * Start the show!
	 */
	public static function init() {

		/**
		 * Filter the default action name for handling the AJAX Queue
		 *
		 * @since 1.0.0
		 *
		 * @param string $action Name of the action
		 */
		$action = apply_filters( 'tribe-ajax-queue-default-action', self::ACTION );

		self::$queue_handler = new QueueHandler( $action );
		self::$resources     = new Resources( $action );


		add_action( 'wp_ajax_action_with_error', function () {
			wp_send_json_error( [ 'message' => md5( time() ) ] );
		} );

		add_action( 'wp_ajax_action_with_ok', function () {
			wp_send_json_success( [ 'message' => rand() ] );
		} );
	}


}