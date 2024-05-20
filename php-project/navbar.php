<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Poppins Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #151515;
            color: white;
            font-family: "Poppins", sans-serif;
        }

        nav {
            position: fixed;
            display: flex;
            align-items: center;
            padding: 30px;
            width: 100%;
            height: 50px;
            background-color: #0D0D0D;
            z-index:1000;
        }

        nav ul {
            display: flex;
            width: 100%;
            gap: 30px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        nav ul:first-child {
            flex-grow: 1;
        }

        nav ul:last-child {
            justify-content: flex-end;
        }

        nav ul li {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
        }
        

        nav ul li a {
            text-decoration: none;
            color: inherit;
            display: flex;
            justify-content: center;
            gap:10px;
        }

        nav ul li a:hover {
            text-decoration: none;
            font-weight: bold;
        }

        strong{
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php"><img src="btnImages/vcticon.png" alt="vct icon" width="24px"><strong>VCT</strong></a></li>
        </ul>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="edit.php" target="_blank">Edit</a></li>
        </ul>
    </nav>
</body>
</html>
