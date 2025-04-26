// Theme toggle functionality
(function initTheme() {
    // Apply theme immediately before DOM loads to prevent flash
    const savedTheme = localStorage.getItem('theme') || document.cookie.split('; ').find(row => row.startsWith('theme='))?.split('=')[1] || 'system';
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const shouldBeDark = savedTheme === 'dark' || (!savedTheme && systemPrefersDark);
    
    if (shouldBeDark) {
        document.documentElement.classList.add('dark');
    }
})();

document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('themeToggle');
    const html = document.documentElement;
    
    // Set theme and update all toggles
    function setTheme(isDark) {
        const theme = isDark ? 'dark' : 'light';
        
        // Update HTML class
        if (isDark) {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }
        
        // Update all theme toggles
        document.querySelectorAll('[id=themeToggle]').forEach(toggle => {
            toggle.setAttribute('aria-checked', isDark.toString());
        });
        
        // Save theme preference
        localStorage.setItem('theme', theme);
        document.cookie = `theme=${theme};path=/;max-age=31536000`; // 1 year
        
        // Dispatch theme change event
        window.dispatchEvent(new CustomEvent('themechange', { detail: { isDark } }));
    }
    
    // Initialize theme
    const savedTheme = localStorage.getItem('theme') || document.cookie.split('; ').find(row => row.startsWith('theme='))?.split('=')[1] || 'system';
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    setTheme(savedTheme === 'dark' || (!savedTheme && systemPrefersDark));
    
    // Handle theme toggle clicks
    document.querySelectorAll('[id=themeToggle]').forEach(toggle => {
        toggle.addEventListener('click', () => {
            const isDark = !html.classList.contains('dark');
            setTheme(isDark);
        });
    });
    
    // Listen for system theme changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        if (!localStorage.getItem('theme') && !document.cookie.includes('theme=')) {
            setTheme(e.matches);
        }
    });
}); 