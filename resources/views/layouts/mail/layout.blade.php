<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap" rel="stylesheet">
</head>
<body>

<table width="100%" cellpadding="10" cellspacing="0" style="border: 10px solid #013F75">
    <tr>
        <td>

            <table width="100%" cellpadding="10" cellspacing="0" >
                <tr>
                    <td><img src="{{rtrim(URL_SITE_HTTP, '/').asset('images/truck.png')" /></td>
                </tr>
                <tr>
                    <td style="font-family: 'Montserrat', sans-serif;">

                        @yield('content')

                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>

</body>
</html>