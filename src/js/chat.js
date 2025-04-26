// DOM Elements
const chatForm = document.getElementById('chatForm');
const messageInput = document.getElementById('messageInput');
const chatMessages = document.getElementById('chatMessages');
const leftSidebar = document.getElementById('leftSidebar');
const rightSidebar = document.getElementById('rightSidebar');
const leftSidebarToggle = document.getElementById('leftSidebarToggle');
const rightSidebarToggle = document.getElementById('rightSidebarToggle');

// Initialize marked.js options
marked.setOptions({
    highlight: function(code, lang) {
        return hljs.highlightAuto(code).value;
    },
    breaks: true
});

// Sidebar state management
let leftSidebarOpen = localStorage.getItem('leftSidebarOpen') === 'true';
let rightSidebarOpen = localStorage.getItem('rightSidebarOpen') === 'true';

// Initialize sidebar states
function initializeSidebars() {
    document.body.classList.toggle('sidebar-open-left', leftSidebarOpen);
    document.body.classList.toggle('sidebar-open-right', rightSidebarOpen);
}

// Toggle sidebar functions
function toggleLeftSidebar() {
    leftSidebarOpen = !leftSidebarOpen;
    document.body.classList.toggle('sidebar-open-left', leftSidebarOpen);
    localStorage.setItem('leftSidebarOpen', leftSidebarOpen);
}

function toggleRightSidebar() {
    rightSidebarOpen = !rightSidebarOpen;
    document.body.classList.toggle('sidebar-open-right', rightSidebarOpen);
    localStorage.setItem('rightSidebarOpen', rightSidebarOpen);
}

// Auto-resize textarea
function autoResizeTextarea() {
    messageInput.style.height = 'auto';
    messageInput.style.height = Math.min(messageInput.scrollHeight, 200) + 'px';
}

// Enable/disable submit button based on input
function toggleSubmitButton() {
    const submitButton = chatForm.querySelector('button[type="submit"]');
    submitButton.disabled = !messageInput.value.trim();
}

// Add a message to the chat
function addMessage(content, isUser = false) {
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${isUser ? 'message-user' : 'message-ai'}`;
    
    const contentDiv = document.createElement('div');
    contentDiv.className = 'message-content';
    contentDiv.innerHTML = isUser ? content : marked.parse(content);
    
    messageDiv.appendChild(contentDiv);
    chatMessages.appendChild(messageDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;
    
    // Initialize code highlighting
    messageDiv.querySelectorAll('pre code').forEach((block) => {
        hljs.highlightBlock(block);
    });
}

// Add loading indicator
function addLoadingIndicator() {
    const loadingDiv = document.createElement('div');
    loadingDiv.className = 'message message-ai loading';
    loadingDiv.innerHTML = '<div class="message-content loading-dots">AI is thinking</div>';
    chatMessages.appendChild(loadingDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;
    return loadingDiv;
}

// Handle chat form submission
async function handleSubmit(event) {
    event.preventDefault();
    const message = messageInput.value.trim();
    if (!message) return;

    // Add user message
    addMessage(message, true);

    // Clear input
    messageInput.value = '';
    messageInput.style.height = 'auto';
    toggleSubmitButton();

    // Add loading indicator
    const loadingDiv = addLoadingIndicator();

    try {
        // Call Ollama API
        const response = await fetch('http://localhost:11434/api/generate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                model: 'gemma:3b',
                prompt: message,
                stream: true
            })
        });

        // Remove loading indicator
        loadingDiv.remove();

        if (!response.ok) {
            throw new Error('API request failed');
        }

        // Create a new message div for the AI response
        let aiMessage = '';
        const reader = response.body.getReader();
        const decoder = new TextDecoder();

        while (true) {
            const { done, value } = await reader.read();
            if (done) break;

            const chunk = decoder.decode(value);
            const lines = chunk.split('\n');

            for (const line of lines) {
                if (!line) continue;
                
                try {
                    const data = JSON.parse(line);
                    aiMessage += data.response;
                    
                    // Update the message in real-time
                    if (!document.querySelector('.ai-response-live')) {
                        addMessage(aiMessage);
                        document.querySelector('.message:last-child').classList.add('ai-response-live');
                    } else {
                        document.querySelector('.ai-response-live .message-content').innerHTML = marked.parse(aiMessage);
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                }
            }
        }

        // Remove the live class when done
        const liveMessage = document.querySelector('.ai-response-live');
        if (liveMessage) {
            liveMessage.classList.remove('ai-response-live');
        }

    } catch (error) {
        console.error('Error:', error);
        loadingDiv.remove();
        addMessage('Sorry, I encountered an error while processing your request. Please try again.', false);
    }
}

// Event Listeners
document.addEventListener('DOMContentLoaded', initializeSidebars);
leftSidebarToggle.addEventListener('click', toggleLeftSidebar);
rightSidebarToggle.addEventListener('click', toggleRightSidebar);
chatForm.addEventListener('submit', handleSubmit);
messageInput.addEventListener('input', () => {
    autoResizeTextarea();
    toggleSubmitButton();
});

// Initialize
toggleSubmitButton(); 