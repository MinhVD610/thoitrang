<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VietStall</title>
    <link rel="icon" href="/thoitrang/Public/image/icon.png" type="image/png">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="./Public/css/reset.css">
    <link rel="stylesheet" type="text/css" href="./Public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" type="text/css" href="./Public/css/Responsive.css">
</head>

<body>
    <?php
    require_once "./mvc/Views/User/blocks/Header.php";
    ?>

    <div class="contain">
        <?php require_once "./mvc/Views/User/pages/" . $data["page"] . ".php" ?>
    </div>

    <?php
    require_once "./mvc/Views/User/blocks/Footer.php";
    require_once "./mvc/Views/User/blocks/ScrollTop.php";
    ?>

    <script type="text/javascript" src="./Public/js/script.js"></script>
    <script type="text/javascript" src="./Public/js/ajax.js"></script>
    <script type="text/javascript" src="./Public/js/mobile.js"></script>

    <!-- ========================================== -->
    <!-- PHẦN GIAO DIỆN VÀ LOGIC CHAT REAL-TIME     -->
    <!-- ========================================== -->
    <button id="chat-toggle-btn" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000; padding: 15px; background: #000; color: #fff; border: none; border-radius: 50%; cursor: pointer; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        💬 Chat
    </button>

    <div id="chat-box-container" style="display: none; position: fixed; bottom: 80px; right: 20px; width: 300px; height: 400px; background: #fff; border: 1px solid #ccc; border-radius: 10px; z-index: 1000; flex-direction: column; box-shadow: 0 5px 15px rgba(0,0,0,0.2);">
        
        <div style="background: #000; color: #fff; padding: 10px; border-radius: 10px 10px 0 0; font-weight: bold; text-align: center;">
            Hỗ trợ trực tuyến
        </div>

        <div id="chat-messages" style="flex: 1; padding: 10px; overflow-y: auto; background: #f9f9f9; display: flex; flex-direction: column; gap: 10px;">
        </div>

        <div style="display: flex; padding: 10px; border-top: 1px solid #ddd; background: #fff; border-radius: 0 0 10px 10px;">
            <?php 
                $roomID = isset($_SESSION['logined']) ? 'room_user_' . $_SESSION['logined'][0]['IDTK'] : 'room_guest_' . session_id(); 
                $senderName = isset($_SESSION['logined']) ? htmlspecialchars($_SESSION['logined'][0]['hoTen'], ENT_QUOTES, 'UTF-8') : 'Khách vãng lai';
            ?>
            <input type="hidden" id="chat-room-id" value="<?php echo $roomID; ?>">
            <input type="hidden" id="chat-sender" value="<?php echo $senderName; ?>">
            
            <input type="text" id="chat-input" placeholder="Nhập tin nhắn..." style="flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 5px; outline: none;">
            
            <button id="btn-send-chat" style="margin-left: 5px; padding: 8px 15px; background: #000; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Gửi</button>
        </div>
    </div> 
    
    <script>
        // Bật/tắt khung chat
        document.getElementById('chat-toggle-btn').addEventListener('click', function() {
            var chatBox = document.getElementById('chat-box-container');
            chatBox.style.display = chatBox.style.display === 'none' ? 'flex' : 'none';
        });
    </script>

    <!-- Thư viện Socket.io -->
    <script src="https://cdn.socket.io/4.7.2/socket.io.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            try {
                const chatMessages = document.getElementById("chat-messages");
                const chatInput = document.getElementById("chat-input");
                const btnSendChat = document.getElementById("btn-send-chat");
                
                const chatSender = document.getElementById("chat-sender") ? document.getElementById("chat-sender").value : "Khách";
                const chatRoomId = document.getElementById("chat-room-id") ? document.getElementById("chat-room-id").value : "room_unknown";

                const socket = io("https://chat-gn5u.onrender.com");

                socket.on("connect", () => {
                    socket.emit("join_user_room", chatRoomId);
                });
                
                socket.on("load_chat_history", function(history) {
                    chatMessages.innerHTML = ""; 
                    history.forEach(function(data) {
                        const messageWrapper = document.createElement("div");
                        messageWrapper.style.width = "100%";
                        
                        const messageBubble = document.createElement("span");
                        messageBubble.style.padding = "8px 12px";
                        messageBubble.style.borderRadius = "15px";
                        messageBubble.style.display = "inline-block";
                        messageBubble.style.maxWidth = "80%";
                        messageBubble.style.wordWrap = "break-word";
                        messageBubble.textContent = data.message; 

                        if(data.sender === chatSender) {
                            messageWrapper.style.textAlign = "right";
                            messageBubble.style.background = "#000";
                            messageBubble.style.color = "#fff";
                            messageWrapper.appendChild(messageBubble);
                        } else {
                            messageWrapper.style.textAlign = "left";
                            const senderName = document.createElement("div");
                            senderName.style.fontSize = "11px";
                            senderName.style.color = "gray";
                            senderName.style.marginBottom = "2px";
                            senderName.textContent = data.sender;
                            
                            messageBubble.style.background = "#e0e0e0";
                            messageBubble.style.color = "#000";
                            
                            messageWrapper.appendChild(senderName);
                            messageWrapper.appendChild(messageBubble);
                        }
                        chatMessages.appendChild(messageWrapper);
                    });
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                });

                function sendMessage() {
                    const message = chatInput.value;
                    if(message.trim() !== "") {
                        const payload = {
                            isAdmin: false,
                            roomId: chatRoomId,
                            sender: chatSender,
                            message: message
                        };
                        socket.emit("client_send_message", payload);
                        chatInput.value = "";
                    }
                }

                if (btnSendChat) btnSendChat.addEventListener("click", sendMessage);
                if (chatInput) {
                    chatInput.addEventListener("keypress", function(event) {
                        if (event.key === "Enter") sendMessage();
                    });
                }

                socket.on("server_broadcast_message", function(data) {
                    const messageWrapper = document.createElement("div");
                    messageWrapper.style.width = "100%";
                    
                    const messageBubble = document.createElement("span");
                    messageBubble.style.padding = "8px 12px";
                    messageBubble.style.borderRadius = "15px";
                    messageBubble.style.display = "inline-block";
                    messageBubble.style.maxWidth = "80%";
                    messageBubble.style.wordWrap = "break-word";
                    messageBubble.textContent = data.message; 

                    if(data.sender === chatSender) {
                        messageWrapper.style.textAlign = "right";
                        messageBubble.style.background = "#000";
                        messageBubble.style.color = "#fff";
                        messageWrapper.appendChild(messageBubble);
                    } else {
                        messageWrapper.style.textAlign = "left";
                        const senderName = document.createElement("div");
                        senderName.style.fontSize = "11px";
                        senderName.style.color = "gray";
                        senderName.style.marginBottom = "2px";
                        senderName.textContent = data.sender;
                        
                        messageBubble.style.background = "#e0e0e0";
                        messageBubble.style.color = "#000";
                        
                        messageWrapper.appendChild(senderName);
                        messageWrapper.appendChild(messageBubble);
                    }

                    if (chatMessages) {
                        chatMessages.appendChild(messageWrapper);
                        chatMessages.scrollTop = chatMessages.scrollHeight; 
                    }
                });

            } catch (error) {
                console.error("Lỗi khởi tạo Chat: ", error);
            }
        });
    </script>
</body>
</html>