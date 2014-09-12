<?php

define('FACEBOOK_APP_ID', '101080449955237');
define('FACEBOOK_SECRET', 'bdca43c71d9aa5b45839d1ab0f61d3d3');

function get_facebook_cookie($app_id, $application_secret)
{
    $args = array();
    
    //$args = explode( '&', $_COOKIE );
    
    $app_id = "101080449955237";
    
    parse_str(trim($_COOKIE['fbs_' . $app_id], '\\"'), $args);
    
    
    echo "args 1 :: ", var_dump($args);
    ksort($args);
    echo "args 2 :: ", var_dump($args);
    $payload = '';
    echo "args 3 :: ", var_dump($args);
    
    
    foreach($args as $key => $value)
    {
        if ($key != 'sig') {
            $payload .= $key . '=' . $value;
        }
    }
    if (md5($payload . $application_secret) != $args['sig']) {
      return null;
    }
    return $args;
}

$cookie = get_facebook_cookie(FACEBOOK_APP_ID, FACEBOOK_SECRET);



function writeAuthCode()
{
    $app_id = FACEBOOK_APP_ID;

    echo '<br/><br/>PERMISSIONS INCORRECT :: ', $app_id;

    $auth_uri = "https://graph.facebook.com/oauth/authorize?client_id=$app_id&display=page&scope=publish_stream,read_friendlists&redirect_uri=http://apps.facebook.com/purple-auth-three/?flpid=peer2peer";

    echo '<br/><br/>auth uri :: ', $auth_uri;
?>
    <script>
        top.location.href = "<?=$auth_uri ?>";
    </script>
    <noscript>
        <a href="<?=$auth_uri ?>" target="top"> Please login and grant permissions for this app... </a>
    </noscript><?
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
<head>
    <title>Test HTML Page</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
<?
    echo '<br/><br/> cookie:: ',  var_dump( $_COOKIE );
    echo '<br/><br/> get:: ',  var_dump( $_GET );

    if ( isset($_GET['fb_sig_ext_perms']) )
    {
        $permissions_arr = explode( ',', $_GET['fb_sig_ext_perms'] );
        $permissions_arr = array_flip($permissions_arr);
        
        echo '<br/><br/>', var_dump( $permissions_arr );
        
        echo '<br/><br/>BLAA';
        
        if ( isset($permissions_arr['publish_stream'], $permissions_arr['read_friendlists']) )
        {
            echo 'permissions correct!!!';
        }else
        {
            writeAuthCode();
        }
    } else {
        writeAuthCode();
    }
    /*
        echo '<br/><br/>';
        
        echo '<br/><br/> cookie:: ',  var_dump( $_COOKIE );
        echo '<br/><br/> get:: ',  var_dump( $_GET );
        
        ?><br/>  Logging in... 
        <!--
        <script>
            top.location.href = 'https://graph.facebook.com/oauth/authorize?client_id=<?= $app_id;?>&<?
            
            // DISPLAY MODE
            ?>display=page&<? 
            
            // PERMISSIONS
            ?>scope=publish_stream,read_friendlists&<?
            
            // URL TO REDIRECT TO AFTER
            ?>redirect_uri=http://apps.facebook.com/purple-auth-three/?flpid=peer2peer'
            
        </script>
        -->
        <noscript>
            
            JS DISABLED!!!
            
        </noscript>
        <?
    }*/
?>
    
</head>
<body>

    <div style="width:400px;height:200px;float:left;">
        
        <?//= 'The ID of the current user is ' . $cookie['uid']; ?>
        
    </div>
    
    
    
    <div style="width:400px;height:400px;float:left; clear:both; background:green">
        
        really big div
        
    </div>

</body>
</html>