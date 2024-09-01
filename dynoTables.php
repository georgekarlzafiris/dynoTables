<?php 

function build_dynotable($data)
{   
    $imports = '<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>DynoTables</title>
    <style>*{font-family:"Open Sans", sans-serif;}</style>';
    $header = '<div class="dyno-table">
                <div style="display: flex;">';
    $content = '';
    $pagination = '';
    $footer = '</div>';
    $unique = uniqid(); // Unique ID for each table instance

    if (is_array($data) && !empty($data))
    {
        // make header
        $cols = array_keys($data[0]);
        foreach($cols as $col) {
           $header .= '<div style="flex: 1;border-bottom: 2px solid #555; 
                        background: #fafafa;" class="p-2">'.$col.'</div>';
        }
        $header .= '</div>';

        // make content
        $chunks = array_chunk($data, 10);
        foreach($chunks as $id => $chunk)
        {
            $content .= '<div id="chunk'.$unique.$id.'" style="display:none">'; // Ensure divs are initially hidden
            foreach($chunk as $item){
                $content .= '<div style="display: flex;">';            
                foreach($item as $field=>$val) {
                    $content .= '<div class="p-2" style="flex:1;border-bottom:1px solid #ddd;">'.$val.'</div>';
                }
                $content .= '</div>';
            }
            $content .= '</div>';
        }

        // render dyno
        $footer .= '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>';
        $footer .= '<script>
            $(document).ready(function() {
                $("div[id^=\'chunk'.$unique.'\']").hide(); // Hide all chunks initially
                $("#chunk'.$unique.'0").show(); // Show the first chunk
            });

            function render'.$unique.'(id) {
                $("div[id^=\'chunk'.$unique.'\']").hide(); // Hide all chunks for this table
                $("#"+id).show(); // Show the selected chunk
            }
        </script>';

        // Generate pagination for each table
        $pagination .= '<ul class="pagination mt-3">';
        for($i = 0; $i < count($chunks); $i++){
            $pagination .= '<li class="page-item"><a style="cursor:pointer;color:#000;" 
            class="page-link" onclick="render'.$unique.'(\'chunk'.$unique.$i.'\')">'.($i+1).'</a></li>';
        }
        $pagination .= '</ul>';

        return $imports . $pagination . $header . $content .  $footer . $pagination;
    }
}