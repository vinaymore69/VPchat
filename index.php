<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include('config.php');
$username = $_SESSION['username'] ?? "User";
$firstLetter = strtoupper(substr($username, 0, 1));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>ChatGPT Interface</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-[#212121] text-white h-screen flex flex-col">

  <!-- Top Bar -->
  <div class="flex justify-between items-center p-4 bg-[#212121] relative">
    <div class="flex items-center space-x-2">
      <i class="fas fa-robot text-xl"></i>
      <span class="text-lg">ChatGPT</span>
      <i class="fas fa-chevron-down text-sm"></i>
    </div>

    <!-- Profile Dropdown -->
    <div class="relative">
      <button id="profileDropdownBtn" class="flex items-center space-x-2 focus:outline-none">
        <span class="text-lg"><?php echo htmlspecialchars($username); ?></span>
        <div class="w-8 h-8 flex items-center justify-center rounded-full bg-blue-500 text-white font-bold">
          <?php echo $firstLetter; ?>
        </div>
      </button>

      <!-- Dropdown Menu with Logout -->
      <div id="profileDropdown" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg hidden">
        <a href="logout.php" class="block px-4 py-2 text-red-600 hover:bg-gray-100">Logout</a>
      </div>
    </div>
  </div>

  <!-- Chat Area -->
  <div class="flex-1 overflow-y-auto p-4 space-y-4" id="chatBody">
    <!-- Messages will be dynamically added here -->
  </div>

  <!-- Input Area -->
  <div class="p-4 bg-[#212121] flex justify-center">
    <div class="relative w-3/5">
      <input id="userInput" class="w-full p-6 pl-16 pr-20 bg-[#303030] rounded-full text-gray-300 focus:outline-none text-lg" placeholder="Type a message Hi to Start..." type="text">
      <button id="sendBtn" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gray-600 p-2 rounded-full">
        <i class="fas fa-paper-plane"></i>
      </button>
    </div>
  </div>

  <script>
    // Profile Dropdown functionality
    document.addEventListener("DOMContentLoaded", function () {
      const dropdownBtn = document.getElementById("profileDropdownBtn");
      const dropdownMenu = document.getElementById("profileDropdown");

      dropdownBtn.addEventListener("click", () => {
          dropdownMenu.classList.toggle("hidden");
      });

      document.addEventListener("click", (event) => {
          if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
              dropdownMenu.classList.add("hidden");
          }
      });

      // Periodic session check
      setInterval(() => {
          fetch("session_check.php")
          .then(response => response.json())
          .then(data => {
              if (!data.logged_in) {
                  alert("Session expired. Redirecting to login page.");
                  window.location.href = "login.php";
              }
          });
      }, 5000);
    });

    // Chat UI functionality with streaming logic
    document.addEventListener("DOMContentLoaded", function () {
      const chatBody = document.getElementById("chatBody");
      const userInput = document.getElementById("userInput");
      const sendBtn = document.getElementById("sendBtn");

      // Typewriter effect (streaming logic)
      function typeWriterEffect(element, html, index = 0, result = "", tagBuffer = "", insideTag = false) {
          if (index < html.length) {
              const current = html[index];
              if (current === '<') {
                  insideTag = true;
                  tagBuffer += current;
              } else if (current === '>' && insideTag) {
                  tagBuffer += current;
                  result += tagBuffer;
                  element.innerHTML = result;
                  tagBuffer = "";
                  insideTag = false;
              } else if (insideTag) {
                  tagBuffer += current;
              } else {
                  result += current;
                  element.innerHTML = result;
              }
              chatBody.scrollTop = chatBody.scrollHeight;
              setTimeout(() => typeWriterEffect(element, html, index + 1, result, tagBuffer, insideTag), 5);
          }
      }
      
      // Function to add message with streaming logic and optional buttons
      function addMessage(text, sender, buttons = []) {
          const messageContainer = document.createElement("div");
          messageContainer.classList.add("flex", "items-start", "space-x-4");
          if (sender === "user") {
              messageContainer.classList.add("flex-row-reverse");
          }

          const avatar = document.createElement("div");
          avatar.classList.add("rounded-full", "w-[40px]", "h-[40px]", "flex", "items-center", "justify-center", "bg-gray-500", "text-white", "font-bold","ml-[20px]", "mr-[20px]");
          avatar.textContent = sender === "user" ? "<?php echo $firstLetter; ?>" : "B";

          const messageBubble = document.createElement("div");
          messageBubble.classList.add("p-4", "rounded-lg", sender === "user" ? "bg-[#303030]" : "bg-gray-700");
          const messageText = document.createElement("p");
          messageBubble.appendChild(messageText);

          messageContainer.appendChild(avatar);
          messageContainer.appendChild(messageBubble);
          chatBody.appendChild(messageContainer);

          typeWriterEffect(messageText, text);

          // If buttons are provided, add them after the streaming is complete
          if (buttons.length > 0) {
              const plainTextLength = text.replace(/<[^>]*>/g, '').length;
              setTimeout(() => {
                  const buttonContainer = document.createElement("div");
                  buttonContainer.classList.add("flex", "flex-wrap", "gap-2", "mt-2");
                  buttons.forEach((btnText) => {
                      const button = document.createElement("button");
                      button.classList.add("bg-gray-600", "text-white", "px-4", "py-2", "rounded-lg", "hover:bg-gray-500");
                      button.textContent = btnText;
                      button.addEventListener("click", function () {
                          sendMessage(btnText);
                      });
                      buttonContainer.appendChild(button);
                  });
                  chatBody.appendChild(buttonContainer);
                  chatBody.scrollTop = chatBody.scrollHeight;
              }, plainTextLength * 5);
          }
      }

      // Function to send a message and handle the response
      function sendMessage(message) {
          if (message.trim() === "") return;
          addMessage(message, "user");
          fetch("chatbot.php", {
              method: "POST",
              headers: { "Content-Type": "application/x-www-form-urlencoded" },
              body: "message=" + encodeURIComponent(message),
          })
              .then(response => response.json())
              .then(data => {
                  addMessage(data.message, "bot", data.buttons || []);
              })
              .catch(error => {
                  console.error("Error:", error);
                  addMessage("An error occurred. Please try again.", "bot");
              });
          userInput.value = "";
      }

      sendBtn.addEventListener("click", function () {
          sendMessage(userInput.value);
      });

      userInput.addEventListener("keypress", function (event) {
          if (event.key === "Enter") {
              sendMessage(userInput.value);
          }
      });
    });
  </script>

</body>
</html>
