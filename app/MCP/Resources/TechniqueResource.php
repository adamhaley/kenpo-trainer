<?php

namespace App\MCP\Resources;

use OPGG\LaravelMcpServer\Services\ResourceService\Resource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

/**
 * TechniqueResource - MCP Resource Implementation
 *
 * Resources provide LLMs with access to application data, files, or any other
 * content that can help them understand context or complete tasks. Resources
 * are application-controlled and can represent files, database records, API
 * responses, or any other data source.
 *
 * REQUIRED PROPERTIES:
 * --------------------
 * @property string $uri
 *     Unique identifier for this resource using URI format.
 *     Common schemes: file://, http://, https://, or custom schemes.
 *     Examples:
 *     - "file:///logs/app.log"
 *     - "database://users/123"
 *     - "api://weather/current"
 *
 * @property string $name
 *     Human-readable name displayed in resource listings.
 *     Should be descriptive and help users understand what this resource contains.
 *
 * OPTIONAL PROPERTIES:
 * -------------------
 * @property ?string $description
 *     Detailed explanation of what this resource contains and how to use it.
 *     Include any relevant context, update frequency, or access patterns.
 *
 * @property ?string $mimeType
 *     MIME type of the resource content (e.g., "text/plain", "application/json").
 *     Helps clients handle the content appropriately.
 *
 * @property ?int $size
 *     Size of the resource in bytes, if known.
 *     Useful for clients to estimate download time or memory usage.
 *
 * IMPLEMENTING read():
 * -------------------
 * The read() method must return an array with:
 * - 'uri': The resource URI (required)
 * - 'mimeType': The MIME type (optional but recommended)
 * - One of:
 *   - 'text': For UTF-8 text content
 *   - 'blob': For binary content (base64 encoded)
 *
 * @see https://modelcontextprotocol.io/docs/concepts/resources
 */
class TechniqueResource extends Resource
{
    public string $uri = 'database://techniques';
    public string $name = 'TechniqueResource';
    public ?string $description = 'Provides access to Kenpo techniques from the database, including their associated belts and attacks.';
    public ?string $mimeType = 'application/json';

    public function read(): array
    {
        try {
            $techniques = \App\Models\Technique::with('belt', 'attacks')->get();

            return [
                'uri' => $this->uri,
                'mimeType' => $this->mimeType,
                'text' => json_encode($techniques->toArray(), JSON_PRETTY_PRINT),
            ];
        } catch (\Exception $e) {
            throw new \RuntimeException(
                "Failed to read resource {$this->uri}: " . $e->getMessage()
            );
        }
    }
}
