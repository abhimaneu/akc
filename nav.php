<html>
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

</html>