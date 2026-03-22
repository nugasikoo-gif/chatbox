document.addEventListener('DOMContentLoaded', () => {
    const chatBox = document.getElementById('chat-box');
    const chatForm = document.getElementById('chat-form');
    let lastMessageCount = 0;


    async function fetchMessages() {
        try {
            const response = await fetch('api.php');
            const messages = await response.json();
            
         
            if (messages.length !== lastMessageCount) {
                chatBox.innerHTML = '';
                messages.forEach(msg => {
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'message-item';
                    messageDiv.innerHTML = `
                        <span class="message-user">${msg.user}</span>
                        <span class="message-text">${msg.message}</span>
                        <span class="message-time">${msg.time}</span>
                    `;
                    chatBox.appendChild(messageDiv);
                });
                
                
                chatBox.scrollTop = chatBox.scrollHeight;
                lastMessageCount = messages.length;
            }
        } catch (error) {
            console.error('Error fetching messages:', error);
        }
    }

    
    chatForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const user = document.getElementById('user').value;
        const messageInput = document.getElementById('message');
        const message = messageInput.value;

        
        const now = new Date();
        const timestamp = now.getFullYear() + '-' + 
            String(now.getMonth() + 1).padStart(2, '0') + '-' + 
            String(now.getDate()).padStart(2, '0') + ' ' + 
            String(now.getHours()).padStart(2, '0') + ':' + 
            String(now.getMinutes()).padStart(2, '0') + ':' + 
            String(now.getSeconds()).padStart(2, '0');

        try {
            const response = await fetch('api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ user, message, time: timestamp })
            });
            
            const result = await response.json();
            if (result.status === 'success') {
                messageInput.value = '';
                fetchMessages(); // Refresh chat
            }
        } catch (error) {
            console.error('Error sending message:', error);
        }
    });

   
    fetchMessages();
    setInterval(fetchMessages, 3000); // Poll for new messages every 3 seconds
});
