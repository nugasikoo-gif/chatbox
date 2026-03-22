<?php
header('Content-Type: application/json');

$jsonFile = 'messages.json';


$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    
    if (file_exists($jsonFile)) {
        echo file_get_contents($jsonFile);
    } else {
        echo json_encode([]);
    }
} elseif ($method === 'POST') {
    
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (isset($input['user']) && isset($input['message'])) {
        $messages = [];
        if (file_exists($jsonFile)) {
            $messages = json_decode(file_get_contents($jsonFile), true);
        }
        
       
        $time = isset($input['time']) ? htmlspecialchars($input['time']) : date('Y-m-d H:i:s');
        
        $newMessage = [
            'user' => htmlspecialchars($input['user']),
            'message' => htmlspecialchars($input['message']),
            'time' => $time
        ];
        
        $messages[] = $newMessage;
        file_put_contents($jsonFile, json_encode($messages, JSON_PRETTY_PRINT));
        
        echo json_encode(['status' => 'success', 'message' => $newMessage]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    }
}
?>
