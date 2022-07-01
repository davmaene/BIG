<?php 
    if(isset($_SESSION) && isset($_SESSION['_bigUser'])) unset($_SESSION['_bigUser']);
?>
<script>
    window.location.replace("../login")
</script>