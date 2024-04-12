<?php

if ( ! class_exists( 'WP_CLI' ) || ! defined( 'WP_CLI' ) ) {
	return;
}

use n5s\Commands\Cache\CacheEnablerCommand;

if ( ! class_exists( CacheEnablerCommand::class ) ) {
	require_once __DIR__ . '/src/Cache/CacheEnablerCommand.php';
}

WP_CLI::add_command( 'ce', CacheEnablerCommand::class );
