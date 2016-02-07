<script>

onload = function(){
alert("<?php echo $nomi; ?>");
var nomi = ["飲まない","あまりない","普通","割と飲む","かなり飲む"];
document.getElementById("nomi_chosen").innerHTML = nomi[2];
}


</script>