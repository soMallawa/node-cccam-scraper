const request = require('request');
const cheerio = require('cheerio');
const express = require('express');
const date = require('node-datetime');

const app = express()
//Header for validate :D
var options = {
    headers: {'user-agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'}
  }

var server = app.listen(3000, function () {
    console.log("API Started on port:", server.address().port);
});

  app.get("/api/servers", function (req, res) {

    var dt = date.create();
    var today = dt.format('Y-m-d');
    console.log('Request from Client.');

    request('https://testious.com/free-cccam-servers/'+today+'/', options, (error, response, data) => {

        if (!error && response.statusCode == 200){
            const $ = cheerio.load(data);
            const Cccam = $('.entry').find('div');
            const rawCccamFeed = Cccam.text().replace(/[\t]/g,'').split("\n");
            const clines = Object.values(rawCccamFeed);
            console.log('Fetched Servers: '+rawCccamFeed.length+' ( '+today+' ) ');
            res.status(200).send(clines);
        } else {
            res.status(200).send("No Servers");
        }

    });
  });
