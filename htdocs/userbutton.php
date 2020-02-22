<script type="text/javascript">
    function showPanel() {
        document.getElementById("userpanel").style.display = "block"
    }
    
    function hidePanel() {
        document.getElementById("userpanel").style.display = "none"
    }
</script>

<style type="text/css">
    #userbutton
    {
        width: 36px;
        height: 36px;
    }
    
    #userbutton img
    {
        border-radius: 18px;
    }
</style>

<a id="userbutton" href="javascript:void(0)" onmouseover="showPanel()" onclick="hidePanel()">
    <!-- Change the image below to the user profile picture when it's available -->
    <img src="/images/profile-default-32x32.png" width="36px" height="36px">
</a>