## Example Prompts for Kenpo Training LLM

These are conceptual examples of prompts that an LLM could use to interact with the Kenpo Trainer application's MCP server.

### 1. Prompt to get a list of all Kenpo techniques (using `get-techniques` tool):

```
"You are a Kenpo Karate instructor. A student has asked for a complete list of all Kenpo techniques. Use the 'get-techniques' tool to retrieve and present this information."
```

### 2. Prompt to get a random technique for a training session (using `get-random-technique` tool):

```
"You are a Kenpo Karate training assistant. A student is in the middle of a training session (ID: {training_session_id}) and needs the next random technique to practice. Use the 'get-random-technique' tool with the provided session ID to fetch and present the next technique. If no techniques are left, inform the student."
```

### 3. Prompt to find techniques by a specific belt (using `techniques` resource with filtering):

```
"You are a Kenpo Karate archivist. A student wants to know all techniques associated with the 'yellow' belt. Access the 'techniques' resource and filter by 'belt.name' to retrieve and list these techniques."
```

### 4. Prompt to create a new training session (using `create-training-session` tool):

```
"You are a Kenpo Karate coach. A student wants to start a new training session named 'Morning Practice' with techniques ID 1, 5, and 10. Use the 'create-training-session' tool to set this up and confirm the session creation."
```
