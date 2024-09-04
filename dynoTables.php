<?php 

function build_dynotable($data)
{   
    $unique = uniqid(); 
    $imports = '<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>DynoTables</title>
    <style>*{font-family:"Open Sans", sans-serif;}</style>';
    $header = '<script>
        var dynoData'.$unique.' = '.json_encode($data).';
        var orderFlag = true;
        function chunk(arr, chunkSize) {
            if (chunkSize <= 0) throw "Invalid chunk size";
            var R = [];
            for (var i=0,len=arr.length; i<len; i+=chunkSize)
                R.push(arr.slice(i,i+chunkSize));
            return R;
        }             
        function init'.$unique.'() {
            $("div[id^=\'chunk'.$unique.'\']").hide(); // Hide all chunks initially
            $("#chunk'.$unique.'0").show(); // Show the first chunk
        } 
        function render'.$unique.'(id) {
            $("div[id^=\'chunk'.$unique.'\']").hide(); // Hide all chunks for this table
            $("#"+id).show(); // Show the selected chunk
        }
        function sortByKey'.$unique.'(key) {    
            dynoData'.$unique.'.sort((a, b) => {
                if (a[key] < b[key]) return orderFlag ? -1 : 1;
                if (a[key] > b[key]) return orderFlag ? 1 : -1;
                return 0;
            });
            console.log(dynoData'.$unique.');
            orderFlag = !orderFlag; // Toggle sort order 
            var dynoStr  = "";
            var chunks = chunk(dynoData'.$unique.', 10);
            chunks.forEach((item, index) => {
                dynoStr += `<div id="chunk'. $unique.'${index}" style="display:none;">`;
                item.forEach((inner) => {
                    var innerItems = Object.entries(inner);
                    innerItems = innerItems.flat();
                    dynoStr += `<div style="display: flex;">`;
                    for(var i = 0; i < innerItems.length; i++)
                    {
                        if (i%2==1) dynoStr += `<div class="p-2" style="flex:1;border-bottom:1px solid #ddd;">${innerItems[i]}</div>`;
                    }
                    dynoStr += `</div>`;
                });
                dynoStr+= `</div>`;
            });
            dynoStr += `</div>`;
            
            document.getElementById("cont'.$unique.'").innerHTML = dynoStr; 
            init'.$unique.'();                      
        }
    </script>
    <div class="dyno-table">
                <div style="display: flex;">';
    $content = '';
    $pagination = '';
    $footer = '</div>';

    if (is_array($data) && !empty($data))
    {
        // make header
        $cols = array_keys($data[0]);
        foreach($cols as $col) {
           $header .= '<div style="flex: 1;border-bottom: 2px solid #555;cursor:pointer; 
                        background: #fafafa;" onclick="sortByKey'.$unique.'(`'.$col.'`)" class="p-2">'.$col.'</div>';
        }
        $header .= '</div>';    
        // make content
        $content .= '
            <div id="cont'.$unique.'"></div>
            <script>              
                var dynoStr'.$unique.' = "";
                var chunks'.$unique.' = chunk(dynoData'.$unique.', 10);
                chunks'.$unique.'.forEach((item, index) => {
                    dynoStr'.$unique.' += `<div id="chunk'. $unique.'${index}" style="display:none;">`;
                    item.forEach((inner) => {
                        var innerItems = Object.entries(inner);
                        innerItems = innerItems.flat();
                        dynoStr'.$unique.' += `<div style="display: flex;">`;
                        for(var i = 0; i < innerItems.length; i++)
                        {
                            if (i%2==1) dynoStr'.$unique.' += `<div class="p-2" style="flex:1;border-bottom:1px solid #ddd;">${innerItems[i]}</div>`;
                        }
                        dynoStr'.$unique.' += `</div>`;
                    });
                    dynoStr'.$unique.' += `</div>`;
                });
                dynoStr'.$unique.' += `</div>`;
                
                document.getElementById("cont'.$unique.'").innerHTML = dynoStr'.$unique.';
            </script>
            
        ';
        // render dyno
        $footer .= '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>';
        $footer .= '<script>init'.$unique.'();</script>';

        // Generate pagination for each table
        $pagination .= '<div id="pgn'.$unique.'" style="display:flex;" class="mt-3 mb-5"></div>
            <script>
                var pageStr'.$unique.' = "";         
                for(var i = 0; i < chunks'.$unique.'.length; i++){
                    pageStr'.$unique.' += `<div style="cursor:pointer;display:inline;padding:.3em .6em;border:1px solid #ddd;margin-right:.2em;" 
                        onclick="render'.$unique.'(\'chunk'.$unique.'${i}\')">${i+1}</div>`
                }
                document.getElementById("pgn'.$unique.'").innerHTML = pageStr'.$unique.';
            </script>
        ';        

        return $imports . $header . $content .  $footer . $pagination;
    }
}