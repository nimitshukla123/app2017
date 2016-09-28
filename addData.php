<?php
include_once 'admin-class.php';
$admin = new itg_admin();
$admin->_authenticate();
$state_Data = $admin->getStatesForAddData();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Form With Labels On Top</title>
        <link rel="stylesheet" href="assets/demo.css">
        <link rel="stylesheet" href="assets/form-labels-on-top.css">
    </head>
    <header>
        <h1>Add Data</h1>
        <h2><a href="logout.php"> logout</a></h2>
    </header>
    <ul>
        <li><a href="addData.php">Add Data</a></li>
        <li><a href="dashboard.php">Dashboard</a></li>
    </ul>
    <div class="main-content">
        <form class="form-labels-on-top" method="post" action="#">
            <div class="form-title-row">
                <h1>Add Data</h1>
            </div>
            <div class="form-row addState">
                <h3>Add State</h3> <br>
                <label>
                    <span>State</span>
                    <input  class="add-input" id="state" type="text" name="state">
                    <button id="addState" class="add-btn" type="button">Add</button>
                </label>
            </div>
            <div class="form-row addDistrict">
                <h3>Add District</h3> <br>
                <label>
                    <span>State</span>
                    <select id="stateDropdown" name="dropdown">
                        <option>Select State</option>
                        <?php foreach ($state_Data as $value) {?>
                        <option value="<?php echo $value['state'];?>"><?php echo strtoupper($value['state']);?></option>
                        <?php } ?>
                    </select>
                    <span>District</span>
                    <input class="add-input" id="district" type="text" name="district">
                    <button id="addDistrict" class="add-btn" type="button">Add</button>
                </label>
            </div>
            <div class="form-row addMandal">
                <h3>Add Mandal</h3> <br>
                <label>
                    <span>State</span>
                    <select name="dropdown">
                        <option>Select State</option>
                         <?php foreach ($state_Data as $value) {?>
                        <option value="<?php echo $value['state'];?>"><?php echo strtoupper($value['state']);?></option>
                        <?php } ?>
                    </select>
                    <span>District</span>
                    <select name="dropdown">
                        <option>Option One</option>
                        <option>Option Two</option>
                        <option>Option Three</option>
                        <option>Option Four</option>
                    </select>
                    <span>Mandal</span>
                    <input class="add-input" type="email" name="mandal">
                    <button id="addMandal" class="add-btn" type="button">Add</button>
                </label>
            </div>
            <div class="form-row addBooth">
                <h3>Add booth</h3> <br>
                <label>
                    <span>State</span>
                    <select name="dropdown">
                        <option>Select State</option>
                         <?php foreach ($state_Data as $value) {?>
                        <option value="<?php echo $value['state'];?>"><?php echo strtoupper($value['state']);?></option>
                        <?php } ?>
                    </select>
                    <span>District</span>
                    <select name="dropdown">
                        <option>Option One</option>
                        <option>Option Two</option>
                        <option>Option Three</option>
                        <option>Option Four</option>
                    </select>
                    <span>Mandal</span>
                    <select name="dropdown">
                        <option>Option One</option>
                        <option>Option Two</option>
                        <option>Option Three</option>
                        <option>Option Four</option>
                    </select>
                    <span>Booth</span>
                    <input class="add-input" type="email" name="booth">
                    <button id="addBooth" class="add-btn" type="button">Add</button>
                </label>
            </div>
            <div class="form-row">
                <button id="reset" type="submit">Reset</button>
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="assets/js/addData.js"></script>
</body>
</html>
