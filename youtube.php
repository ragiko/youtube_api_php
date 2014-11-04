<?php

require './vendor/autoload.php';

function getVideoId($artist, $musicTitle){
    // This code will execute if the user entered a search query in the form
    // and submitted the form. Otherwise, the page displays the form above.
    if ($artist != '' && $musicTitle != '') {
        // Call set_include_path() as needed to point to your client library.
        $serchQuery = $artist." ".$musicTitle;
        $maxResults = 1;
        /*
         * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
         * Google Developers Console <https://cloud.google.com/console>
         * Please ensure that you have enabled the YouTube Data API for your project.
         */
        $DEVELOPER_KEY = 'AIzaSyDOWXXqjSREftoZ78WxCJNHWvVyQcL2ogc';
        $client = new Google_Client();
        $client->setDeveloperKey($DEVELOPER_KEY);
        // Define an object that will be used to make all API requests.
        $youtube = new Google_Service_YouTube($client);
        // Call the search.list method to retrieve results matching the specified
        // query term.
        $searchResponse = $youtube->search->listSearch('id,snippet', array(
            'q' => $serchQuery,
            'maxResults' => $maxResults,
        ));
        // Add each result to the appropriate list, and then display the lists of
        // matching videos, channels, and playlists.
        foreach ($searchResponse['items'] as $searchResult) {
            switch ($searchResult['id']['kind']) {
            case 'youtube#video':
                return $searchResult['id']['videoId'];
            }
        }
    }
    return "error!";
}

echo getVideoId("yui", "i feel my soul");
# return -> el4DrR64Qns
# you see youtube -> https://www.youtube.com/watch?v=el4DrR64Qns

