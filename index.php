<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>WEB CHAT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container-fluid p-0 p-sm-4">
        <div class="chat-container">
            <div class="chat-header">
                <?php
                $xml = simplexml_load_file('config.xml');
                $appName = $xml ? (string)$xml->appName : 'Terminal_Chat.exe';
                ?>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="d-none d-sm-inline"> <?php echo $appName; ?></span>
                </div>
            </div>
            
            <div id="chat-box" class="chat-box">
                <div class="message-item">
                    <span class="message-user">SYSTEM</span>
                    <span class="message-text">Initializing connection... OK</span>
                    <span class="message-time"><?php echo date('Y-m-d H:i:s'); ?></span>
                </div>
            </div>
            
            <div class="chat-footer">
                <form id="chat-form" class="row g-2 align-items-center">
                    <div class="col-12 col-md-3">
                        <div class="input-group">
                            <span class="input-group-text bg-black text-success border-success" style="font-family: monospace; font-size: 0.8rem;">ID:</span>
                            <input type="text" id="user" class="form-control" placeholder="user_null" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <div class="input-group">
                            <span class="input-group-text bg-black text-success border-success" style="font-family: monospace; font-size: 0.8rem;">CMD></span>
                            <input type="text" id="message" class="form-control" placeholder="enter_command..." required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <button type="submit" class="btn btn-send w-100">EXECUTE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
