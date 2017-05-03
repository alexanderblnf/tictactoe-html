function sendMessage() {
    var message = $('#message-input').val();
    if(message != null && message != "") {
        var data = {
            type: 'chat-message',
            message: message
        };
        conn.send(JSON.stringify(data));
        $('#message-input').val("");
    }
}