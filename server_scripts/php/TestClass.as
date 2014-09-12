package
{
	import purplemovies.net.DBCommunicator;
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	import flash.events.Event;
	
	import flash.display.Sprite;
	public class TestClass extends Sprite{
		
		function TestClass(){
			//trace('bob');
			
			var loader = new DBCommunicator("http://localhost/server_scripts/php/mysql_request.php",
										   "localhost",
										   "test",
									   		'root',
									   		"catman"
									   		);
			/*
			,
									   		null,
									   		' ||querySplit|| SELECT * FROM s2s_scores where name = "John"'
											
											INSERT INTO s2s_scores VALUES ( 1, 'BILLY', 2000 )  ||querySplit|| INSERT INTO s2s_scores VALUES ( 1, 'mandy', 2000 )  
			*/
			
			loader.addQuery( 'INSERT INTO s2s_scores VALUES ( 1, "Roger", 2000 )',			DBCommunicator.IN  );
			loader.addQuery( 'INSERT INTO s2s_scores VALUES ( 1, "TheCabinBoy", 2000 )',	DBCommunicator.IN  );
			loader.addQuery( 'SELECT * FROM s2s_scores',						DBCommunicator.OUT );
			loader.addQuery( 'SELECT * FROM s2s_scores where name = "John"',	DBCommunicator.OUT );
			trace( loader.out_string );
			
			loader.addEventListener(Event.COMPLETE, completeHandler);
			loader.communicate();
			
			loader.load( new URLRequest('stuff') );
		}
		
		private function completeHandler(event:Event) {
			var loader2:URLLoader = URLLoader(event.target);
			//trace(loader2.data);
			var my_xml = new XML(loader2.data);
			trace(my_xml);
		}
		
	}
}



/*

var request:URLRequest = new URLRequest("http://localhost/server_scripts/php/mysql_request.php");

var variables:URLVariables = new URLVariables();

variables.server		= "localhost";
variables.user_name		= 'root';
variables.password		= "catman";
variables.database		= "test";
variables.input_string	= "INSERT INTO s2s_scores VALUES (1, 'ralph', 2000)  ||querySplit|| INSERT INTO s2s_scores VALUES (1, 'frank', 2000)";
variables.output_string	= 'SELECT * FROM s2s_scores ||querySplit|| SELECT * FROM s2s_scores where name = "John"';

request.data = variables;

//request.data	= request_data;
request.method	= URLRequestMethod.POST;

var loader:URLLoader = new URLLoader();
loader.addEventListener(Event.COMPLETE, completeHandler);

loader.load(request);



function completeHandler(event:Event):void
{
    var loader2:URLLoader = URLLoader(event.target);
    trace(loader2.data);
	var my_xml = new XML(loader2.data);
	trace(my_xml);
}




//LoaderInfo

var tf = new TextField();
//tf.text = loaderInfo.parameters.one_var;
addChild(tf);
*/