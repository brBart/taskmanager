    var socket = io('http://127.0.0.1:3000');

    socket.on("task-channel:App\\Events\\TaskEvent", function(message){
        vm.FetchTasks();
    });