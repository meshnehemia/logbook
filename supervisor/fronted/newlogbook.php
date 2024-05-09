<?php 

    include_once('main.php');
    echo'<section class="content">
                    <div class="show_header">
                        <h1>LOGBOOK</h1>
                    </div>
                    <div>
                    <form action="../company/newlogbook.php" method="POST">
                    <table style="width:100%; border-collapse:collapse;" border=1>
                    <thead>
                        <tr>
                        <th>Date</th>
                        <th>WorkDone</th>
                        <th>new skills</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td><input type="date" name="date" id="date"  style="width:100%;" size="4"></td></td>
                        <td><textarea id="w3review" name="work_done" rows="20" cols="50" style="width:100%; background:transparent;"; ></textarea></td>
                        <td><textarea id="w3review" name="new_skills" rows="20" cols="50" style="width:100%; background:transparent;";></textarea></td>
                    </tbody>
                </table>
                    <input type="submit" value="submit" class="submit"/>
                    </form>
                    </div>
    </section>';