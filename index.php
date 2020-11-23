<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Ex. 1</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm" id="top">
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
                <a class="nav-link" href="#bbcnews">BBC News</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#cnnnews">CNN News</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#jokes">Jokes</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
        <?php

            require_once 'restful.php';

            $url = 'http://feeds.bbci.co.uk/news/technology/rss.xml';
            $response = curl_get($url);
            $xml = simplexml_load_string($response);

            echo '
            <div class="row" id="bbcnews">
                <div class="col-md-12 text-center mt-5">
                    <img src="'.$xml->channel->image->url.'" alt="'.$xml->channel->title.'">
                    <h4>'.$xml->channel->title.'</h4>
                </div>
            </div>
    
            <div class="row my-4">
            ';

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
            echo '</div>';
        ?>


        <?php
            require_once 'restful.php';

            $url = 'http://rss.cnn.com/rss/edition_technology.rss';
            $response = curl_get($url);
            $xml = simplexml_load_string($response);

            echo '
            <div class="row mt-5" id="cnnnews">
                <div class="col-md-12 text-center mt-5">
                    <img src="'.$xml->channel->image->url.'" alt="'.$xml->channel->title.'">
                    <h4>'.$xml->channel->title.'</h4>
                </div>
            </div>
    
            <div class="row my-4">
            ';

            foreach ($xml->channel->item as $myitem) {

                $namespaces = $myitem->getNameSpaces(true);
                $media = $myitem->children($namespaces['media']);
                $thumb_url = $media->content->attributes()->url;

                echo '<div class="col-md-6">
                        <div class="border rounded-lg m-2 p-3">

                            <div class="row">
                                <div class="col-3">
                                    <a href="'.$myitem->link.'" target="_blank"><img src="'.$thumb_url.'" alt="'.$myitem->title.'" class="img-fluid border rounded-lg"></a>
                                </div>
                                <div class="col-9">
                                    <h4><a href="'.$myitem->link.'" target="_blank">'.$myitem->title.'</a></h4>
                                    <p>'.$myitem->description.'</p>
                                    <p><sup>'.$myitem->pubDate.'</sup></p>
                                    <p><a href="'.$myitem->link.'" target="_blank" class="btn btn-primary btn-sm">Read more</a></p>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
            echo '</div>';
        ?>



    <div class="row my-4" id="jokes">
        <div class="col-md-8 offset-md-2 text-center">
            <div class="alert alert-primary" role="alert">
                <h4>Serri's Joke of the Day</h4>
                <blockquote class="blockquote">
                    <?php 
                        require_once 'restful.php';

                        $url = 'http://api.serri.codefactory.live/random/';
                        $jokesresponse = curl_get($url);
                        $jokeoftheday = json_decode($jokesresponse);

                        echo $jokeoftheday->joke;
                    ?>
                    <footer class="blockquote-footer">Courtesy of <cite title="Source Title"><a href="http://api.serri.codefactory.live/random/" target="_blank">http://api.serri.codefactory.live/random/</a></cite></footer>
                </blockquote>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>