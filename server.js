var http = require('http');
var url = require('url');  
var fs = require('fs'); 

function onRequest(request, response){
	var path = url.parse(request.url).pathname; 
	switch (path) {  
        case '/':  
            response.writeHead(200, {  
                'Content-Type': 'text/plain'  
            });  
            response.write("This is Test Message.");  
            response.end();  
            break;  
        case '/index.php':  
            fs.readFile(__dirname + path, function(error, data) {  
                if (error) {  
                    response.writeHead(404);  
                    response.write(error);  
                    response.end();  
                } else {  
                    response.writeHead(200, {  
                        'Content-Type': 'text/html'  
                    });  
                    response.write(data);  
                    response.end();  
                }  
            });  
            break; 
    default:

	response.writeHead(200, {'Content-Type': 'text/plain'});
	response.write('Ouch oof error that sucks');
	response.end();
	break;
	}  
}; 

http.createServer(onRequest).listen(1234);