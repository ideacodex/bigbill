<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Archivos</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    GENERAR REPORTE
                </div>

                <div class="links">
                    <p>Descargar <a href="{{route('products.pdf')}}">PDF</a></p>
                </div>

            </div>
        </div>


        <table id="tblData">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Country</th>
                <th>Name</th>
                <th>Email</th>
                <th>Country</th>
            </tr>
            <tr>
                <td>John Doe</td>
                <td>john@gmail.com</td>
                <td>USA</td>
                <td>John Doe</td>
                <td>john@gmail.com</td>
                <td>USA</td>
            </tr>
            <tr>
                
                <td>Michael Addison</td>
                <td>michael@gmail.com</td>
                <td>UK</td>
                <td>Michael Addison</td>
                <td>michael@gmail.com</td>
                <td>UK</td>
            </tr>
            <tr>
                <td>Sam Farmer</td>
                <td>sam@gmail.com</td>
                <td>France</td>
                <td>Sam Farmer</td>
                <td>sam@gmail.com</td>
                <td>France</td>
            </tr>
        </table>
        <button onclick="exportTableToExcel('tblData', 'members-data')">Export Table Data To Excel File</button>
        <script src="js/tableToExcel.js"></script>
    </body>
</html>

