<header>
    <div class="container-fluid">
        <div class="row header">
            <div class="col-sm-6 col-sm-offset-3"><h1>Careers <b>Fairs</b></h1></div>
        </div>
    </div>
</header>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index"><img src="images/shield.png" width="34" height="40" alt="ntu-shield" class="img-responsive"></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-haspopup="true" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle Navigation</span>
                <span class = "icon-bar top-bar"></span>
                <span class = "icon-bar middle-bar"></span>
                <span class = "icon-bar bottom-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li><a href="index" accesskey="1"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
                <li><a href="events" accesskey="4"><i class="fa fa-calendar" aria-hidden="true"></i>Events</a></li>
                <li><a href="information" accesskey="2"><i class="fa fa-info-circle" aria-hidden="true"></i>Information</a></li>
                <li><a href="maps" accesskey="3"><i class="fa fa-map-marker" aria-hidden="true"></i>Maps</a></li>
                <li><a href="feedback" accesskey="5"><i class="fa fa-comment" aria-hidden="true"></i>Feedback</a></li>
                <li><a href="https://futurehub.ntu.ac.uk/" accesskey="6"><i class="fa fa-external-link" aria-hidden="true"></i>Futurehub</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php
                        include "connect.php";
                            try {
                                $result = $db->prepare("SELECT * FROM bookmark_event JOIN event ON bookmark_event.eventID = event.eventID WHERE bookmark_event.euserID = :userID");
                                $result->execute(array(':userID' => $thisuser));
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    $events[] = array('ID' => $row['eventID'], 'Title' => $row['Title']);
                                }
                                if (!empty($events)) {
                                    echo "<li class='title'><a href='bookmarks'>My Events</a></li>";
                                    foreach($events as $event):
                                        echo "<li><a href='event?id=" . $event['ID'] . "'>" . $event['Title'] . "</a></li>";
                                    endforeach;
                                }
                                $result2 = $db->prepare("SELECT * FROM bookmark_information JOIN information ON bookmark_information.infoID = information.infoID WHERE bookmark_information.userID = :userID");
                                $result2->execute(array(':userID' => $thisuser));
                                while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
                                    $info[] = array('ID' => $row2['infoID'], 'Title' => $row2['Title']);
                                }
                                if (!empty($info)) {
                                    echo "<li class='title'><a href='bookmarks'>My Information</a></li>";
                                    foreach($info as $inf):
                                        echo "<li><a href='information?id=" . $inf['ID'] . "'>" . $inf['Title'] . "</a></li>";
                                    endforeach;
                                }
                            }
                            catch(PDOException $e) {
                                echo "Error";
                            } ?>
                        <li class="title"><a href="#">Account</a></li>
                        <?php if($aLevel == 1){echo"<li><a href='admin'>Admin Panel</a></li>";}?>
                        <li><a href="bookmarks" accesskey="7">Bookmarks</a></li>
                        <li><a href="scripts/logout" accesskey="8">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
