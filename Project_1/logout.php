<?php
    session_start();
    $result =session_destroy();

    if($result){
?>
<script>
    alert("You have been logged out.");
    history.back();
</script>
<?php
    }
?>