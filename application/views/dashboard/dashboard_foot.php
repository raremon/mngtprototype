</div>
<!-- /.row (main row) -->

<!-- INSERT JAVASCRIPT HERE -->
<script>
n =  new Day();
y = n.getFullYear();
m = n.getMonth() + 1;
d = n.getDate();
document.getElementById("date").innerHTML = m + "/" + d + "/" + y;
</script>