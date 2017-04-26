<?php

require_once("../scripts/fetch_all_schools.php");

$email_default = !empty($_SESSION["input"]["email"]) ? "value=" . htmlspecialchars($_SESSION["input"]["email"]) : "";
$name_default = !empty($_SESSION["input"]["member_name"]) ? "value=" . htmlspecialchars($_SESSION["input"]["member_name"]) : "";

?>

<form action="../scripts/add_member.php" method="post" class="form-horizontal">
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">
            Email
        </label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" <?=$email_default?>>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="member_name">
            Name
        </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="member_name" name="member_name" <?=$name_default?>>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="schools">
            Schools
        </label>
        <div class="col-sm-10" id="schools">
            <?php
            foreach ($all_schools as $school){
                ?>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="schools[]" value="<?=$school["school_id"]?>" <?=$school["checked"]?>>
                        <?=$school["school_name"]?>
                    </label>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">
            Add member
        </button>
    </div>
</form>