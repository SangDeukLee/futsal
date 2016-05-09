var socket = require( 'socket.io' );
var express = require( 'express' );
var http = require( 'http' );

var app = express();
var server = http.createServer( app );

var io = socket.listen( server );

io.sockets.on( 'connection', function( client ) {
	console.log( "New client !" );

	client.on( 'message', function( data ) {
		// console.log(data);
		// console.log('Message sender ' + data.name + ":" + data.message );
		// console.log('Message received ', data.receive + ":" + data.message);

		// console.log('Roomname : ' + data.roomname);
		// client.broadcast.emit( 'message', { name: data.name, message: data.message } );

		console.log('first : ' + data.name + data.receive);

		client.join(data.name + data.receive); //·ëÀÔÀå
		client.set('room', data.name + data.receive);

		console.log('JOIN ROOM LIST');

		global.message = data.message;
		global.name = data.name;

		//io.sockets.in(data.name + data.receive).emit( 'message', {name: data.name, message: data.message});
		io.sockets.emit('receiver_messages', {name: data.name, message: data.message, receiver : data.receive, open_check : data.open_check});
	});

	client.on('passive_message', function(data){
		console.log('passive : '+ data.receive + data.name);
		client.join(data.receive + data.name); //·ëÀÔÀå
		io.sockets.in(data.receive + data.name).emit('passive_message', {name: data.name, message: data.message});

	});

	client.on('join', function(data){
		console.log('join!!!! : '+ data.receive + data.name);
		client.join(data.receive + data.name); //·ëÀÔÀå
		// io.sockets.broadcast.to(data.receive + data.name).emit('join_response', {name: global.name, message: global.message});
		io.sockets.in(data.receive + data.name).emit('join_response', {name: global.name, message: global.message});
	});

	client.on( 'second_message', function( data ) {
		console.log('second_message : ' + data.name + data.receive);
		//console.log(io.sockets.manager.rooms);
		client.join(data.name + data.receive); //·ëÀÔÀå

		io.sockets.in(data.name + data.receive).emit( 'second_message', {name: data.name, message: data.message});

	});

	client.on('new_count_message', function(data) {
		console.log('dochack : ' + data);
		io.sockets.emit('note', {current_number: data.message, note_receiver : data.note_receiver, send_date : data.send_date, read_status : data.read_status, message_content : data.message_content});
		console.log('success!!!');
		io.sockets.emit('new_message', {current_number: data.message, note_receiver : data.note_receiver, send_date : data.send_date, read_status : data.read_status, message_content : data.message_content});
		console.log('success00000000000000000000000000000!!');
	});


});

server.listen( 3000 );