<?php

require_once("../classes/ticketsclass.php");

function drawProblemPage($ticket, $comments, $departments, $rank, $changes, $agents, $assigned)
{
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="../css/problem_style.css">

        <title>Problem Page</title>
    </head>
    <div class="row">
        <div class="column" style="background-color:#551b8c;">
            <div class="ticket_info">
                <p><span>ID:</span>
                <div class="id">
                    <?php echo $ticket->get_id(); ?>
                </div>
                </p>

                <p><span>Submitter:</span>
                <div class="Submitter">
                    <?php echo $ticket->get_submitter(); ?>
                </div>
                </p>

                <p><span>Created:</span>
                <div class="time">
                    <?php echo $ticket->get_time(); ?>
                </div>
                </p>

                <?php if ($rank == "agent" || $rank == "admin") { ?>
                    <form action="problem.php?id=<?php echo $ticket->get_id(); ?>" method=post class="changes">
                        <p><span>Importance:</span>
                            <select name=importance>
                                <option value=""> <?php echo "current: " . $ticket->get_importance(); ?> </option>
                                <option value="low">low</option>
                                <option value="medium">medium</option>
                                <option value="high">high</option>
                            </select>
                        </p>
                        <p><span>Status:</span>
                            <select name=status>
                                <option value=""> <?php echo "current: " . $ticket->get_status(); ?> </option>
                                <option value="sent">sent</option>
                                <option value="picked">picked</option>
                                <option value="solved">solved</option>
                            </select>
                        </p>
                        <p><span>Assign to:</span>
                            <select name=assign>
                                <option value=""> <?php echo "current: " . $assigned; ?> </option>
                                <?php
                                foreach ($agents as $agent) {
                                    echo '<option value="' . $agent->get_username() . '">' . $agent->get_username() . '</option>';
                                }
                                ?>
                            </select>
                        <p><span>Department:</span>
                            <select name="department">
                                <option value=""> <?php echo "current:" . $ticket->get_department(); ?> </option>
                                <?php
                                foreach ($departments as $department) {
                                    echo '<option value="' . $department['department'] . '">' . $department['department'] . '</option>';
                                }
                                ?>
                            </select>
                        </p>
                        <button type="submit">Change</button>
                    </form>
                <?php } else { ?>
                    <p><span>Importance:</span>
                    <div class="importance">
                        <?php echo $ticket->get_importance(); ?>
                    </div>
                    </p>
                    <p><span>Status:</span>
                    <div class="stat">
                        <?php echo $ticket->get_status(); ?>
                    </div>
                    </p>
                    <p><span>Assigned to:</span>
                    <div class="assigned">
                        <?php echo $assigned; ?>
                    </div>
                    </p>
                    <p><span>Department:</span></p>
                    <div class="department">
                        <?php echo $ticket->get_department(); ?>
                    </div>
                <?php }; ?>
                <p><span>Description:</span>
                <div class="description">
                    <?php echo $ticket->get_descript(); ?>
                </div>
                </p>
            </div>
        </div>

        <div class="column" style="background-color:#250345;">
            <div class="chatbox">
            <p>Chat:</p>
                <?php if (!empty($comments)) {
                    $comments->show_comments();
                } ?>


                <form action="problem.php?id=<?php echo $ticket->get_id(); ?>" method=post class="comment">
                    <textarea name="message" placeholder="Type Message"></textarea>
                    <button type="submit">Send</button>
                </form>
            </div>

            <div class="changes">
                <p>Changes:</p>
                <?php if (!empty($changes)) {
                    $changes->show_changes();
                }
                ?>
            </div>
        </div>
    </div>
<?php
}
?>
