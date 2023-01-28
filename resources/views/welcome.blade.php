<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    </head>

  
    
 @vite(['resources/css/app.css', 'resources/js/app.js'])
 
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <style>
      
        .v-list-item--active{
            background-color: green !important;
            color: white !important;
        }
            @media only screen and (max-width: 600px) {
              .TabsTabs {
                display: none !important;
              }
              .TopTopBar{
                position: fixed;
                  left: 0;
                  bottom: 0;
                  width: 100%;
                  text-align: center;
              }
              footer.v-footer.v-theme--light{
                padding: 0 !important;
              }
            }
            div.v-col-sm-12.v-col-12,.v-card-text{
                    padding: 0px;
                }
          /*  .v-img__img,.v-img__img--cover{
                opacity: 0.6 !important;
            }*/

            .v-img__img.v-img__img--cover{
              /*   filter: blur(8px);
                  -webkit-filter: blur(8px);*/
                  
                  /* Full height */
                  height: 100%; 
                  
                  /* Center and scale the image nicely */
                  background-position: center;
                  background-repeat: no-repeat;
                  background-size: cover;

            }

            .bg-text {
              background-color: rgb(0,0,0); /* Fallback color */
              background-color: rgba(0,0,0, 0.6); /* Black w/opacity/see-through */
              color: white !important;
              font-weight: bold;
              border: 3px solid #f1f1f1;
              position: absolute;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%);
              z-index: 2;
              padding: 20px;
              text-align: center;
              border-radius: 50px 20px;
            }
            div.v-expansion-panel__shadow{
                box-shadow: none !important;
            }
            div.v-card-text{
                 padding-bottom: 0px !important;
            }
          div.v-input__details.{
            display: none !important;
          }
</style>
    <body>
        <div id="app">
            <app-component></app-component>
        </div>
    </body>
    
       
</html>
