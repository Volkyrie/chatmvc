//create a new WebSocket object.
var msgBox = $('#message-box');
var wsUri = "ws://localhost:9000/server.php";
websocket = new WebSocket(wsUri);

websocket.onopen = function(ev) { // connection is open 
    msgBox.append('<div class="system_msg" style="color:#bbbbbb">Welcome to my "Demo WebSocket Chat box"!</div>'); //notify user
}
// Message received from server
websocket.onmessage = function(ev) {
    var response = JSON.parse(ev.data); //PHP sends Json data

    var res_type = response.type; //message type
    var user_message = response.message; //message text
    var user_name = response.name; //user name
    var user_color = response.color; //color

    switch (res_type) {
        case 'usermsg':
            msgBox.append('<div><span class="user_name" style="color:' + user_color + '">' + user_name + '</span> : <span class="user_message">' + user_message + '</span></div>');
            break;
        case 'system':
            msgBox.append('<div style="color:#bbbbbb">' + user_message + '</div>');
            break;
    }
    msgBox[0].scrollTop = msgBox[0].scrollHeight; //scroll message 

};

websocket.onerror = function(ev) {
    msgBox.append('<div class="system_error">Error Occurred - ' + ev.data + '</div>');
};
websocket.onclose = function(ev) {
    msgBox.append('<div class="system_msg">Connection Closed</div>');
};

//Message send button
$('#send-message').click(function() {
    send_message();
});

//User hits enter key 
$("#message").on("keydown", function(event) {
    if (event.which == 13) {
        send_message();
    }
});

//Send message
function send_message() {
    var message_input = $('#message'); //user message text
    var name_input = $('#name'); //user name
    var room_input = $('#room'); //room name
    var color_input = $('#color'); //user color

    if (message_input.val() == "") { //empty name?
        alert("Enter your Name please!");
        return;
    }
    if (message_input.val() == "") { //emtpy message?
        alert("Enter Some message Please!");
        return;
    }

    if (room_input.val() == "") { //emtpy room?
        alert("Room was not found!");
        return;
    }

    if (color_input.val() == "") { //emtpy color?
        alert("Color was not found!");
        return;
    }

    //prepare json data
    var msg = {
        message: message_input.val(),
        name: name_input.val(),
        room: room_input.val(),
        color: color_input.val()
    };

    // Envoyr les données du message à la base de données
    store_message(msg);
    //convert and send data to server
    websocket.send(JSON.stringify(msg));
    message_input.val(''); //reset message input
}

//store msg
function store_message(msg) {
    fetch(`/chatmvc/chatmvc/chat/insert`, {
        method: "POST",
        body: JSON.stringify(msg),
        headers: {
            "Content-Type": "application/json",
        }
    })
    .then(response => response.json())
    .catch(error => console.log('An error has occured during msg save: ', error));
}