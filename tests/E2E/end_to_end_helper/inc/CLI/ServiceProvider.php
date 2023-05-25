<?php

namespace EndToEndHelper\CLI;

use EndToEndHelper\Dependencies\LaunchpadCore\Container\AbstractServiceProvider;
use EndToEndHelper\Dependencies\League\Container\Definition\Definition;

/**
 * Service provider.
 */
class ServiceProvider extends AbstractServiceProvider
{

    /**
     * Return IDs from common subscribers.
     *
     * @return string[]
     */
    public function get_common_subscribers(): array {
        return [
            \EndToEndHelper\CLI\Subscriber::class,
        ];
    }

    /**
     * Registers items with the container
     *
     * @return void
     */
    public function define()
    {
		global $wpdb;
		$this->register_service(Subscriber::class, function (Definition $definition) use ($wpdb) {
			$definition->addArgument($wpdb);
		});
    }
}
