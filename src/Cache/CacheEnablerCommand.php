<?php

namespace n5s\Commands\Cache;

use Cache_Enabler_Disk;
use Throwable;
use WP_CLI;
use WP_CLI_Command;

class CacheEnablerCommand extends WP_CLI_Command {

	/**
	 * Write the advanced-cache.php dropin.
	 *
	 * ## EXAMPLES
	 *
	 *     $ wp cache-enabler write-dropin
	 *     Success: The dropin has been successfully written: downloaded.
	 *
	 */
	public function __invoke( array $args, array $assoc_args ) {
		if (
			! class_exists( Cache_Enabler_Disk::class )
			&& defined( 'WP_PLUGIN_DIR' )
			&& file_exists( WP_PLUGIN_DIR . '/cache-enabler/cache-enabler.php' )
		) {
			require_once WP_PLUGIN_DIR . '/cache-enabler/cache-enabler.php';
		}

		try {
			$result = Cache_Enabler_Disk::create_advanced_cache_file();
			if ( is_string( $result ) ) {
				WP_CLI::success( sprintf( 'The dropin has been successfully written: %s', $result ) );
			} else {
				WP_CLI::error( 'Failed to write advanced-cache.php dropin.' );
			}
		} catch ( Throwable $e ) {
			WP_CLI::error( $e->getMessage() );
		}
	}
}
