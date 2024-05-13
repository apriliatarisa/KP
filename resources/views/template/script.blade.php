<!-- Bootstrap core JavaScript-->
<script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('template/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('template/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('template/js/demo/chart-pie-demo.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.getElementById("searchInput").addEventListener("keyup", function() {
        let input = this.value.toLowerCase();
        let table = document.getElementById("dataTable");
        let rows = table.getElementsByTagName("tr");

        for (let row of rows) {
            let rowData = row.textContent.toLowerCase();
            if (rowData.includes(input)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        }
    });
</script>