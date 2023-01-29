<div class="row">
    <div class="col-3 mb-3">
        <label class="form-label">Date: </label>
        <input type="date" name="date" class="form-control">
    </div>
    <div class="col-3 mb-3">
        <label class="form-label">Institute :</label>
        <select class="form-control" name='institute' id="s1">
            <option value="0">-- Select --</option>
            <option value="All">All</option>
            <?php
            include_once '../connection.php';
            $sql1 = "SELECT DISTINCT institute, city FROM classes";
            $result1 = mysqli_query($con, $sql1);
            while ($ri = mysqli_fetch_assoc($result1)) {
                ?>
                <option value="<?php echo $ri['institute'] ?>"><?php echo $ri['institute'] . " - " . $ri['city'] ?>
                </option>
            <?php } ?>
        </select>
    </div>
    <div class="col-3 mb-3">
        <label class="form-label">A/L Year :</label>
        <select class="form-control" name='year' id="s2">
            <option value="0">-- Select --</option>
            <option value="All">All</option>
            <?php
            $sql2 = "SELECT DISTINCT al_year FROM classes";
            $result2 = mysqli_query($con, $sql2);
            while ($ri2 = mysqli_fetch_assoc($result2)) {
                ?>
                <option value="<?php echo $ri2['al_year'] ?>"><?php echo $ri2['al_year'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-3 mb-3">
        <label class="form-label">Status :</label>
        <select class="form-control" name='status'>
            <option value="0">-- Select --</option>
            <option value='1'>Paid</option>
            <option value='2'>Not Paid</option>
        </select>
    </div>
    <div class="d-grid gap-2">
        <button class="btn btn-outline-success" type="submit" name="search">Search</button>
    </div>
</div>
<br />
<div class="bd-example-snippet bd-code-snippet"><br />
    <div class="bd-example"><br />
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Date</th>
                <th scope="col">Institute</th>
                <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>