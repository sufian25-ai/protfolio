@extends('admin.layout')

@section('content')
    <div class="page-header">
        <h2>User Messages</h2>
    </div>

    <div class="chat-container" style="display: flex; height: 600px; background: var(--card-bg); border: var(--glass-border); border-radius: 10px; overflow: hidden;">
        <!-- Session List -->
        <div class="session-list" style="width: 300px; border-right: 1px solid rgba(255,255,255,0.1); background: rgba(0,0,0,0.2); overflow-y: auto;">
            @foreach($sessions as $session)
            <div class="session-item" onclick="loadChat('{{ $session->session_id }}')" id="session-{{ $session->session_id }}" style="padding: 15px; border-bottom: 1px solid rgba(255,255,255,0.05); cursor: pointer; transition: 0.3s;">
                <div style="font-weight: 600; color: var(--primary-color);">{{ $session->name ?? 'Visitor' }}</div>
                <div style="font-size: 0.8rem; color: var(--text-secondary);">ID: {{ substr($session->session_id, 0, 8) }}...</div>
                <div style="font-size: 0.75rem; color: #666; margin-top: 5px;">{{ $session->last_activity }}</div>
            </div>
            @endforeach
        </div>

        <!-- Chat Window -->
        <div class="chat-window" style="flex: 1; display: flex; flex-direction: column; background: rgba(0,0,0,0.1);">
            <div id="active-chat-header" style="padding: 15px; border-bottom: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.02); font-weight: 600;">
                Select a conversation
            </div>
            
            <div id="admin-chat-messages" style="flex: 1; padding: 20px; overflow-y: auto; display: flex; flex-direction: column; gap: 10px;">
                <!-- Messages will load here -->
            </div>

            <div class="chat-input-area" style="padding: 15px; border-top: 1px solid rgba(255,255,255,0.1); display: none;">
                <div style="display: flex; gap: 10px;">
                    <input type="text" id="admin-message-input" placeholder="Type a reply..." style="flex: 1; padding: 10px; border-radius: 5px; border: 1px solid rgba(255,255,255,0.1); background: rgba(0,0,0,0.2); color: #fff;">
                    <button onclick="sendAdminMessage()" class="btn-primary" style="padding: 0 20px;">Send</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Axios CSRF Setup
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        axios.defaults.headers.common['X-CSRF-TOKEN'] = token;

        let currentSessionId = null;
        const pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}'
        });

        function loadChat(sessionId) {
            currentSessionId = sessionId;
            document.getElementById('active-chat-header').innerText = 'Chat with ' + sessionId;
            document.querySelector('.chat-input-area').style.display = 'block';
            
            // Highlight active session
            document.querySelectorAll('.session-item').forEach(el => el.style.background = 'transparent');
            document.getElementById('session-' + sessionId).style.background = 'rgba(0,255,245,0.05)';

            axios.get(`/messages?session_id=${sessionId}`)
                .then(response => {
                    const messagesDiv = document.getElementById('admin-chat-messages');
                    messagesDiv.innerHTML = '';
                    response.data.forEach(msg => {
                        appendAdminMessage(msg.message, msg.is_admin ? 'admin' : 'user');
                    });
                    
                    // Subscribe to this user's channel
                    const channel = pusher.subscribe('chat.' + sessionId);
                    channel.unbind_all();
                    channel.bind('App\\Events\\MessageSent', function(data) {
                        appendAdminMessage(data.message.message, data.message.is_admin ? 'admin' : 'user');
                    });
                });
        }

        async function sendAdminMessage() {
            if (!currentSessionId) return;
            const input = document.getElementById('admin-message-input');
            const msg = input.value;
            if (!msg) return;

            // Admin messages are manually appended here for immediate feedback, 
            // but in a real app create API should return it + broadcast handles duplicate.
            // Since our backend broadcasts to everyone (ShouldBroadcast), we will receive our own message via Pusher too.
            // So we might duplicate if we append manually + receive event.
            // Best practice: Wait for event or append and ignore event if ID matches.
            // Quick prototyping: Just send and let Pusher event append it.
            
            try {
                // We need an endpoint that allows Admin to send message as Admin.
                // Reusing the same endpoint but adding a flag or separate endpoint.
                // For simplicity, let's modify the ChatController to accept 'is_admin' or add Admin Chat route.
                // CURRENTLY: The /messages POST sets is_admin = false hardcoded.
                
                // Oops, I need to fix Controller to allow Admin to send messages.
                // Let's create a specific Admin API route for this or make the main one smarter.
                // Creating a simplified Axios call here assuming I'll fix the backend next.
                
                 await axios.post('/admin-reply', {
                    session_id: currentSessionId,
                    message: msg
                });
                
                input.value = '';
            } catch (e) {
                console.error(e);
                alert('Error sending message');
            }
        }

        function appendAdminMessage(text, type) {
            const div = document.createElement('div');
            // User message (received) -> Left, Admin message (sent) -> Right
            // CSS: user=left/gray, admin=right/primary
            div.style.padding = '10px 15px';
            div.style.borderRadius = '5px';
            div.style.maxWidth = '70%';
            div.style.marginBottom = '10px';
            div.innerText = text;
            
            if (type === 'user') {
                div.style.background = 'rgba(255,255,255,0.1)';
                div.style.alignSelf = 'flex-start';
                div.style.color = '#ccc';
            } else {
                div.style.background = 'var(--primary-color)';
                div.style.alignSelf = 'flex-end';
                div.style.color = 'var(--bg-color)';
            }
            
            const container = document.getElementById('admin-chat-messages');
            container.appendChild(div);
            container.scrollTop = container.scrollHeight;
        }
        // Enter key support
        document.getElementById('admin-message-input').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                sendAdminMessage();
            }
        });
    </script>
@endsection
