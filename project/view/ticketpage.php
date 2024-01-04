<?php
require_once("../classes/ticketsclass.php");
function drawTicketPage(Tickets $tickets, $assigned, $byDepartment, $departments, $rank)
{ ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="../css/ticket_style.css">
        <title>Index page</title>
    </head>
    <div class="tickets">
        <h1>Tickets</h1>

        <div class="row">

            <div class="column1" style="background-color:#551b8c;">
                <div class="activeticket">
                    <h2 class="dropdown-toggle" style="cursor: pointer;">Active Tickets</h2>
                    <ul class="dropdown-list" style="display: none;">
                        <?php
                        if (!empty($tickets->gettickets())) {
                            $tickets->show_active();
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="column2" style="background-color:#551b8c;">
                <div class="solvedticket">
                    <h2 class="dropdown-toggle" style="cursor: pointer;">Solved Tickets</h2>
                    <ul class="dropdown-list" style="display: none;">
                        <?php
                        if (!empty($tickets->gettickets())) {
                            $tickets->show_solved();
                        }
                        ?>
                    </ul>
                </div>
            </div>
            
            <?php if($rank == "admin" || $rank == "agent") { ?>
                <div class="column3" style="background-color:#551b8c;">
                    <div class="assignedticket">
                        <h2 class="dropdown-toggle" style="cursor: pointer;">Assigned Tickets</h2>
                        <ul class="dropdown-list" style="display: none;">
                            <?php
                            if (!empty($assigned->gettickets())) {
                                $assigned->show_active();
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="column4" style="background-color:#551b8c;">
                    <div class="departmentticket">
                        <h2 class="dropdown-toggle" style="cursor: pointer;">Department Tickets</h2>
                        <ul class="dropdown-list" style="display: none;">
                            <?php
                            if (!empty($byDepartment->gettickets())) {
                                $assigned->show_active();
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>

            <!-- Include the button.js file -->
            <script src="../javascript/button_toggle.js"></script>

            <div class="column3" style="background-color:#551b8c;">
                <div class="newticket">
                    <h2 class="t1">New Ticket</h2>
                    <form action="ticket.php" method=post class="ticket">
                        <p>Title:</p>
                        <textarea name="title" placeholder="input title here"></textarea><br>
                        <P>Importance:
                        <select name=importance>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select><br></p>
                        <p>Department:
                        <select name=department>
                        <?php 
                            foreach($departments as $department){
                                echo '<option value="' . $department['department'] . '">' . $department['department'] . '</option>';
                            };
                        ?>
                        </select><br></p>
                        <p>Description:</p>
                        <textarea name="description" placeholder="input problem here"></textarea><br>
                        <button type="submit">Send</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
<?php }
?>