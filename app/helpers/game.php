<?php 
function DominoQQ($gameplay_log)
{
    $json_gameplay = preg_replace('#\s+#',',',trim($gameplaylog));
    $kurungawalakhir = "[".$json_gameplay."]";
    $arrayjson_decode = json_decode($kurungawalakhir, true); 
    return $arrayjson_decode;
}

function array_gameplaylog($gameplay_log)
{
    $json_gameplay = preg_replace('#\s+#',',',trim($gameplay_log));;
    $kurungawalakhir = "[".$json_gameplay."]";
    $arrayjson_decode = json_decode($kurungawalakhir, true); 
    return $arrayjson_decode;
}
?>