</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--   Core JS Files   -->
<script src="./assets/js/core/jquery.min.js"></script>
<script src="./assets/js/core/popper.min.js"></script>
<script src="./assets/js/core/bootstrap.min.js"></script>
<script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chart JS -->
<script src="./assets/js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="./assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="./assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="./assets/demo/demo.js"></script>
<script>
  $(document).ready(function() {
    // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
    demo.initChartsPages();
  });
</script>

<?php

if (isset($_GET['message']) && isset($_GET['status']) && isset($_GET['route'])) {
  if (addslashes($_GET['status']) == 1) {
?>
    <script>
      Swal.fire({
        title: "Success",
        text: "<?= addslashes($_GET['message']) ?>",
        icon: "success"
      }).then((a) => {
        window.location.href = '<?= addslashes($_GET['route']) ?>'
      });
    </script>
  <?php
  } else {
  ?>
    <script>
      Swal.fire({
        title: "Failed",
        text: "<?= addslashes($_GET['message']) ?>",
        icon: "error"
      }).then((a) => {
        window.location.href = '<?= addslashes($_GET['route']) ?>'
      });
    </script>
<?php
  }
}
?>

</body>

</html>