   <style type="text/css">

        @media only screen and (max-width: 767px) {

        @php
        $subtitle_size = .5 ;
        $title_size = .5 ;
        $details_size = .5 ;
            foreach ($sliders as $slider){
                
                if(!empty($slider->subtitle_size)){
                 $subtitle_size = $slider->subtitle_size*.5;
                  } 
            
            if(!empty($slider->title_size)){
                 $title_size = $slider->title_size*.5; 
            } 
            
            if(!empty($slider->details_size)){
                    $details_size = $slider->details_size*.5;
            }
               
              
            

                if ($details_size <12){
                    $details_size = 12;
                }

                if ($title_size <12){
                    $title_size = 12;
                }

                if ($subtitle_size <12){
                    $subtitle_size = 12;
                }

                echo "
                .subtitle".$slider->id."{
                    font-size:".$subtitle_size."px!important;
                }

                .title".$slider->id."{
                    font-size:".$title_size."px!important;
                }
                .details".$slider->id."{
                    font-size:".$details_size."px!important;
                }

                ";
            }
        @endphp
}

        @media only screen and (min-width: 768px) and (max-width: 991px) {

        @php
              
         $subtitle_size = .7 ;
        $title_size = .7 ;
        $details_size = .7 ;
        
            foreach ($sliders as $slider){


             if(!empty($slider->subtitle_size)){
                    $subtitle_size = $slider->subtitle_size*.7;
                  } 
            
            if(!empty($slider->title_size)){
               $title_size = $slider->title_size*.7;
            } 
            
            if(!empty($slider->details_size)){
                   $details_size = $slider->details_size*.7;
            }
             
                echo "
                .subtitle".$slider->id."{
                    font-size:".$subtitle_size."px!important;
                }

                .title".$slider->id."{
                    font-size:".$title_size."px!important;
                }
                .details".$slider->id."{
                    font-size:".$details_size."px!important;
                }

                ";
            }
        @endphp
}

    </style>