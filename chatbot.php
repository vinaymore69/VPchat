<?php
// chatbot.php
session_start();
header('Content-Type: application/json');
require_once('includes/db.php');

// Helper function to send responses
function sendResponse($message, $buttons = array()) {
    echo json_encode(['message' => $message, 'buttons' => $buttons]);
    exit;
}

// Only process POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userInput = isset($_POST['message']) ? trim($_POST['message']) : '';

    // If no input provided, ask the user to say "hii" to start
    if ($userInput === '') {
        sendResponse("Hi! Please type 'hii' to start the conversation.");
    }

    // Conversation start: Accept both "hi" and "hii"
    if (in_array(strtolower($userInput), ['hi', 'hii'])) {
        $message = "Hello! What information would you like to know about?";
        $buttons = ["College Details", "Department Details", "Staff Details", "Syllabus Details"];
        sendResponse($message, $buttons);
    }

    // Handle College Details
    if ($userInput === "College Details") {
        // Fetch HTML content from the "college_info" table
        $query = "SELECT description FROM college_info WHERE title = 'College Details' LIMIT 1";
        $result = $mysqli->query($query);
        
        // Debug logging
        error_log("Query: " . $query);
        if ($result) {
            error_log("Rows found: " . $result->num_rows);
        } else {
            error_log("Query error: " . $mysqli->error);
        }
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $message = $row['description']; // HTML content with clickable links
        } else {
            $message = "College details not available at the moment.";
        }
        sendResponse($message);
    }
    
    // Handle Department Details: Provide department options as buttons
    if ($userInput === "Department Details") {
        $message = "Please choose a department:";
        $buttons = ["Computer Engineering", "Information Technology", "Electronics And Telecommunication"];
        sendResponse($message, $buttons);
    }

    // Handle department selections by fetching details from the database
    if ($userInput === "Computer Engineering" || $userInput === "Information Technology" || $userInput === "Electronics And Telecommunication") {
        // Adjust the query based on the department selected
        $query = "SELECT description FROM department_info WHERE title = '" . $mysqli->real_escape_string($userInput) . "' LIMIT 1";
        $result = $mysqli->query($query);

        // Debug logging for department query
        error_log("Department Query: " . $query);
        if ($result) {
            error_log("Department Rows found: " . $result->num_rows);
        } else {
            error_log("Department Query error: " . $mysqli->error);
        }
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $message = $row['description']; // HTML content with department details
        } else {
            $message = "$userInput details are not available at the moment.";
        }
        sendResponse($message);
    }

    // Handle Staff Details (Placeholder)
    if ($userInput === "Staff Details") {
        $message = "Staff details are currently not available. [Placeholder for Staff Details]";
        sendResponse($message);
    }

    // Handle Syllabus Details: Ask for year
    if ($userInput === "Syllabus Details") {
        $message = "Which year do you want the syllabus for?";
        $buttons = ["1st Year", "2nd Year", "3rd Year"];
        sendResponse($message, $buttons);
    }

    // For syllabus details by year
    if (in_array($userInput, ["1st Year", "2nd Year", "3rd Year"])) {
        $message = "Here is the syllabus for $userInput. [Replace with detailed syllabus information from the database]";
        sendResponse($message);
    }

    // Fallback response if none of the conditions match
    sendResponse("I'm sorry, I didn't understand that. Please select one of the options provided.");
} else {
    sendResponse("Invalid request.");
}
