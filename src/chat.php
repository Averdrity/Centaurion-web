<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Send user back to homepage with a query param we can use to trigger modal/message
    header('Location: /?auth_required=1');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centaurion - AI Chat</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/favicon/apple-touch-icon.png">
    <link rel="manifest" href="/assets/images/favicon/site.webmanifest">
    
    <!-- Styles -->
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/theme.css">
    <link rel="stylesheet" href="/assets/css/chat.css">
    <link rel="stylesheet" href="/assets/css/animations.css">
    
    <!-- Markdown Support -->
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.9.0/build/styles/github-dark.min.css">
    <script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.9.0/build/highlight.min.js"></script>

    <!-- Theme Configuration -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#1E40AF',
                        light: {
                            bg: '#F3F4F6',
                            card: '#FFFFFF',
                            text: '#1F2937',
                            muted: '#6B7280',
                            border: '#E5E7EB',
                        },
                        dark: {
                            bg: '#111827',
                            card: '#1F2937',
                            text: '#F3F4F6',
                            muted: '#9CA3AF',
                            border: '#374151',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-light-bg dark:bg-dark-bg text-light-text dark:text-dark-text min-h-screen flex flex-col">
    <!-- Header -->
    <?php include 'components/chat-header.php'; ?>

    <div class="flex-1 flex">
        <!-- Left Sidebar -->
        <aside id="leftSidebar" class="fixed left-0 top-16 bottom-0 w-64 bg-light-card dark:bg-dark-card transform -translate-x-full transition-transform duration-300 ease-in-out">
            <div class="p-4">
                <button class="modal-action-button w-full flex items-center justify-center">
                    <span class="icon icon-sm icon-left" style="background-image: url('/assets/icons/tabler/plus.svg')"></span>
                    New Chat
                </button>
                <div class="space-y-2 overflow-y-auto max-h-[calc(100vh-8rem)]">
                    <!-- Chat history will be populated here -->
                </div>
            </div>
        </aside>

        <!-- Main Chat Area -->
        <main class="flex-1 ml-0 transition-margin duration-300 ease-in-out">
            <div class="container mx-auto px-4 py-8 max-w-4xl">
                <div id="chatMessages" class="space-y-4 mb-8 min-h-[calc(100vh-16rem)] overflow-y-auto">
                    <!-- Messages will be populated here -->
                </div>
                
                <!-- Chat Input -->
                <div class="fixed bottom-4 left-1/2 transform -translate-x-1/2 w-full max-w-4xl px-4">
                    <form id="chatForm" class="relative">
                        <textarea 
                            id="messageInput"
                            class="form-input w-full py-3 px-4 pr-12 resize-none"
                            rows="1"
                            placeholder="Type your message..."
                        ></textarea>
                        <button 
                            type="submit"
                            class="absolute right-3 bottom-2.5 text-primary hover:text-secondary transition-colors disabled:opacity-50"
                            disabled
                        >
                            <span class="icon icon-lg" style="background-image: url('/assets/icons/tabler/send.svg')"></span>
                        </button>
                    </form>
                </div>
            </div>
        </main>

        <!-- Right Sidebar -->
        <aside id="rightSidebar" class="fixed right-0 top-16 bottom-0 w-64 bg-light-card dark:bg-dark-card transform translate-x-full transition-transform duration-300 ease-in-out">
            <div class="p-4">
                <h2 class="text-2xl font-bold mb-4">Memory Vault</h2>
                <div class="text-theme-muted">
                    Coming soon...
                </div>
            </div>
        </aside>
    </div>

    <!-- Auth Modals -->
    <?php include 'components/auth-modals.php'; ?>

    <!-- Scripts -->
    <script src="/js/chat.js"></script>
    <script src="/js/theme.js"></script>
</body>
</html> 