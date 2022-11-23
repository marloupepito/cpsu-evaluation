<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
             @vite(['resources/css/app.css', 'resources/js/app.js'])
          <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
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


    </style>
    <body>
        <div id="app">
            <app-component></app-component>
        </div>
    </body>
</html>
