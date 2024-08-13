<?php

namespace Realtyna\BasePlugin\Components\Test\AjaxHandlers;

use Realtyna\Core\Abstracts\AjaxHandlerAbstract;

class TestAjaxHandler extends AjaxHandlerAbstract
{
    /**
     * Get the action name for the AJAX handler.
     *
     * @return string
     */
    protected function getAction(): string
    {
        return 'test_action';
    }

    /**
     * Handle the AJAX request.
     *
     * @return void
     */
    public function handle(): void
    {
        // Verify nonce
        $nonce_verified = $this->verifyNonce('test_nonce', 'test_action');

        if (!$nonce_verified) {
            return; // Exit if nonce verification fails
        }

        // Process the AJAX request (example: retrieve data from $_POST)
        $test_data = isset($_POST['test_data']) ? sanitize_text_field($_POST['test_data']) : '';

        // Example response
        $response = [
            'success' => true,
            'data'    => $test_data,
            'message' => __('AJAX request processed successfully!', 'text-domain'),
        ];

        // Send the JSON response
        $this->sendJsonResponse($response);
    }
}
