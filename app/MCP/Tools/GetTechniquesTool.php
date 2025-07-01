<?php

namespace App\MCP\Tools;

use App\Models\Technique;
use OPGG\LaravelMcpServer\Exceptions\Enums\JsonRpcErrorCode;
use OPGG\LaravelMcpServer\Exceptions\JsonRpcErrorException;
use OPGG\LaravelMcpServer\Services\ToolService\ToolInterface;

class GetTechniquesTool implements ToolInterface
{
    public function isStreaming(): bool
    {
        return false;
    }

    public function name(): string
    {
        return 'get-techniques';
    }

    public function description(): string
    {
        return 'Retrieves a list of all Kenpo techniques from the database.';
    }

    public function inputSchema(): array
    {
        return [
            'type' => 'object',
            'properties' => [],
        ];
    }

    public function annotations(): array
    {
        return [
            'title' => 'Get Kenpo Techniques',
            'readOnlyHint' => true,
            'destructiveHint' => false,
            'idempotentHint' => true,
            'openWorldHint' => false,
        ];
    }

    public function execute(array $arguments): mixed
    {
        try {
            $techniques = Technique::with('belt', 'attacks')->get();

            return [
                'success' => true,
                'data' => $techniques->toArray(),
                'metadata' => [
                    'executed_at' => now()->toISOString(),
                    'count' => $techniques->count(),
                ],
            ];
        } catch (\Exception $e) {
            \Log::error('Tool execution failed', [
                'tool' => static::class,
                'arguments' => $arguments,
                'error' => $e->getMessage(),
            ]);

            throw new JsonRpcErrorException(
                message: 'Failed to retrieve techniques: ' . $e->getMessage(),
                code: JsonRpcErrorCode::INTERNAL_ERROR
            );
        }
    }
}
