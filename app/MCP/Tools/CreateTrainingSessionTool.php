<?php

namespace App\MCP\Tools;

use App\Http\Controllers\TrainingSessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OPGG\LaravelMcpServer\Exceptions\Enums\JsonRpcErrorCode;
use OPGG\LaravelMcpServer\Exceptions\JsonRpcErrorException;
use OPGG\LaravelMcpServer\Services\ToolService\ToolInterface;

class CreateTrainingSessionTool implements ToolInterface
{
    public function isStreaming(): bool
    {
        return false;
    }

    public function name(): string
    {
        return 'create-training-session';
    }

    public function description(): string
    {
        return 'Creates a new training session with a given name, description, and a list of technique IDs.';
    }

    public function inputSchema(): array
    {
        return [
            'type' => 'object',
            'properties' => [
                'name' => [
                    'type' => 'string',
                    'description' => 'The name of the training session.',
                ],
                'description' => [
                    'type' => 'string',
                    'description' => 'The description of the training session.',
                ],
                'techniques' => [
                    'type' => 'array',
                    'description' => 'An array of technique IDs to include in the training session.',
                    'items' => [
                        'type' => 'integer',
                    ],
                ],
            ],
            'required' => ['name', 'techniques'],
        ];
    }

    public function annotations(): array
    {
        return [
            'title' => 'Create Training Session',
            'readOnlyHint' => false,
            'destructiveHint' => false,
            'idempotentHint' => false,
            'openWorldHint' => false,
        ];
    }

    public function execute(array $arguments): mixed
    {
        $validator = Validator::make($arguments, [
            'name' => ['required', 'string', 'min:1'],
            'description' => ['sometimes', 'string'],
            'techniques' => ['required', 'array'],
            'techniques.*' => ['required', 'integer', 'exists:techniques,id'],
        ]);

        if ($validator->fails()) {
            throw new JsonRpcErrorException(
                message: 'Validation failed: ' . $validator->errors()->first(),
                code: JsonRpcErrorCode::INVALID_REQUEST
            );
        }

        try {
            $request = new Request($arguments);
            $controller = new TrainingSessionController();
            $response = $controller->store($request);
            $result = json_decode($response->getContent(), true);

            if ($result['success'] === 'false') {
                throw new JsonRpcErrorException(
                    message: 'Failed to create training session: ' . $result['message'],
                    code: JsonRpcErrorCode::INTERNAL_ERROR
                );
            }

            return [
                'success' => true,
                'data' => $result,
                'metadata' => [
                    'executed_at' => now()->toISOString(),
                ],
            ];
        } catch (\Exception $e) {
            \Log::error('Tool execution failed', [
                'tool' => static::class,
                'arguments' => $arguments,
                'error' => $e->getMessage(),
            ]);

            throw new JsonRpcErrorException(
                message: 'Failed to create training session: ' . $e->getMessage(),
                code: JsonRpcErrorCode::INTERNAL_ERROR
            );
        }
    }
}
