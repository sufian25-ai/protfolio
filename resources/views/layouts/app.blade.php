<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- SEO Meta --}}
    @hasSection('seo')
        @yield('seo')
    @else
        <title>{{ config('app.name', 'My Portfolio') }}</title>
        <meta name="description" content="Professional Full-Stack Developer Portfolio showcasing projects and skills.">
        <meta name="keywords" content="web developer, laravel, vue, react, portfolio">
        {{-- Open Graph / Social Media Meta Tags --}}
        <meta property="og:title" content="{{ config('app.name', 'My Portfolio') }}">
        <meta property="og:description" content="Professional Full-Stack Developer Portfolio showcasing projects and skills.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        {{-- <meta property="og:image" content="{{ asset('images/social-share.jpg') }}"> --}} {{-- Uncomment and update with your image --}}
        
        {{-- Twitter Card Meta Tags --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ config('app.name', 'My Portfolio') }}">
        <meta name="twitter:description" content="Professional Full-Stack Developer Portfolio showcasing projects and skills.">
        {{-- <meta name="twitter:image" content="{{ asset('images/social-share.jpg') }}"> --}} {{-- Uncomment and update with your image --}}
    @endif

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <!-- Particle Background -->
    <canvas id="particles-canvas"></canvas>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="container nav-content">
            <div class="logo">
                <span class="logo-bracket">&lt;</span>
                <span class="logo-text">Sufian</span>
                <span class="logo-bracket">/&gt;</span>
            </div>
            <div class="menu-btn">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
            <ul class="nav-links">
                <li><a href="/#home" class="nav-link">Home</a></li>
                <li><a href="/#about" class="nav-link">About</a></li>
                <li><a href="/#skills" class="nav-link">Skills</a></li>
                <li><a href="{{ route('home') }}#projects" class="nav-link">Projects</a></li>
                <li><a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}">Blog</a></li>
                <li><a href="{{ route('home') }}#experience" class="nav-link">Experience</a></li>
                <li><a href="/#contact" class="btn-primary">Contact Me</a></li>
                <li>
                    <button id="theme-toggle" class="btn-primary" style="padding: 8px 12px; border-radius: 50%; margin-left: 10px;">
                        <i class="fas fa-moon"></i>
                    </button>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="container footer-content">
            <div class="footer-logo">
                <span>Sufian</span>
                <span class="accent">/&gt;</span>
            </div>
            <p>&copy; {{ date('Y') }} Sufian Mahbub. All rights reserved.</p>
        </div>
    </footer>

    <!-- Chat Widget -->
    <div id="chat-widget" class="chat-widget">
        <div class="chat-header" onclick="toggleChat()">
            <span><i class="fas fa-comments"></i> Chat with Me</span>
            <i class="fas fa-chevron-up" id="chat-toggle-icon"></i>
        </div>
        
        <!-- Registration View -->
        <div class="chat-body" id="chat-register-view" style="display: none; padding: 20px; justify-content: center;">
            <p style="color: var(--text-secondary); margin-bottom: 20px; text-align: center; font-size: 0.9rem;">Please enter your details to start chatting.</p>
            <input type="text" id="chat-name" placeholder="Your Name" style="padding: 10px; margin-bottom: 10px; border-radius: 5px; border: 1px solid rgba(255,255,255,0.1); background: rgba(0,0,0,0.2); color: #fff; width: 100%;">
            <input type="email" id="chat-email" placeholder="Your Email" style="padding: 10px; margin-bottom: 20px; border-radius: 5px; border: 1px solid rgba(255,255,255,0.1); background: rgba(0,0,0,0.2); color: #fff; width: 100%;">
            <button onclick="registerUser()" class="btn-primary" style="width: 100%;">Start Chat</button>
        </div>

        <!-- Chat View -->
        <div class="chat-body" id="chat-view" style="display: none;">
            <div class="chat-messages" id="chat-messages">
                <div class="message system">
                    <p>Hi there! How can I help you today?</p>
                </div>
            </div>
            <div class="chat-input">
                <input type="text" id="chat-input" placeholder="Type a message...">
                <button onclick="sendMessage()"><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    </div>

    <style>
        .chat-widget {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 300px;
            background: var(--bg-light);
            border-radius: 10px;
            border: 1px solid var(--primary-color);
            box-shadow: 0 5px 20px rgba(0,0,0,0.5);
            z-index: 1000;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
            transition: 0.3s;
        }
        .chat-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 10px 15px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            color: #000;
            font-weight: 600;
        }
        .chat-body {
            height: 350px; /* Increased height for form */
            display: none;
            flex-direction: column;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
        }
        .chat-widget.open .chat-body {
            display: flex;
        }
        .chat-messages {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            color: #fff;
            font-size: 0.9rem;
        }
        .message {
            margin-bottom: 10px;
            padding: 8px 12px;
            border-radius: 5px;
            max-width: 80%;
            word-wrap: break-word;
        }
        .message.system {
            background: rgba(255,255,255,0.1);
            color: #aaa;
            font-size: 0.8rem;
            text-align: center;
            max-width: 100%;
        }
        .message.user {
            background: var(--primary-color);
            color: #000;
            align-self: flex-end;
            margin-left: auto;
        }
        .message.admin {
            background: var(--secondary-color);
            color: #fff;
        }
        .chat-input {
            display: flex;
            border-top: 1px solid rgba(255,255,255,0.1);
            padding: 5px;
        }
        .chat-input input {
            flex: 1;
            background: transparent;
            border: none;
            padding: 10px;
            color: #fff;
            outline: none;
        }
        .chat-input button {
            background: transparent;
            border: none;
            color: var(--primary-color);
            padding: 0 15px;
            cursor: pointer;
            font-size: 1.2rem;
        }
    </style>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        // Axios CSRF Setup
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        axios.defaults.headers.common['X-CSRF-TOKEN'] = token;

        // Session Logic
        let sessionId = localStorage.getItem('chat_session_id');
        if (!sessionId) {
            sessionId = 'sess_' + Math.random().toString(36).substr(2, 9);
            localStorage.setItem('chat_session_id', sessionId);
        }

        const chatWidget = document.getElementById('chat-widget');
        const chatToggleIcon = document.getElementById('chat-toggle-icon');
        const registerView = document.getElementById('chat-register-view');
        const chatView = document.getElementById('chat-view');

        // Check if user already registered
        const isRegistered = localStorage.getItem('chat_user_name');

        function toggleChat() {
            chatWidget.classList.toggle('open');
            chatToggleIcon.className = chatWidget.classList.contains('open') ? 'fas fa-chevron-down' : 'fas fa-chevron-up';
            
            if (chatWidget.classList.contains('open')) {
                if (isRegistered) {
                    showChatView();
                } else {
                    showRegisterView();
                }
            }
        }

        function showRegisterView() {
            registerView.style.display = 'flex';
            registerView.style.flexDirection = 'column';
            chatView.style.display = 'none';
        }

        function showChatView() {
            registerView.style.display = 'none';
            chatView.style.display = 'flex';
            chatView.style.flexDirection = 'column';
            loadMessages();
        }

        async function registerUser() {
            const name = document.getElementById('chat-name').value;
            const email = document.getElementById('chat-email').value;

            if (!name || !email) {
                alert('Please fill in all fields');
                return;
            }

            try {
                await axios.post('/chat/register', {
                    session_id: sessionId,
                    name: name,
                    email: email
                });
                
                localStorage.setItem('chat_user_name', name);
                localStorage.setItem('chat_user_email', email);
                location.reload(); 
            } catch (e) {
                console.error(e);
                alert('Registration failed');
            }
        }

        // Pusher Setup
        const pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}'
        });

        const channel = pusher.subscribe('chat.' + sessionId);
        channel.bind('App\\Events\\MessageSent', function(data) {
            if (data.message.is_admin) {
                appendMessage(data.message.message, 'admin');
            }
        });

        async function sendMessage() {
            const input = document.getElementById('chat-input');
            const msg = input.value;
            if (!msg) return;

            appendMessage(msg, 'user');
            input.value = '';

            try {
                await axios.post('/messages', {
                    session_id: sessionId,
                    message: msg
                });
            } catch (e) {
                console.error(e);
            }
        }

        function appendMessage(text, type) {
            const div = document.createElement('div');
            div.className = `message ${type}`;
            div.innerText = text;
            document.getElementById('chat-messages').appendChild(div);
            document.getElementById('chat-messages').scrollTop = document.getElementById('chat-messages').scrollHeight;
        }

        async function loadMessages() {
            try {
                const res = await axios.get(`/messages?session_id=${sessionId}`);
                const messagesDiv = document.getElementById('chat-messages');
                
                if (res.data.length > 0) messagesDiv.innerHTML = '';
                
                res.data.forEach(msg => {
                    appendMessage(msg.message, msg.is_admin ? 'admin' : 'user');
                });
            } catch (e) {
                console.error(e);
            }
        }

        // Enter key support
        document.getElementById('chat-input').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    </script>
</body>
</html>
