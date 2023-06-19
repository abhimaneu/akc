<!DOCTYPE html>
<html>

<head>
<style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        #nav {
            background-color: #333;
        }

        #navul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #navli {
            margin: 0;
        }

        #navli a {
            display: block;
            text-decoration: none;
            padding: 12px 20px;
            color: #fff;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        #navli a:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <div id="nav">
        <ul id="navul">
            <li id="navli"><a href="inpass.php">Inpass</a></li>
            <li id="navli"><a href="outpass.php">Outpass</a></li>
            <li id="navli"><a href="products.php">Products</a></li>
            <li id="navli"><a href="ledger.php?f=0">Ledger</a></li>
            <li id="navli"><a href="stock.php?f=0">Stock</a></li>
            <li id="navli"><a href="profile.php">Profile</a></li>
        </ul>
    </div>
</body>

</html>


<!-- <html>
<style>
    li {
        display: inline;
        float: left;
    }

    a {
        display: flex;
        text-decoration-line: none;
        padding: 8px;
        color: white;
    }

    ul {
        background: none;
        
    }
 
    li:last-child {
        padding-left: 1002;
    }

    #nav {
        display: flex;
        width: 100%;
        height: 10%;
        background-color: black;
    }
</style>

<body>
    <div id="nav">
        <ul id="navul">
            <li id="navli"><a id="nava" href="inpass.php">Inpass</a></li>
            <li id="navli"><a id="nava" href="outpass.php">Outpass</a></li>
            <li id="navli"><a id="nava" href="products.php">Products</a></li>
            <li id="navli"><a id="nava" href="ledger.php?f=0">Ledger</a></li>
            <li id="navli"><a id="nava" href="stock.php">Stock</a></li>
            <li id="navli"><a id="nava" href="profile.php">Profile</a></li>
        </ul>
    </div>
</body>

</html> -->