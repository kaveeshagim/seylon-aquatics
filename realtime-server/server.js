const express = require("express");
const http = require("http");
const socketIo = require("socket.io");
const cors = require("cors"); // Import cors
const pino = require('express-pino-logger')();

const app = express();
const server = http.createServer(app);
const io = socketIo(server);

app.use(pino);

// Use cors middleware
app.use(cors()); // Enable all CORS requests

// Middleware to parse JSON bodies
app.use(express.json());

// Serve static files (if needed)
app.use(express.static("public"));

app.use((req, res, next) => {
    console.log('Request Headers:', req.headers);
    next();
});


app.use((req, res, next) => {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    next();
});


// Endpoint to receive updates from Laravel
app.post("/updateOrders", (req, res) => {
    const data = req.body;
    console.log("Received updateOrders request:", data);
    io.emit("updateOrders", data); // Broadcast to all clients
    res.sendStatus(200);
});

app.post("/updateOrdersCustomer", (req, res) => {
    const data = req.body;
    console.log("Received customer updateOrders request:", data);
    io.emit("updateOrdersCustomer", data); // Broadcast to all clients
    res.sendStatus(200);
});


// Handle WebSocket connections
io.on("connection", (socket) => {
    console.log("New client connected");

    socket.on("test", (data) => {
        console.log("Received updateOrders event:", data);
      
    });


    // Listen for messages from Laravel
    // socket.on("updateOrders", (data) => {
    //     console.log("Received updateOrders event:", data);
    //     io.emit("orders", data); 
    // });

    socket.on("disconnect", () => {
        console.log("Client disconnected");
    });
});

const PORT = 6050;
server.listen(PORT, () => {
    console.log(`Server running on http://localhost:${PORT}`);
});
