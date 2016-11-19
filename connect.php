 <?php
        // Enabling error reporting
        error_reporting(-1);
        ini_set('display_errors', 'On');

        require_once __DIR__ . '/firebase.php';
        require_once __DIR__ . '/push.php';

        $firebase = new Firebase();
        $push = new Push();

        // optional payload
        $payload = array();
        $payload['team'] = 'India';
        $payload['score'] = '5.6';

        // notification title
        /*$title = isset($_GET['title']) ? $_GET['title'] : '';*/
        $title ="Aisle Alert";
            
        // notification message
        /*$message = isset($_GET['message']) ? $_GET['message'] : '';*/
        $message = "Requested on Aisle 1";

        // push type - single user / topic
        /*$push_type = isset($_GET['push_type']) ? $_GET['push_type'] : '';*/
        $push_type = "individual";

        // whether to include to image or not
        $include_image = isset($_GET['include_image']) ? TRUE : FALSE;


        $push->setTitle($title);
        $push->setMessage($message);
        if ($include_image) {
            $push->setImage('http://api.androidhive.info/images/minion.jpg');
        } else {
            $push->setImage('');
        }
        $push->setIsBackground(FALSE);
        $push->setPayload($payload);


        $json = '';
        $response = '';

        if ($push_type == 'topic') {
            $json = $push->getPush();
            $response = $firebase->sendToTopic('global', $json);
        } else if ($push_type == 'individual') {
            $json = $push->getPush();
            /*$regId = isset($_GET['regId']) ? $_GET['regId'] : '';*/
            /*$myfile = fopen("assitfile.txt", "r") or die("Unable to open file!");*/
            //echo fgets($myfile);
            /*$regId = fgets($myfile);*/
            /*fclose($myfile);*/
            $regId = "cNfyppihFaU:APA91bHwPIxaIskfQ-ajjsHQKJOKA6b-ePdXfFfuJhxXPF0PpZ4hLIJHzFrqefaojrBWdWPDol1fKQs7gdf0AQqes3E-GtARp2Xnfa4gpMZKubtfIl_t5uUaomJtfOMOKI61UmMSn3Bu";
            $response = $firebase->send($regId, $json);
        }
        ?>