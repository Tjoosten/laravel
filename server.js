// server.js

// BASE SETUP
// ===================================================================================
var express    = require('express');      // call express
var bodyParser = require('body-parser');
global.mysql   = require('mysql');
var config     = require('config');
var dbConfig   = config.get('server.dbConfig');
var app        = express();               // define our app using express.

var kloekecode = require('./controllers/kloekecodes'); // Call controller functions for kloekecodes.

// MySQL Config
// ====================================================================================
// Config head.
global.connection = mysql.createConnection({
    host      : dbConfig.host,
    user      : dbConfig.user,
    password  : dbConfig.password,
    database  : dbConfig.database,
});

// Check MySQL Connection.
connection.connect(function(err) {
    if(!err) console.log(" [SUCCESS] Database is connected ... \n\n");
    else     console.log(" [ERROR] Database could not connect ... \n\n");
});

// configure app to use bodyParser()
// this will let us get the data from POST.
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

var port = process.env.PORT || 8080;      // Set our port.

// ROUTES FOR OUR API
// ====================================================================================
app.get('/', function(req, res) {

});

// ROUTES: Kloekecodes
app.get('/kloekecode/all', kloekecode.all);

// START THE SERVER
// =============================================================================
app.listen(port);
console.log(" [SUCCESS] Magic happens on port " + port);




