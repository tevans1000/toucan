<?php

if (isset($_SESSION["requested_school"])){
    ?>
    <h2>
        Members registered with <?=$_SESSION["requested_school"]?>
    </h2>
    <?php
    if (count($_SESSION["members"]) == 0){
        ?>
        <p>
            None found
        </p>
        <?php
    } else {
        ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead><tr>
                    <th>
                        Name
                    </th>
                    <th>
                        Email
                    </th>
                </tr></thead>
                <tbody>
                    <?php
                    foreach ($_SESSION["members"] as $member){
                        ?>
                        <tr>
                            <td>
                                <?=$member["member_name"]?>
                            </td>
                            <td>
                                <?=$member["member_email"]?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
    }
    unset($_SESSION["requested_school"]);
    unset($_SESSION["members"]);
}

?>