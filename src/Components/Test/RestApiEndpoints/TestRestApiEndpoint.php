<?php

namespace Realtyna\BasePlugin\Components\Test\RestApiEndpoints;

use Realtyna\Core\Abstracts\RestApiEndpointAbstract;

class TestRestApiEndpoint extends RestApiEndpointAbstract
{
    /**
     * Registers the routes for the REST API endpoint.
     *
     * @return void
     */
    public function registerRoutes(): void
    {
        register_rest_route('test/v1', '/data', [
            'methods'  => \WP_REST_Server::READABLE,
            'callback' => [$this, 'handleRequest'],
            'permission_callback' => '__return_true', // Modify as needed
        ]);
    }

    /**
     * Handle the REST API request and return a response.
     *
     * @param \WP_REST_Request $request The request object.
     * @return \WP_REST_Response|\WP_Error The response object or WP_Error on failure.
     */
    public function handleRequest(\WP_REST_Request $request): \WP_Error|\WP_REST_Response
    {
        // Process the request (example)
        $data = [
            'message' => __('Hello, this is a REST API response!', 'text-domain'),
            'status' => 'success',
        ];

        return $this->sendJsonResponse($data);
    }
}
