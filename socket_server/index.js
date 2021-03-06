const { readSync } = require('fs');
const { send } = require('process');

let app = require('express')();

let http = require('http').Server(app);

let io = require('socket.io')(http);

app.get('/', (req, res) => {
    console.log("res");
    res.end();
})
var userCount = 0;
io.on('connection', (socket,user) => {
    userCount++;
    // io.emit('noOfConnections', Object.keys(io.sockets.connected).length)
    io.emit('userCount', { userCount: userCount ,newUser:user});


    socket.on('disconnect', () => {
        console.log('disconnected')
        // io.emit('noOfConnections', Object.keys(io.sockets.connected).length)
        userCount--;
        io.emit('userCount', { userCount: userCount ,newUser:user});
    })




    socket.on('private-message',(msg)=>{
        console.warn("new message",msg);
        socket.broadcast.emit('private-message', msg)
    });
    socket.on('chat-message', (msg) => {

        // io.sockets.in(user.email).emit('new_msg', {msg: 'hello'});
        console.log(msg);
        socket.broadcast.emit('chat-message', msg)

    })
    socket.on('users',(users)=>{
        socket.broadcast.emit('users');
        // console.log(users);
    })

    socket.on('leaved', (name) => {
        socket.broadcast.emit('leaved', name)
        console.log("leaved",name);
    })
    socket.on('joined',(users)=>{
        socket.broadcast.emit('joined', users)


        console.warn('active',users);
    });

    socket.on('typing', (data) => {
        socket.broadcast.emit('typing', data)
    })
    socket.on('stoptyping', () => {
        socket.broadcast.emit('stoptyping')
    })


})

// http.listen(process.env.PORT, () => {
//     console.log('Server is started at http://localhost:3000')
// })

http.listen(3000, () => {
        console.log('Server is started at http://localhost:3000')
    })
