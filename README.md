# 🚀 Centaurion

A modern web platform powered by AI, featuring a sleek user interface with dark/light theme support and real-time chat capabilities.

![Centaurion Logo](src/assets/images/logo/logo.png)

## ✨ Features

### 🎨 Modern UI/UX
- **Responsive Design** - Fully responsive layout that works on all devices
- **Theme Support** - Elegant light/dark mode with smooth transitions
- **Animated Components** - Subtle animations for enhanced user experience
- **Modern Components** - Clean and intuitive modal dialogs, buttons, and forms

### 🤖 AI Integration
- **Real-time Chat** - Powered by Ollama and Gemma 3B
- **Markdown Support** - Rich text formatting in chat messages
- **Code Highlighting** - Syntax highlighting for code blocks
- **Memory Vault** - (Coming Soon) Persistent chat history and context

### 🔐 Authentication System
- **User Management** - Secure login and registration
- **Profile System** - User profiles with customizable settings
- **Session Handling** - Secure PHP session management

### 🎯 Core Features
- **Navigation**
  - Intuitive header with context-aware navigation
  - Smooth transitions between pages
  - Quick access to key features
- **Chat Interface**
  - Collapsible sidebars for chat history and memory vault
  - Real-time message streaming
  - Auto-resizing input field
  - Loading indicators and animations

## 🏗️ Project Structure
```
Centaurion-Website/
├── .cursor/                # Cursor IDE configuration
├── src/
│   ├── api/               # Backend API endpoints
│   │   ├── auth/         # Authentication handlers
│   │   │   ├── get-profile.php
│   │   │   ├── login.php
│   │   │   ├── logout.php
│   │   │   ├── register.php
│   │   │   └── update-profile.php
│   │   └── config/       # API configuration
│   │       └── database.php
│   │
│   ├── assets/           # Static assets
│   │   ├── css/         # Stylesheets
│   │   │   ├── animations.css
│   │   │   ├── app.css
│   │   │   ├── chat.css
│   │   │   ├── icons.css
│   │   │   ├── main.css
│   │   │   └── theme.css
│   │   ├── fonts/       # Custom fonts
│   │   ├── icons/       # UI icons (excluding Tabler)
│   │   └── images/      # Images and logos
│   │       ├── favicon/
│   │       │   ├── favicon.ico
│   │       │   └── site.webmanifest
│   │       └── logo/
│   │           └── logo.png
│   │
│   ├── components/       # Reusable PHP components
│   │   ├── auth-modals.php
│   │   ├── chat-header.php
│   │   ├── footer.php
│   │   ├── header.php
│   │   └── theme-toggler.php
│   │
│   ├── database/        # Full Mysql DB
│   │   └── init.sql
│   │
│   ├── js/             # JavaScript files
│   │   ├── auth.js     # Authentication handlers
│   │   ├── chat.js     # Chat functionality
│   │   └── theme.js    # Theme switcher
│   │
│   ├── chat.php        # AI Chat page
│   └── index.php       # Landing page
│
├── .gitignore          # Git ignore configuration
├── docker-compose.yml  # Docker services configuration
├── Dockerfile         # PHP container configuration
├── package.json      # Project dependencies
├── package-lock.json # Dependency lock file
├── README.md        # Project documentation
├── tailwind.config.js # Tailwind CSS configuration
└── webpack.mix.js    # Laravel Mix build configuration for asset compilation
```

## 🛠️ Technology Stack
- **Frontend**
  - HTML5/CSS3
  - TailwindCSS
  - JavaScript (Vanilla)
  - Marked.js (Markdown)
  - Highlight.js (Code highlighting)
  - Laravel Mix (Asset compilation)

- **Backend**
  - PHP
  - MySQL
  - Ollama (AI)
  - Gemma3:27b (Language Model)

- **Development**
  - Docker
  - Node.js (Build tools)
  - Git

## 🚀 Getting Started

### Prerequisites
- Docker and Docker Compose
- Node.js 14+
- Ollama with Gemma3:27b model

### Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/averdrity/centaurion-web.git
   cd centaurion-website
   ```

2. Install dependencies:
   ```bash
   npm install
   ```

3. Start the Docker containers:
   ```bash
   docker-compose up -d
   ```

4. Start Ollama service and load Gemma 3B:
   ```bash
   ollama run gemma:3b
   ```

5. Visit `http://localhost:8080` in your browser

## 🎨 Theme Customization
The project uses a sophisticated theming system with CSS variables and Tailwind CSS:

```css
:root {
    --primary-color: #3B82F6;    /* Blue 500 */
    --secondary-color: #1E40AF;   /* Blue 800 */
}

/* Light theme colors */
.light {
    --bg: #F3F4F6;         /* Gray 100 */
    --card: #FFFFFF;       /* White */
    --text: #1F2937;      /* Gray 800 */
    --muted: #6B7280;     /* Gray 500 */
    --border: #E5E7EB;    /* Gray 200 */
}

/* Dark theme colors */
.dark {
    --bg: #111827;        /* Gray 900 */
    --card: #1F2937;      /* Gray 800 */
    --text: #F3F4F6;      /* Gray 100 */
    --muted: #9CA3AF;     /* Gray 400 */
    --border: #374151;    /* Gray 700 */
}
```

## 🤝 Contributing
Contributions are welcome! Please feel free to submit a Pull Request.

## 📝 License
This project is licensed under the MIT License - see the LICENSE file for details.

## 🙏 Acknowledgments
- Icons by [Tabler Icons](https://tabler-icons.io/)
- AI powered by [Ollama](https://ollama.ai/) and [Gemma](https://blog.google/technology/developers/gemma-open-models/)
- Built with [TailwindCSS](https://tailwindcss.com/) 