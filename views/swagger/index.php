<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Masjid-In API</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swagger-ui-dist@3.52.0/swagger-ui.css">
    <link rel="icon" type="image/png" href="https://cdn.jsdelivr.net/npm/swagger-ui-dist@3.52.0/favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="https://cdn.jsdelivr.net/npm/swagger-ui-dist@3.52.0/favicon-16x16.png" sizes="16x16"/>
    <style>
    html {
        box-sizing: border-box;
        overflow: -moz-scrollbars-vertical;
        overflow-y: scroll;
    }
    *,
    *:before,
    *:after {
        box-sizing: inherit;
    }
    body {
        margin: 0;
        background: #fafafa;
    }
    </style>
</head>
<body>
    <div id="swagger-ui"></div>

    <script src="https://cdn.jsdelivr.net/npm/swagger-ui-dist@3.52.0/swagger-ui-bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swagger-ui-dist@3.52.0/swagger-ui-standalone-preset.js"></script>
    <script>
        window.onload = function() {
            // Build a system
            const ui = SwaggerUIBundle({
                dom_id: '#swagger-ui',
                url: "/api-swagger.php", // Adjust this to the correct endpoint
                operationsSorter: "alpha", // You can change this or make it dynamic as needed
                configUrl: null, // Adjust as needed
                validatorUrl: null, // Adjust as needed

                requestInterceptor: function(request) {
                    request.headers['X-CSRF-TOKEN'] = '{{ csrf_token() }}'; // Adjust as needed or remove if not applicable
                    return request;
                },

                presets: [
                    SwaggerUIBundle.presets.apis,
                    SwaggerUIStandalonePreset
                ],

                plugins: [
                    SwaggerUIBundle.plugins.DownloadUrl
                ],

                layout: "StandaloneLayout",
                docExpansion: "none", // Adjust as needed or make dynamic
                deepLinking: true,
                filter: true, // Adjust as needed or make dynamic
                persistAuthorization: true // Adjust as needed or make dynamic
            });

            window.ui = ui;

            // Adjust as needed if you are using OAuth2
            ui.initOAuth({
                usePkceWithAuthorizationCodeGrant: true
            });
        }
    </script>
</body>
</html>
