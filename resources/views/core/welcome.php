<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Cloudant CRUD REST API in PHP</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>REST API for CRUD actions on <a href="https://cloudant.com/">Cloudant</a> NoSQL database</h1>
            <p class="lead">Written in <a href="https://lumen.laravel.com/">Laravel Lumen</a> PHP micro-framework</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h2>Document</h2>
            <h3>Get all documents</h3>
            <p>
                To list all the databases in an account, make a GET request against <br>
                <a href="#">https://<span class="text-warning">$REST_API_HOST</span>/api/document/<span class="text-warning">{database}</span>/list</a>
            </p>
            <p>
                <strong>Response</strong><br>
                The response is a JSON string with all documents in specified database. Example response:<br>
            </p>
            <pre>{"total_rows":6,"offset":0,"rows":
[ {"id":"6e1de46a7952e8fe5fab71f78b9a1ac0","key":"6e1de46a7952e8fe5fab71f78b9a1ac0","value":{"rev":"2-5c1cca70ba12be2512d3d15cb020d661"},"doc":{"_id":"6e1de46a7952e8fe5fab71f78b9a1ac0","_rev":"2-5c1cca70ba12be2512d3d15cb020d661","title":"Event name (Updated)","description":"Lorem Ipsum from Lumen","when":"1.5.2016","where":"Bratislava","who":"Martin Starosta"}},
{"id":"f742b203839926c22bd4c91b082534af","key":"f742b203839926c22bd4c91b082534af","value":{"rev":"1-f77d5086723cf7db2a54abfad8127c5a"},"doc":{"_id":"f742b203839926c22bd4c91b082534af","_rev":"1-f77d5086723cf7db2a54abfad8127c5a","description":"Phasellus mollis diam elit, vel ornare nisl tempus sed. Nunc sed vulputate sem, venenatis aliquam tortor. Ut vel suscipit erat. Pellentesque rutrum justo in mi scelerisque, quis ornare tellus tincidunt. Donec mauris leo, consectetur a leo id, maximus venenatis sem. Morbi posuere et enim ac interdum. Nunc a cursus tellus. Nullam vulputate massa sed sagittis vehicula. Donec venenatis rhoncus purus sit amet dictum. Integer varius at erat ut dapibus.","title":"Event 2","when":"22.2.2016","where":"Bratislava","who":"React"}} ]}
            </pre>

            <h3>Create new document</h3>
            <p>
                To create new document, make a POST request to the URL below. Put document fields in <strong>data</strong> array.<br>
                <a href="#">https://<span class="text-warning">$REST_API_HOST</span>api/document/<span class="text-warning">{database}</span>/insert</a>
            </p>
            <p>Example request parameters:</p>
            <pre>data[title]=My document title
data[description]=Lorem Ipsum dolor</pre>
            <p>
                <strong>Response</strong><br>
                The response is a JSON string with action result. Example response:<br>
            </p>
            <pre>{"ok":true,"id":"044b37c6783ad8c7eac9a17fa82c0e45","rev":"1-1xf8b2c6cf6a496dcf405685861ab529"}</pre>

            <h3>Update existing document</h3>
            <p>
                To update existing document, make a POST request to the URL below. Put document fields in <strong>data</strong> array.<br>
                <a href="#">https://<span class="text-warning">$REST_API_HOST</span>api/document/<span class="text-warning">{database}</span>/update/<span class="text-warning">{id}</span></a>
            </p>
            <p>Example request parameters:</p>
            <pre>data[title]=My document title(Updated)
data[description]=Lorem Ipsum dolor ahmed dahmed.</pre>
            <p>
                <strong>Response</strong><br>
                The response is a JSON string with action result. Example response:<br>
            </p>
            <pre>{"ok":true,"id":"044b37c6783ad8c7eac9a17fa82c0e45","rev":"1-1xf8b2c6cf6a496dcf405685861ab529"}</pre>

            <p>If not existing _id is entered, following response will be returned:</p>
            <pre>{"error":"not_found","reason":"missing"}</pre>
            
            <h3>Get document by _id</h3>
            <p>
                To get specific document by its _id, make a GET request against<br>
                <a href="#">https://<span class="text-warning">$REST_API_HOST</span>/api/document/<span class="text-warning">{database}</span>/read/<span class="text-warning">{id}</span></a>
            </p>
            <p>
                <strong>Response</strong><br>
                The response is a JSON string with specified document in specified database. Example response:<br>
            </p>
            <pre>{"_id":"6e1de46a7952e8fe5fxx71f78b9a1ac0","_rev":"2-5c1cca70ba12be2512d3d15cb020d661",
                "title":"Event name","description":"Lorem Ipsum from Lumen","when":"1.5.2016",
                "where":"Bratislava","who":"Martin Starosta"} </pre>
            <p>If not existing _id is requested, following response will be returned:</p>
            <pre>{"error":"not_found","reason":"missing"}</pre>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h2>Database</h2>
            <h3>Get all databases</h3>
            <p>
                To list all the databases in an account, make a GET request against <a
                    href="<?= $_SERVER['REQUEST_URI'] ?>api/database/list">https://<span class="text-warning">$REST_API_HOST</span>/api/database/list</a>
            </p>
            <p>
                <strong>Response</strong><br>
                The response is an array with all database names. Example response:<br>
            </p>
            <pre>["database1","database2"]</pre>


        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>