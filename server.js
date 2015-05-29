// server.js

// BASE SETUP
// ===================================================================================
var express    = require('express');      // call express
var app        = express();               // define our app using express.
var bodyParser = require('body-parser');

var kloekecode = require('./controllers/kloekecodes'); // Call controller functions for kloekecodes.

// configure app to use bodyParser()
// this will let us get the data from POST.
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

var port = process.env.PORT || 8080;      // Set our port.

// ROUTES FOR OUR API
// ====================================================================================
app.get('/', function(req, res) {
    res.json({ message: 'hooray! welcome to our api!' });
});

// ROUTES: Kloekecodes
app.get('/me', kloekecode.setup);

// START THE SERVER
// =============================================================================
app.listen(port);
console.log('Magic happens on port ' + port);




