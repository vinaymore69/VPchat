/* assets/js/script.js */
document.addEventListener("DOMContentLoaded", () => {
    const chatBody = document.getElementById("chatBody");
    const sendBtn = document.getElementById("sendBtn");
    const userInput = document.getElementById("userInput");
    const chatButtons = document.getElementById("chatButtons");

    // Function to send a message to the backend and process the response
    const sendMessage = (message) => {
        appendMessage("user", message);
        userInput.value = "";
        
        fetch("chatbot.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "message=" + encodeURIComponent(message)
        })
        .then(response => response.json())
        .then(data => {
            appendMessage("bot", data.message);
            renderButtons(data.buttons);
        })
        .catch(error => {
            console.error("Error sending message:", error);
        });
    };

    // Append messages to the chat window using innerHTML to support clickable links
    const appendMessage = (sender, message) => {
        const div = document.createElement("div");
        div.classList.add("message", sender);
        div.innerHTML = message;
        chatBody.appendChild(div);
        chatBody.scrollTop = chatBody.scrollHeight; // Auto-scroll to the latest message
    };

    // Dynamically render buttons based on backend response
    const renderButtons = (buttons) => {
        chatButtons.innerHTML = ""; // Clear existing buttons
        if (buttons && buttons.length > 0) {
            buttons.forEach(btnText => {
                const btn = document.createElement("button");
                btn.textContent = btnText;
                btn.addEventListener("click", () => {
                    sendMessage(btnText);
                    chatButtons.innerHTML = ""; // Clear buttons after click
                });
                chatButtons.appendChild(btn);
            });
        }
    };

    // Send message when "Send" button is clicked
    sendBtn.addEventListener("click", () => {
        const message = userInput.value.trim();
        if(message !== ""){
            sendMessage(message);
        }
    });

    // Send message on Enter key press within the input field
    userInput.addEventListener("keypress", (event) => {
        if(event.key === "Enter" || event.keyCode === 13){
            const message = userInput.value.trim();
            if(message !== ""){
                sendMessage(message);
            }
        }
    });

    // Optionally, you can start the conversation automatically:
    // sendMessage("hii");
});
