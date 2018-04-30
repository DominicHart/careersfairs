<div class="edit-modal" id="edit-modal">
    <div class="edit-container">
        <form action="scripts/update.php" method="post">
            <div class="dialog-header">
                <button type="button" onclick="edit_modal()" class="pull-right close">&times;</button>
                <h3>Update event</h3>
            </div>
            <div class="dialog-content clearfix">
                <div class="row">
                    <?php
                    try {
                        if ($_REQUEST['js_submit_value']) {
                            $article = $_REQUEST['js_submit_value'];
                        }
                        include "../includes/connect.php";
                        $result = $db->prepare("SELECT * FROM information WHERE infoID = :infoID");
                        $result->execute(array(':infoID' => $article));
                        while ($row = $result->fetch()) {
                            echo <<<_END
                                <div class="form-group col-sm-6">
                                    <label for="type">Type</label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="$row[Type]" selected>$row[Type]</option>
                                        <option value="Recruitment Event">Recruitment Event</option>
                                        <option value="Job Search">Job Search</option>
                                        <option value="Briefing">Briefing</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="$row[Title]" required>
                                </div>
                                <div class="form-group col-sm-12 date">
                                    <div class="row">
                                        <div class="col-sm-4">
_END;
                            $split = explode("/", $row['Date']);
                            $Day = $split[0];
                            $Month = $split[1];
                            $Year = $split[2];
                            $day1 = "1"; $day31 = 1 + 30; $days = range($day1, $day31);
                            echo <<<_END
                                            <label for="day" class="sr-only">Day</label>
                                            <select name="day" id="day" class="form-control" required>
_END;
                            echo "<option value='$Day'>$Day</option>";
                            foreach($days as $day):
                                echo <<<_END
                                                <option value="$day">$day</option>
_END;
                            endforeach;
                            echo <<<_END
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="month" class="sr-only">Month</label>
                                            <select name="month" id="month" class="form-control" required>
_END;
                            echo "<option value='$Month'>$Month</option>";
                            echo <<<_END
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>
_END;
                            $startyear = date("Y"); $endyear = date("Y") + 1; $years = range($startyear, $endyear);
                            echo <<<_END
                                        <div class="col-sm-4">
                                            <label for="year" class="sr-only">Year</label>
                                            <select name="year" id="year" class="form-control" required>
_END;
                            echo "<option value='$Year'>$Year</option>";
                            foreach($years as $year):
                                echo <<<_END
                                                <option value="$year">$year</option>
_END;
                            endforeach;
                            echo <<<_END
                                            </select>
                                        </div>
                                    </div>
                                </div>
_END;
                            $split = explode(" - ", $row['Time']);
                            $From = $split[0];
                            $To = $split[1];
                            echo <<<_END
                                <div class="form-group col-sm-12 time">
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="timefrom" class="sr-only">From</label>
                                            <input type="time" id="timefrom" name="timefrom" class="form-control" value="$From">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="timeto" class="sr-only">Until</label>
                                            <input type="time" id="timeto" name="timeto" class="form-control" value="$To">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="location">Location</label>
                                    <input type="text" name="location" id="location" value="$row[Location]" class="form-control" required>
                                </div>
                                <input type="hidden" name="infoID" value="$row[infoID]">
                                <div class="form-group col-sm-12">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" rows="7" cols="30" class="form-control" placeholder="Enter the description" required>$row[Description]</textarea>
                                </div>
_END;
                        }
                    }
                    catch (PDOException $e) {
                        $error = 'Error fetching event; ' . $e->getMessage();
                    }
                    ?>
                </div>
                <div class="dialog-buttons">
                    <div class="row">
                        <button type="submit" name="submit" class="update-yes">Update</button>
                        <button type="button" onclick="edit_modal()" class="update-no">Cancel</button>
                    </div>
                </div>
        </form>
    </div>
</div>
