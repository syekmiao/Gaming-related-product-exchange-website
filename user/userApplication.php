<?php require "../sidebar.php"; ?>
<main class="col-lg-12 bg-white">
        <div class="ps-lg-12">
            <br/><br/><h1>Your request listing</h1>
        </div>

<div class="container-fluid">
    <table class="table table-striped" style="max-width: 2100px">
        <thead>
            <tr>
                <td>#</td>
                <td><b>Item Picture</b></td>
                <td><b>Item Name</b></td>
                <td><b>Item Type</b></td>
                <td><b>Request Type</b></td>
                <td><b>Request Status</b></td>
                <td><b>Requester Comments(you)</b></td>
                <td><b>Owner Comments</b></td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
                $i = 1;
                if(empty($_SESSION['id'])){
                    echo "<div class='alert alert-danger'>Login expired, please login again. Refresh in 1 sec...</div>";
                    echo '<meta http-equiv="Refresh" content="2; url=../login.php">';
                }
                else{
                    $userId = $_SESSION['id'];
                    $rows = mysqli_query($conn, "SELECT * FROM request WHERE userId = '$userId' ORDER BY requestID DESC");
                    foreach($rows as $row) :
                        $itemIDs = $row["itemID"];
                        $sql5 = "SELECT * FROM items WHERE itemID = '$itemIDs'";
                        $result = mysqli_query($conn, $sql5);
                        $ItemCheck = mysqli_fetch_array($result);
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><img src="../img/<?php echo $ItemCheck["itemPicture"]; ?>" width="200" height="200" title="<?php echo $ItemCheck["itemPicture"]; ?>"></td>
                <td><?php echo $ItemCheck["itemname"]; ?></td>
                <td><?php echo $ItemCheck["mainCat"]; ?>/<?php echo $ItemCheck["subCat"]; ?></td>
                <td><?php echo $row["requestType"]; ?></td>
                <td><?php echo $row["requestStatus"]; ?></td>
                <td><?php echo $row["remarks"]; ?></td>
                <td><?php echo $row["ownerRemarks"]; ?></td>
                <td>
                    <a href="editApplication.php?requestID=<?php echo $row["requestID"] ?>" class="btn btn-warning" >Edit Request</a>
                    <a href="deleteApplication.php?requestID=<?php echo $row["requestID"] ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php endforeach; }?>
        </tbody>
    </table>
</div>
</main>
</body>
</html>