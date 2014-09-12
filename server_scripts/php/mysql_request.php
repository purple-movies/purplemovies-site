<?
//include("db_info.php"); // File containing DB name and user access info for this web address.
$server         = $_POST[ 'server'      ];
$user_name      = $_POST[ 'user_name'   ];
$password       = $_POST[ 'password'    ];
$database       = $_POST[ 'database'    ];
    
$input_string    = $_POST[ 'input_string'  ];     // Get query for manipulating database.
$output_string   = $_POST[ 'output_string' ];     // Get query for data we want returned.

mysql_connect($server, $user_name, $password);                              // Connect to dbs.
@mysql_select_db($database) or die( "Unable to select database..." );       // Select db on system.


// Checks/corrects special characters and splits string into separate queries:
function processQueriesString( $p_string ){
    $p_string   = str_replace( '\\\'',  '\'',   $p_string );
    $p_string   = str_replace( '\"',    '"',    $p_string );
    $p_array    = explode( '||querySplit||',    $p_string );
    return $p_array;
}

// TODO:: We probably need to build something in here that checks the queries ok
// but maybe this can be handled by the flash request class for requesting this php.
if( $input_string ){
    $input_queries = processQueriesString( $input_string );
    //echo '   input string:  ', $input_string;
    
    $query_index = 0;  // Run all queries manipulating the db.
    while( $query_index < count($input_queries) ){
        //echo '<br> input: ', $query_index, ' ', $input_queries[$query_index];
        mysql_query($input_queries[$query_index]);
        $query_index++;
    }
}

// Run output queries and write returned data as XML:
if( $output_string ){
    $output_queries = processQueriesString( $output_string );
    
    //echo '  <br> out string:  ', $output_string;
    
    echo '<?xml version="1.0"?>', "\n", '<data>';
    
    $query_index = 0;
    while( $query_index < count($output_queries) ){
        //echo '<br> output ', $output_queries[$query_index];
        
        $output_result = mysql_query($output_queries[$query_index]); // Run query.
        
        //echo "<qi>", $output_queries[$query_index], "</qi>";
        
        $table_name = mysql_field_table( $output_result, 0 );
        echo "\n", "<", $table_name, ">", "\n"; // Write table start tag.
        
        // Get hight/width of table:
        $number_of_rows         = mysql_numrows(        $output_result );
        $number_of_fields       = mysql_num_fields(     $output_result );
        
        $row_index = 0; // Loop through rows:
        while( $row_index < $number_of_rows ){
                echo "<row index='$row_index'>\n";
                
                $field_index = 0; // Loop through fields of current row:
                while( $field_index < $number_of_fields ){
                    // Write field name and contents:
                    $field_name = mysql_field_name( $output_result, $field_index );
                    echo "\n", '<', $field_name, '>',
                    mysql_result( $output_result, $row_index, $field_index ),
                    '</', $field_name, '>';
                    
                    $field_index++;
                }
                echo "</row>\n";
                $row_index++;
        }
        
        echo "\n", "</", $table_name, ">", "\n"; // Write table end tag.
        $query_index++;
    }
    echo '</data>';
    
}

mysql_close();
?>