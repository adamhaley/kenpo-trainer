<?php

namespace App\MCP\Tools;

use App\Models\TrainingSession;
use App\Http\Controllers\TrainingSessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OPGG\LaravelMcpServer\Exceptions\Enums\JsonRpcErrorCode;
use OPGG\LaravelMcpServer\Exceptions\JsonRpcErrorException;
use OPGG\LaravelMcpServer\Services\ToolService\ToolInterface;

class GetRandomTechniqueTool implements ToolInterface
{
    public function isStreaming(): bool
    {
        return false;
    }

    public function name(): string
    {
        return 'get-random-technique';
    }

    public function description(): string
    {
        return 'Retrieves a random, uncompleted technique from a specified training session.';
    }

    public function inputSchema(): array
    {
        return [
            'type' => 'object',
            'properties' => [
                'training_session_id' => [
                    'type' => 'integer',
                    'description' => 'The ID of the training session to get a random technique from.',
                ],
            ],
            'required' => ['training_session_id'],
        ];
    }

    public function annotations(): array
    {
        return [
            'title' => 'Get Random Technique',
            'readOnlyHint' => true,
            'destructiveHint' => false,
            'idempotentHint' => false,
            'openWorldHint' => false,
        ];
    }

    public function execute(array $arguments): mixed
    {
        $validator = Validator::make($arguments, [
            'training_session_id' => ['required', 'integer', 'exists:training_sessions,id'],
        ]);

        if ($validator->fails()) {
            throw new JsonRpcErrorException(
                message: 'Validation failed: ' . $validator->errors()->first(),
                code: JsonRpcErrorCode::INVALID_REQUEST
            );
        }

        try {
            $request = new Request(['training_session_id' => $arguments['training_session_id']]);
            $controller = new TrainingSessionController();
            $response = $controller->getRandomTechnique($request);
            $technique = json_decode($response->getContent(), true);

            return [
                'success' => true,
                'data' => $technique,
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
                message: 'Failed to retrieve random technique: ' . $e->getMessage(),
                code: JsonRpcErrorCode::INTERNAL_ERROR
            );
        }
    }
}
