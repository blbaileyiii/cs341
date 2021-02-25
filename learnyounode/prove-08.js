var http = require('http');
var url = require('url');

const port = 8888;

const server = http.createServer(onRequest);

server.listen(+port, function () {
    console.log('Server listening on http://localhost:%s', port);
});

function onRequest(req, res){
    let response
    let myURL = url.parse(req.url, true);
    console.log(url.parse(req.url, true));

    let urlParsed = myURL.pathname.split("/");
    switch (urlParsed[1]) {
        case 'home':
            res.statusCode = 200;
            res.setHeader('Content-Type', 'text/html');
            response = "<body>";
            response += "<main>";
            response += "<h1>Welcome to the Home Page</h1>";
            response += "</main>";
            response += "</body>";
            break;
        case 'getData':
            let student = getStudent(myURL.query['student']);
            //let student = {name:"Lee Bailey", class:"cs313"};
            res.statusCode = 200;
            res.setHeader('Content-Type', 'application/json');
            response = JSON.stringify(student);
            break;
        default:
            res.statusCode = 404;            
            res.setHeader('Content-Type', 'text/html');
            response = "<body>";
            response += "<main>";
            response += "<h1>Page Not Found</h1>"
            response += "</main>";
            response += "</body>";
            break;
    }
    res.write(response);
    res.end();
}

function getStudent(student) {
    switch (student) {
        case 'Lee':
            return {name:"Lee Bailey", class:"cs313"};
        case 'Grant':
            return {name:"Grant Berguson", class:"cs313"};
        case 'Erick':
            return {name:"Erick Anderson", class:"cs313"};
        default: 
            return {name:"Not Found", class:""};
    }
}