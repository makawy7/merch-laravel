

<!DOCTYPE html>
<html>
<head>
	<title>testPage</title>
  	<style type="text/css">
		@import url(http://fonts.googleapis.com/earlyaccess/droidarabickufi.css);

		body * {
		    font-family: Droid Arabic Kufi;
		}

		.mainMsg{
			margin:0;padding:0em
		}
		.firstTd{
			background-color:#f2f2f2;
			font-family:Arial,sans-serif;padding:2.5em
		}
		.secondTd{
			font-size:15px;
			line-height:1.4;
			color:#333333;
			border:1px solid #dddddd;
			background-color:#ffffff;
			border-radius:4px
		}
		.secondTd h2{
			text-align:center
		}
		.secondTd h4{
			text-align:center
		}
		.secondTd hr{
			border:none;
			border-bottom:1px solid #dddddd;
			margin-bottom:2em
		}
		.secondTd p{
			text-align:center
		}
		.secondTd table{
			text-align:center;
			margin:0 auto
		}
		.secondTd table tbody tr td{
			background:#1892e6;
			border-radius:5px
		}
		.secondTd table tbody tr td a{
			color:#ffffff;
			display:block;
			font-size:18px;
			font-weight:bold;
			text-align:center;
			text-decoration:none;
			text-transform:uppercase;
		}
		.firstTd .p1{
			font-size:0.8em;
			color:gray;
			font-weight:bold;
			margin-bottom:0
		}
		.firstTd .p2{
			font-size:0.8em;
			color:gray;
			margin-top:0.5em
		}
  	</style>
</head>
<body>

<div class="mainMsg">
    <table border="0" cellpadding="20" cellspacing="0" width="100%">
        <tbody>
            <tr>
                <td align="center" valign="top" class="firstTd"><img src="{{Request::root()}}/public/site/front/images/logo.png" height="150px;" alt="SMTP2GO">
                    <table border="0" cellpadding="20" cellspacing="0" height="100%" width="600">
                        <tbody>
                            <tr>
                                <td align="left" valign="top" class="secondTd">

                                  <a href="{{$link}}"> <h3>Reset Your Password</h3> </a>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="p1">{{setting()->name}}</p>
                    <p class="p2">{{Request::root()}}</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</body>
</html>
