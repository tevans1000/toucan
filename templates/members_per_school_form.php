<?php

require_once("../scripts/fetch_all_schools.php");

?>

<form action="../scripts/members_per_school.php" method="post" class="form-inline">
    <div class="form-group">
        <label for="school">
            School
        </label>
        <select class="form-control" id="school" name="school">
            <?php
            foreach ($all_schools as $school){
                ?>
                <option value="<?=$school["school_id"]?>">
                    <?=$school["school_name"]?>
                </option>
                <?php
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">
        List members
    </button>
</form>