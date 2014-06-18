var express = require('express');
var mongoose = require('mongoose');
var path = require('path');
var app = express();
var request = require('request');

app.use(express.json());

mongoose.connect('mongodb://localhost/myfit');

var Activity = mongoose.model('Activity', {
  name: String,
  timestamp: Date,
  value: Number
});

app.get('/activities', function (req, res, next) {
  res.header('Content-Type', 'application/json');
  Activity.find({}, function (err, activities) {
    res.send(activities);
  });
});

app.post('/activities', function (req, res, next) {
  res.header('Content-Type', 'application/json');

  Activity.create(
    {
      name: req.body.name,
      value: req.body.value,
	    timestamp: Date.now()
    }
  ),
  function (err, activity) {
    console.log('responding');
    res.send(activity);
  }
});

app.all('/articles*', function (req, res, next) {
	res.header('Content-Type', 'application/json');

	//console.log(req.url);
	request(
		{
			url: 'http://127.0.0.1:8080/api' + req.url,
			body: JSON.stringify(req.body),
			method: req.method
		},
		function (error, response, body) {
			res.send(body);
		}
	);
})

app.use(express.static(path.join(__dirname, 'app')));

var server = app.listen(3000, function() {
    console.log('Listening on port %d', server.address().port);
});
