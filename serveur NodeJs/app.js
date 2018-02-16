// Chargement modules
var http = require('http');
var url = require("url");


// Initialisation
var port = 8080;
var server = http.createServer();
var io = require('socket.io').listen(server);

// Quand un client se connecte
io.sockets.on('connection', function (socket) {
	// Réception message de PHP
	socket.on('emitPHP', function (data) {
		socket.broadcast.emit(data.receiver, data);
		socket.broadcast.emit('popo', data);
	})
});

server.listen(port);
