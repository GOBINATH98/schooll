<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joke API Example</title>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/0egvHE5yQfmbP+W9e5i0nU9IQBLopYYJKrfto" crossorigin="anonymous"></script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <button type="submit" id="button">Fetch Jokes</button>
    <table id="jokes-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Setup</th>
                <th>Punchline</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <p id="para"></p>

    <script>
        $(document).ready(function() {
            $('#button').click(function() {
                $.ajax({
                    url: "https://api.open-meteo.com/v1/forecast?latitude=52.52&longitude=13.41&current=temperature_2m,wind_speed_10m&hourly=temperature_2m,relative_humidity_2m,wind_speed_10m",
                    type: "GET",
                    // dataType: "json",https://api.open-meteo.com/v1/forecast?latitude=52.52&longitude=13.41&current=temperature_2m,wind_speed_10m&hourly=temperature_2m,relative_humidity_2m,wind_speed_10m
                    success: function(data) {
                      
                console.log(data)
                console.log(typeof(data));
                Object.entries(data).forEach(function([key, value]) {
                            $('#para').append(`
                            
                                <tr>
                                    <td>${key}</td>
                                    <td>${value}</td>
                                    <td>${current.units.temperature}</td>
                                   
                                  
                                </tr>
                            `);
                        });
                    },
                 
                });
            });
        });
    </script>
</body>
</html>
