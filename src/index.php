<?php
// Start the session at the very beginning
session_start();

// Get the theme from localStorage if available, otherwise use system preference
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'system';
$systemPrefersDark = isset($_SERVER['HTTP_SEC_CH_PREFERS_COLOR_SCHEME']) && $_SERVER['HTTP_SEC_CH_PREFERS_COLOR_SCHEME'] === 'dark';
$isDark = $theme === 'dark' || ($theme === 'system' && $systemPrefersDark);
?>
<!DOCTYPE html>
<html lang="en" class="<?php echo $isDark ? 'dark' : ''; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <title>Centaurion - Welcome</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/favicon/apple-touch-icon.png">
    <link rel="manifest" href="/assets/images/favicon/site.webmanifest">
    
    <!-- Styles -->
    <link rel="stylesheet" href="/assets/css/icons.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/animations.css">
    <script src="https://cdn.tailwindcss.com"></script>
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
<body class="bg-light-bg dark:bg-dark-bg text-light-text dark:text-dark-text min-h-screen flex flex-col transition-colors duration-200">
    <!-- Header -->
    <?php include 'components/header.php'; ?>
	
	<?php if (isset($_GET['auth_required'])): ?>
    <div id="authToast"
        class="fixed top-[100px] left-1/2 transform -translate-x-1/2 bg-red-600 text-white px-6 py-3 rounded-2xl shadow-lg z-50 text-sm font-medium animate-fade-in transition-opacity duration-500">
        You must be logged in to access the AI Chat.
    </div>

    <script>
        // Auto-fade and remove toast after 3 seconds
        setTimeout(() => {
            const toast = document.getElementById('authToast');
            if (toast) {
                toast.classList.add('opacity-0');
                setTimeout(() => toast.remove(), 500); // Remove after fade
            }
        }, 3000);
    </script>
<?php endif; ?>


    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-8">
        <section class="text-center mb-16">
            <h1 class="text-5xl font-bold mb-4">Welcome to Centaurion</h1>
            <p class="text-xl text-theme-muted">Your next-generation web platform powered by AI</p>
        </section>

        <section class="grid md:grid-cols-3 gap-8">
            <div class="bg-card p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold mb-4">AI Integration</h2>
                <p class="text-theme-muted">Powered by Ollama and Gemma 3B for intelligent interactions</p>
            </div>
            <div class="bg-card p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold mb-4">Modern Stack</h2>
                <p class="text-theme-muted">Built with PHP, MySQL, and Tailwind CSS for optimal performance</p>
            </div>
            <div class="bg-card p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold mb-4">Containerized</h2>
                <p class="text-theme-muted">Dockerized environment for consistent development and deployment</p>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include 'components/footer.php'; ?>

    <!-- Auth Modals -->
    <?php include 'components/auth-modals.php'; ?>

    <!-- Scripts -->
    <script src="/js/auth.js"></script>
    <script src="/js/theme.js"></script>
</body>
</html> 