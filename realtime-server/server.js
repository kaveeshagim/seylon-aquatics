const express = require("express");
const http = require("http");
const socketIo = require("socket.io");
const cors = require("cors"); // Import cors

const app = express();
const server = http.createServer(app);
const io = socketIo(server);

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


// Endpoint to receive updates from Laravel
app.post("/updateOrders", (req, res) => {
    const data = req.body;
    console.log("Received updateOrders request:", data);
    io.emit("orders", data); // Broadcast to all clients
    res.sendStatus(200);
});

// Handle WebSocket connections
io.on("connection", (socket) => {
    console.log("New client connected");

    // Listen for messages from Laravel
    socket.on("updateOrders", (data) => {
        console.log("Received updateOrders event:", data);
        io.emit("orders", data); // Broadcast to all clients
    });

    socket.on("disconnect", () => {
        console.log("Client disconnected");
    });
});

const PORT = 6050;
server.listen(PORT, () => {
    console.log(`Server running on http://localhost:${PORT}`);
});
