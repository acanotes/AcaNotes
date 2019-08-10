<style>
    #userpanel
    {
        position: fixed;
        z-index: 1;
        filter: drop-shadow(0px 4px 12px rgba(0,0,0,0.5));
        display: none;
        
        top: 48px;
        right: 16px;
        
        width: 198px;
        height: 360px;
    }
    
    .popover-arrow-up
    {
        position: fixed;
        z-index: 8;
        top: 48px;
        right: 32px;
        /*
        top: 0px;
        right: 16px;
        */
    }
    
    #userpanel-inner
    {
        position: fixed;
        z-index: 8;
        top: 60px;
        right: 16px;
        overflow: scroll;
        /*
        top: 12px;
        right: 0px;
        */
        width: 198px;
        height: 352px;
        border-radius: 4px;
        background-color: #E0E0E0;
        
        padding: 8px 8px 8px 8px;
    }
</style>

<div id="userpanel" class="popover">
    <img class="popover-arrow-up" src="/images/ui-arrow-up.png" width="16px" height="12px"></img>
    <div id="userpanel-inner" class="popover-inner">
        <?php
            if(isset($_SESSION['u_id'])) {
                $conn = mysqli_connect(localhost, u707460616_aca, 'mKm7aC4A', 'u707460616_accounts');
                $sql1 = "SELECT * FROM users WHERE user_id = $_SESSION[u_id]";
                $result1 = $conn->query($sql1);
            
                while ($row = $result1->fetch_assoc()) {
                    echo "<h2>$row[user_uid]</h2>";
                    echo '<form action="../includes/logout.inc.php" method="POST"><button type="submit" name="submit">Logout</button></form></div>';
                }
            } else {
                echo('Failed to fetch user information.');
            }
        ?>
    </div>
</div>