			</main>
		</div>
		<script>
		    $(document).ready(function () {
		        $(".bg-drk-purple i").click(function () {
		            $("#sidebar").toggleClass("active");
		            $(".main").toggleClass("main-active");
		        });
		    });
			/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
			var dropdown = document.getElementsByClassName("dropdown-btn");
			var i;

			for (i = 0; i < dropdown.length; i++) {
				dropdown[i].addEventListener("click", function() {
					this.classList.toggle("active");
					var dropdownContent = this.nextElementSibling;
					if (dropdownContent.style.display === "grid") {
						dropdownContent.style.display = "none";
					} else {
						dropdownContent.style.display = "grid";
					}
				});
			}
		</script>
	</body>
</html>