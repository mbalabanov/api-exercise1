<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Ex. 1</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light" id="top">
    <a class="navbar-brand" href="#top">API Exercise 1</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#top">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#jokes">Jokes</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container my-4">
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="https://fontlot.com/wp-content/uploads/2020/04/bbc-logo-font.jpg" alt="BBC News" class="rounded-lg">
            <h4>Today's News on BBC</h4>
        </div>
    </div>

    <div class="row my-4">
        <?php

            require_once 'restful.php';

            $url = 'http://feeds.bbci.co.uk/news/technology/rss.xml';
            $response = curl_get($url);
            $xml = simplexml_load_string($response);
            foreach ($xml->channel->item as $myitem) {
                echo '<div class="col-md-4">
                        <div class="border rounded-lg m-2 p-3">
                            <p><sub>'.$myitem->pubDate.'</sub></p>
                            <h4><a href="'.$myitem->link.'" target="_blank">'.$myitem->title.'</a></h4>
                            <p>'.$myitem->description.'</p>
                            <p><a href="'.$myitem->link.'" target="_blank" class="btn btn-primary btn-sm">Read more</a></p>
                        </div>
                    </div>';
            }
        ?>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b1/CNN.svg/1920px-CNN.svg.png" alt="BBC News" height="100px">
            <h4>Today's News on CNN</h4>
        </div>
    </div>

    <div class="row my-4">
        <?php
            require_once 'restful.php';

            $url = 'http://rss.cnn.com/rss/edition_technology.rss';
            $response = curl_get($url);
            $xml = simplexml_load_string($response);
            foreach ($xml->channel->item as $myitem) {
                echo '<div class="col-md-4">
                        <div class="border rounded-lg m-2 p-3">
                            <p><sub>'.$myitem->pubDate.'</sub></p>
                            <h4><a href="'.$myitem->link.'" target="_blank">'.$myitem->title.'</a></h4>
                            <p>'.$myitem->description.'</p>
                            <p><a href="'.$myitem->link.'" target="_blank" class="btn btn-primary btn-sm">Read more</a></p>
                            <p>'.$myitem->media.'</p>
                        </div>
                    </div>';
            }
        ?>
    </div>


    <div class="row my-4" id="jokes">
        <div class="col-md-8 offset-md-2 text-center">
            <div class="alert alert-primary" role="alert">
                <h4>Joke of the Day</h4>
                <div id="jokediv" class="m-4"></div>
                <p><sup>Courtesy of <a href="http://api.serri.codefactory.live/random/" target="_blank">http://api.serri.codefactory.live/random/</a></sup></p>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script>

        let jokeoftheday = JSON.parse(`
            <?php 
                require_once 'restful.php';

                $url = 'http://api.serri.codefactory.live/random/';
                $jokesresponse = curl_get($url);

                echo $jokesresponse;
            ?>
            `);

        $("#jokediv").html(jokeoftheday.joke);
    </script>

</body>
</html>