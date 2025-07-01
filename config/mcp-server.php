<?php

return [
    'tools' => [
        App\MCP\Tools\GetTechniquesTool::class,
        \App\MCP\Tools\GetRandomTechniqueTool::class,
        \App\MCP\Tools\CreateTrainingSessionTool::class,
    ],
    'resources' => [
        App\MCP\Resources\TechniqueResource::class,
    ],
];
