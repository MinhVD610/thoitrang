<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VietStall</title>
    <link rel="icon" href="/thoitrang/Public/image/icon.png" type="image/png">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../Public/css/reset.css">
    <link rel="stylesheet" type="text/css" href="../Public/css/admin/style.css">
    <link rel="stylesheet" type="text/css" href="../Public/css/admin/responsive.css">
</head>

<body>
    <?php if(isset($_SESSION["logined"]) && strcmp(strtolower($_SESSION["logined"][0]["role"]),"admin") == 0)
    {?>
    <div class="contain">
        <div class="contain-left">
            <?php require_once "./mvc/Views/Admin/blocks/SideBar.php" ?>
        </div>
        <div class="contain-right">
            <div class="contain-right__top">
                <?php require_once "./mvc/Views/Admin/blocks/Header.php" ?>
            </div>

            <div class="contain-right__bottom">
                <div class="contain-right__bottom--breadcrumb">
                    <?php require_once "./mvc/Views/Admin/blocks/Breadcrumb.php" ?>
                </div>

                <div class="contain-right__bottom--content">
                    <?php require_once "./mvc/Views/Admin/pages/".$data["page"].".php" ?>
                </div>
            </div>
        </div>
    </div>
    <?php }
    else
    {
        header("location: http://localhost/MyPham/DangNhap");
    }
    ?>

    <?php if(isset($_SESSION["logined"]) && strcmp(strtolower($_SESSION["logined"][0]["role"]),"admin") == 0) { ?>
        <button id="admin-chat-toggle" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000; padding: 15px; background: #0056b3; color: #fff; border: none; border-radius: 50%; cursor: pointer; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            💬 Hỗ trợ Khách hàng
        </button>

        <div id="admin-chat-container" style="display: none; position: fixed; bottom: 80px; right: 20px; width: 350px; height: 450px; background: #fff; border: 1px solid #ccc; border-radius: 10px; z-index: 1000; flex-direction: column; box-shadow: 0 5px 15px rgba(0,0,0,0.2);">
            
            <div style="background: #0056b3; color: #fff; padding: 10px; border-radius: 10px 10px 0 0; font-weight: bold; text-align: center;">
                Kênh Hỗ Trợ Khách Hàng
            </div>

            <div id="admin-chat-messages" style="flex: 1; padding: 10px; overflow-y: auto; background: #f4f6f9; display: flex; flex-direction: column; gap: 10px;">
            </div>

            <div style="display: flex; padding: 10px; border-top: 1px solid #ddd; background: #fff; border-radius: 0 0 10px 10px;">
                <input type="text" id="admin-chat-input" placeholder="Trả lời khách hàng..." style="flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 5px; outline: none;">
                <button onclick="sendAdminMessage()" style="margin-left: 5px; padding: 8px 15px; background: #0056b3; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Gửi</button>
            </div>
        </div>

        <script>
            // Bật/tắt khung chat Admin
            document.getElementById('admin-chat-toggle').addEventListener('click', function() {
                var chatBox = document.getElementById('admin-chat-container');
                chatBox.style.display = chatBox.style.display === 'none' ? 'flex' : 'none';
            });
        </script>
        
        <script src="https://cdn.socket.io/4.7.2/socket.io.min.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const adminSocket = io("https://chat-gn5u.onrender.com"); // Đã trỏ về localhost:3000

                const adminMessages = document.getElementById("admin-chat-messages");
                const adminInput = document.getElementById("admin-chat-input");
                const adminSenderName = "Admin Shop";

                let currentTargetRoom = ""; 

                adminSocket.on("connect", () => {
                    adminSocket.emit("join_admin_room");
                });

                adminSocket.on("load_chat_history", function(history) {
                    adminMessages.innerHTML = ""; 
                    
                    if(history.length === 0) {
                        adminMessages.innerHTML = "<div style='text-align:center; color:gray; font-size:12px; margin-top:20px;'>Chưa có tin nhắn nào trong phòng này.</div>";
                        return;
                    }

                    history.forEach(function(data) {
                        const messageWrapper = document.createElement("div");
                        messageWrapper.style.width = "100%";
                        messageWrapper.style.marginBottom = "10px";

                        const messageBubble = document.createElement("span");
                        messageBubble.style.padding = "8px 12px";
                        messageBubble.style.borderRadius = "15px";
                        messageBubble.style.display = "inline-block";
                        messageBubble.style.maxWidth = "85%";
                        messageBubble.style.wordWrap = "break-word";
                        messageBubble.textContent = data.message; 

                        if(data.isAdmin) {
                            messageWrapper.style.textAlign = "right";
                            messageBubble.style.background = "#0056b3";
                            messageBubble.style.color = "#fff";
                            messageWrapper.appendChild(messageBubble);
                        } else {
                            messageWrapper.style.textAlign = "left";
                            const senderInfo = document.createElement("div");
                            senderInfo.style.fontSize = "12px";
                            senderInfo.style.color = "#d9534f";
                            senderInfo.style.fontWeight = "bold";
                            senderInfo.textContent = data.sender + " ";
                            
                            messageBubble.style.background = "#e9ecef";
                            messageBubble.style.color = "#333";
                            
                            messageWrapper.appendChild(senderInfo);
                            messageWrapper.appendChild(messageBubble);
                        }
                        adminMessages.appendChild(messageWrapper);
                    });
                    adminMessages.scrollTop = adminMessages.scrollHeight;
                });

                adminSocket.on("server_broadcast_message", function(data) {
                    const messageWrapper = document.createElement("div");
                    messageWrapper.style.width = "100%";
                    messageWrapper.style.marginBottom = "10px";

                    const messageBubble = document.createElement("span");
                    messageBubble.style.padding = "8px 12px";
                    messageBubble.style.borderRadius = "15px";
                    messageBubble.style.display = "inline-block";
                    messageBubble.style.maxWidth = "85%";
                    messageBubble.style.wordWrap = "break-word";
                    messageBubble.textContent = data.message; 

                    if(data.isAdmin) {
                        messageWrapper.style.textAlign = "right";
                        messageBubble.style.background = "#0056b3";
                        messageBubble.style.color = "#fff";
                        messageWrapper.appendChild(messageBubble);
                    } else {
                        messageWrapper.style.textAlign = "left";
                        
                        const senderInfo = document.createElement("div");
                        senderInfo.style.fontSize = "12px";
                        senderInfo.style.color = "#d9534f";
                        senderInfo.style.fontWeight = "bold";
                        senderInfo.textContent = data.sender + " ";

                        // Nút để Admin click vào và chọn trả lời khách này
                        const replyBtn = document.createElement("span");
                        replyBtn.style.color = "blue";
                        replyBtn.style.cursor = "pointer";
                        replyBtn.style.textDecoration = "underline";
                        replyBtn.textContent = "[Trả lời]";
                        replyBtn.onclick = function() {
                            setReplyTarget(data.roomId, data.sender);
                        };
                        
                        senderInfo.appendChild(replyBtn);
                        messageBubble.style.background = "#e9ecef";
                        messageBubble.style.color = "#333";
                        
                        messageWrapper.appendChild(senderInfo);
                        messageWrapper.appendChild(messageBubble);
                    }

                    adminMessages.appendChild(messageWrapper);
                    adminMessages.scrollTop = adminMessages.scrollHeight; 
                });

                // Hàm toàn cục để JS bên ngoài gọi được
                window.setReplyTarget = function(roomId, customerName) {
                    currentTargetRoom = roomId;
                    document.getElementById("admin-chat-input").placeholder = "Đang trả lời: " + customerName;
                    adminSocket.emit('admin_load_history', roomId);
                };

                window.sendAdminMessage = function() {
                    const message = adminInput.value;
                    if (currentTargetRoom === "") {
                        alert("Vui lòng bấm [Trả lời] trên tin nhắn của một khách hàng trước khi gửi!");
                        return;
                    }
                    if(message.trim() !== "") {
                        const payload = {
                            isAdmin: true,            
                            roomId: currentTargetRoom, 
                            sender: adminSenderName,
                            message: message
                        };
                        adminSocket.emit("client_send_message", payload);
                        adminInput.value = ""; 
                    }
                };

                if (adminInput) {
                    adminInput.addEventListener("keypress", function(event) {
                        if (event.key === "Enter") {
                            sendAdminMessage();
                        }
                    });
                }
            });
        </script>
    <?php } ?>
</body>
</html>