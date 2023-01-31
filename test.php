<form action="test.php" method="post">
    <input type="date" name="date" id="">
    <input type="submit" value="Submit" name="submit">
</form>

<?php
    if(isset($_POST['aubmit'])) {
        echo $_POST['date'];
    }
?>