const chatbox = document.getElementById('chatbox');

function loadMessages() {
    fetch('chat.php?action=get&board_id=1')  // ボードIDを指定
        .then(response => response.json())
        .then(data => {
            chatbox.innerHTML = '';
            data.messages.forEach(message => {
                const p = document.createElement('p');
                p.textContent = `${message.chat_postdate}: ${message.chat_content} (User: ${message.user_id})`;
                chatbox.appendChild(p);
            });
            chatbox.scrollTop = chatbox.scrollHeight;
        });
}

function sendMessage() {
    const message = document.getElementById('message').value;
    const userId = 1;  // 仮のユーザーID、適宜変更してください
    const boardId = 1;  // 仮のボードID、適宜変更してください

    if (message.trim() !== '') {
        fetch('chat.php?action=send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ chat_content: message, user_id: userId, board_id: boardId })
        }).then(() => {
            document.getElementById('message').value = '';
            loadMessages();
        });
    }
}

setInterval(loadMessages, 1000);
loadMessages();
